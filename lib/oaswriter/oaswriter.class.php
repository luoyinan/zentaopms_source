<?php
/**
 * The oaswriter library of zentaopms.
 */
class oaswriter
{
    private string $version = '3.2.0';

    private array $moduleMap = [];

    private array $versionMap = array('3.2' => '3.2.0', '3.1' => '3.1.2', '3.0' => '3.0.4');

    /**
     * 校验接口列表是否存在路径冲突。
     * Validate if there are path conflicts in the api list.
     *
     * @param  array $apis 接口列表
     * @access public
     * @return array
     */
    public function validate($apis)
    {
        $conflicts = [];
        $used      = [];

        foreach($apis as $api)
        {
            $path   = (string)zget($api, 'path', '');
            $method = strtolower((string)zget($api, 'method', 'get'));
            $key    = $path . '|' . $method;

            if(isset($used[$key])) $conflicts[] = sprintf('path=%s method=%s', $path, strtoupper($method));
            $used[$key] = true;
        }

        return array_values(array_unique($conflicts));
    }

    /**
     * 构建 OpenAPI 文档。
     * Build OpenAPI document.
     *
     * @param  object       $lib     接口库对象
     * @param  array        $modules 目录列表
     * @param  array        $apis    接口列表
     * @param  array        $structs 数据结构列表
     * @param  string       $version OpenAPI 版本号
     * @param  object|null  $release 发布对象
     * @access public
     * @return array
     */
    public function buildDocument($lib, $modules, $apis, $structs, $version = '3.2', $release = null)
    {
        $this->version   = zget($this->versionMap, $version, '3.2.0');
        $this->moduleMap = [];

        foreach($modules as $module) $this->moduleMap[(int)$module->id] = $module->name;

        $doc = array(
            'openapi'    => $this->version,
            'info'       => $this->buildInfo($lib, $release),
            'servers'    => $this->buildServers($lib),
            'tags'       => $this->buildTags($modules),
            'paths'      => $this->buildPaths($apis),
            'components' => $this->buildComponents($structs),
        );

        if(empty($doc['tags'])) unset($doc['tags']);
        if(empty($doc['components']['schemas'])) unset($doc['components']);

        return $this->postProcessForVersion($doc);
    }

    /**
     * 导出为 JSON 格式。
     * Export document as JSON.
     *
     * @param  array  $doc 文档内容
     * @access public
     * @return string
     */
    public function exportJson($doc)
    {
        return json_encode($doc, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * 导出为 YAML 格式。
     * Export document as YAML.
     *
     * @param  array  $doc 文档内容
     * @access public
     * @return string
     */
    public function exportYaml($doc)
    {
        $spyc = $GLOBALS['app']->loadClass('spyc');
        return $spyc->YAMLDump($doc, 2, 0, true);
    }

    /**
     * 构建文档信息节点。
     * Build document info section.
     *
     * @param  object       $lib     接口库对象
     * @param  object|null  $release 发布对象
     * @access private
     * @return array
     */
    private function buildInfo($lib, $release = null)
    {
        return array(
            'title'       => $lib->name ?? '',
            'version'     => $release ? $release->version ?? '1.0.0' : '1.0.0',
            'description' => $lib->desc ?? '',
        );
    }

    /**
     * 构建服务器节点。
     * Build servers section.
     *
     * @param  object $lib 接口库对象
     * @access private
     * @return array
     */
    private function buildServers($lib)
    {
        $url = trim($lib->baseUrl ?? '');
        if($url === '') $url = '/';
        return array(array('url' => $url));
    }

    /**
     * 构建标签节点。
     * Build tags section.
     *
     * @param  array $modules 目录列表
     * @access private
     * @return array
     */
    private function buildTags($modules)
    {
        $tags      = [];
        $usedNames = [];
        foreach($modules as $module)
        {
            $name = (string)$module->name;
            if(isset($usedNames[$name])) continue;

            $usedNames[$name] = true;

            $tag = array('name' => $name);

            if(version_compare($this->version, '3.2.0', '>='))
            {
                if((int)($module->parent ?? 0) > 0 && isset($this->moduleMap[(int)$module->parent])) $tag['parent'] = $this->moduleMap[(int)$module->parent];
                $tag['kind'] = 'api-module';
            }

            $tags[] = $tag;
        }
        return $tags;
    }

    /**
     * 构建接口路径节点。
     * Build paths section.
     *
     * @param  array $apis 接口列表
     * @access private
     * @return array
     */
    private function buildPaths($apis)
    {
        $paths = [];
        foreach($apis as $api)
        {
            $path   = (string)zget($api, 'path', '/');
            $method = strtolower((string)zget($api, 'method', 'get'));

            $paths[$path][$method] = $this->buildOperation($api);
        }

        ksort($paths);
        return $paths;
    }

    /**
     * 构建单个接口操作节点。
     * Build a single operation node.
     *
     * @param  object $api 接口对象
     * @access private
     * @return array
     */
    private function buildOperation($api)
    {
        $pathParams = [];
        preg_match_all('/\{(\w+)\}/', $api->path ?? '', $matches);
        if(!empty($matches[1])) $pathParams = array_flip($matches[1]);

        $operation = array(
            'summary'     => $api->title ?? '',
            'description' => strip_tags(htmlspecialchars_decode($api->desc ?? '')),
            'operationId' => $this->buildOperationId($api),
            'responses'   => $this->buildResponses($api->response ?? [], $api->responseType ?? '', $api->responseExample ?? ''),
        );

        $tagName = $api->moduleName ?? zget($this->moduleMap, (int)($api->module ?? 0), '');
        if($tagName !== '') $operation['tags'] = array($tagName);

        $parameters = $this->buildParameters($api->params ?? [], $pathParams);
        if(!empty($parameters)) $operation['parameters'] = $parameters;

        $requestBody = $this->buildRequestBody($api->params ?? [], $api->requestType ?? '', $api->paramsExample ?? '');
        if($requestBody !== null) $operation['requestBody'] = $requestBody;

        if(($api->status ?? '') === 'deprecated') $operation['deprecated'] = true;

        return $operation;
    }

    /**
     * 构建操作 ID。
     * Build operation ID.
     *
     * @param  object $api 接口对象
     * @access private
     * @return string
     */
    private function buildOperationId($api)
    {
        $method = strtolower($api->method ?? 'get');
        $path   = preg_replace('/[^a-zA-Z0-9]+/', '_', $api->path ?? '');
        $path   = trim((string)$path, '_');
        $baseId = $path === '' ? $method : $method . '_' . $path;
        return $baseId . '_' . ($api->id ?? 0);
    }

    /**
     * 构建接口参数列表。
     * Build operation parameters.
     *
     * @param  array $params 接口参数列表
     * @access private
     * @return array
     */
    private function buildParameters($params, $pathParams = [])
    {
        $parameters = [];
        foreach(array('header', 'query') as $section)
        {
            foreach($this->flattenParameters(zget($params, $section, []), $section) as $param)
            {
                $in       = $section;
                $required = !empty($param['required']);

                if(isset($pathParams[$param['field']]) || (zget($param, 'in', '') === 'path'))
                {
                    $in       = 'path';
                    $required = true;
                }

                $parameters[] = array(
                    'name'        => $param['field'],
                    'in'          => $in,
                    'required'    => $required,
                    'description' => (string)zget($param, 'desc', ''),
                    'schema'      => $this->buildSchemaFromParam($param),
                );
            }
        }
        return $parameters;
    }

    /**
     * 构建请求体节点。
     * Build request body.
     *
     * @param  array  $params      接口参数列表
     * @param  string $requestType 请求类型
     * @access private
     * @return array|null
     */
    private function buildRequestBody($params, $requestType = '', $example = '')
    {
        $bodyParams = zget($params, 'params', []);
        if(empty($bodyParams) || !is_array($bodyParams)) return null;

        $hasField = !empty($bodyParams[0]['field'] ?? '');
        if($hasField)                    $schema = $this->buildObjectSchema($bodyParams);
        elseif(count($bodyParams) === 1) $schema = $this->buildSchemaFromParam($bodyParams[0]);
        else                             $schema = $this->buildObjectSchema($bodyParams);

        $contentType = $requestType !== '' ? $requestType : 'application/json';

        $mediaType = array('schema' => $schema);
        if($example !== '')
        {
            $decodedExample = htmlspecialchars_decode($example);
            $decoded        = json_decode($decodedExample, true);
            $mediaType['example'] = $decoded !== null ? $decoded : $decodedExample;
        }

        return array(
            'content' => array( $contentType => $mediaType),
        );
    }

    /**
     * 构建响应节点。
     * Build operation responses.
     *
     * @param  array  $response     响应参数列表
     * @param  string $responseType 响应类型
     * @access private
     * @return array
     */
    private function buildResponses($response, $responseType = '', $example = '')
    {
        $responses = array('200' => array('description' => 'Success'));

        if(!empty($response) && is_array($response))
        {
            $mediaType = $responseType !== '' ? $responseType : 'application/json';
            $media     = array('schema' => $this->buildObjectSchema($response));

            if($example !== '')
            {
                $decodedExample = htmlspecialchars_decode($example);
                $decoded        = json_decode($decodedExample, true);
                $media['example'] = $decoded !== null ? $decoded : $decodedExample;
            }

            $responses['200']['content'] = array($mediaType => $media);
        }

        return $responses;
    }

    /**
     * 从参数项构建 schema。
     * Build schema from a parameter item.
     *
     * @param  array $param 参数项
     * @access private
     * @return array
     */
    private function buildSchemaFromParam($param)
    {
        $type = strtolower((string)zget($param, 'paramsType', 'string'));
        $ref  = (string)zget($param, 'customType', zget($param, 'ref', ''));
        if($type === 'ref' && $ref !== '') return array('$ref' => '#/components/schemas/' . $ref);

        $schema = $this->mapTypeToSchema($type);
        $desc   = (string)zget($param, 'desc', '');
        if($desc !== '') $schema['description'] = $desc;

        if(array_key_exists('default', $param) && $param['default'] !== '') $schema['default'] = $param['default'];
        if(array_key_exists('example', $param) && $param['example'] !== '') $schema['examples'] = array($param['example']);

        $children = zget($param, 'children', []);
        if(!is_array($children)) $children = [];

        if($type === 'object' && !empty($children))
        {
            $schema = $this->buildObjectSchema($children);
            if($desc !== '') $schema['description'] = $desc;
        }

        if($type === 'array')
        {
            if(empty($children)) $schema['items'] = array('type' => 'string');
            elseif(count($children) === 1 && empty($children[0]['field'])) $schema['items'] = $this->buildSchemaFromParam($children[0]);
            else $schema['items'] = $this->buildObjectSchema($children);
        }

        return $schema;
    }

    /**
     * 构建对象类型 schema。
     * Build object type schema.
     *
     * @param  array $params 参数列表
     * @access private
     * @return array
     */
    private function buildObjectSchema($params)
    {
        $schema   = array('type' => 'object', 'properties' => []);
        $required = [];

        foreach($params as $param)
        {
            $field = (string)zget($param, 'field', zget($param, 'name', ''));
            if($field === '') continue;

            $schema['properties'][$field] = $this->buildSchemaFromParam($param);
            if(!empty($param['required'])) $required[] = $field;
        }

        if(!empty($required)) $schema['required'] = array_values(array_unique($required));
        return $schema;
    }

    /**
     * 构建组件节点。
     * Build components section.
     *
     * @param  array $structs 数据结构列表
     * @access private
     * @return array
     */
    private function buildComponents($structs)
    {
        $schemas = [];
        foreach($structs as $struct)
        {
            $attributes = $struct->attribute ?? [];
            if(is_string($attributes)) $attributes = json_decode($attributes, true);
            if(!is_array($attributes)) $attributes = [];

            $schema = $this->buildObjectSchema($attributes);
            $desc   = $struct->desc ?? '';
            if($desc !== '') $schema['description'] = $desc;

            $schemas[(string)$struct->name] = $schema;
        }

        ksort($schemas);
        return array('schemas' => $schemas);
    }

    /**
     * 展平嵌套参数列表。
     * Flatten nested parameters.
     *
     * @param  array  $params  参数列表
     * @param  string $section 参数位置（header/query）
     * @param  string $prefix  前缀
     * @access private
     * @return array
     */
    private function flattenParameters($params, $section, $prefix = '')
    {
        $result = [];
        foreach($params as $param)
        {
            if(!is_array($param)) continue;

            $field = (string)zget($param, 'field', zget($param, 'name', ''));
            if($field === '') continue;

            $param['field'] = $prefix === '' ? $field : $prefix . '.' . $field;
            $result[] = $param;

            $children = zget($param, 'children', []);
            if(!empty($children) && is_array($children))
            {
                foreach($this->flattenParameters($children, $section, $param['field']) as $child) $result[] = $child;
            }
        }

        return $result;
    }

    /**
     * 将数据类型映射为 schema。
     * Map data type to schema.
     *
     * @param  string $type 数据类型
     * @access private
     * @return array
     */
    private function mapTypeToSchema($type)
    {
        $map = array(
            'string'   => array('type' => 'string'),
            'date'     => array('type' => 'string', 'format' => 'date'),
            'datetime' => array('type' => 'string', 'format' => 'date-time'),
            'boolean'  => array('type' => 'boolean'),
            'int'      => array('type' => 'integer', 'format' => 'int32'),
            'long'     => array('type' => 'integer', 'format' => 'int64'),
            'float'    => array('type' => 'number',  'format' => 'float'),
            'double'   => array('type' => 'number',  'format' => 'double'),
            'decimal'  => array('type' => 'string', 'format' => 'decimal'),
            'number'   => array('type' => 'number'),
            'file'     => array('type' => 'string', 'format' => 'binary'),
            'array'    => array('type' => 'array'),
            'object'   => array('type' => 'object'),
        );

        return zget($map, $type, array('type' => 'string'));
    }

    /**
     * 根据 OpenAPI 版本后处理文档。
     * Post-process document for version compatibility.
     *
     * @param  array $doc 文档内容
     * @access private
     * @return array
     */
    private function postProcessForVersion($doc)
    {
        if($this->version === '3.2.0') return $doc;

        if(!empty($doc['tags']))
        {
            foreach($doc['tags'] as &$tag)
            {
                unset($tag['parent']);
                unset($tag['kind']);
            }

            unset($tag);
        }
        if($this->version === '3.0.4')
        {
            unset($doc['jsonSchemaDialect']);
            $doc = $this->normalizeFor30($doc);
        }

        return $doc;
    }

    /**
     * 将文档适配为 OpenAPI 3.0 格式。
     * Normalize document for OpenAPI 3.0.
     *
     * @param  array $data 文档数据
     * @access private
     * @return array
     */
    private function normalizeFor30($data)
    {
        $result = [];
        foreach($data as $key => $value)
        {
            if(is_array($value)) $value = $this->normalizeFor30($value);

            if($key === 'examples' && is_array($value))
            {
                $result['example'] = reset($value);
                continue;
            }

            $result[$key] = $value;
        }

        return $result;
    }
}
