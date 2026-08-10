<?php
/**
 * The oasparser library of zentaobiz.
 */
class OasParser
{
    private array $supportedVersions = array('3.0', '3.1', '3.2');

    /**
     * 根据文件 ID 解析上传的 OpenAPI 文件。
     * Parse uploaded OpenAPI file by file ID.
     *
     * @param int $fileID
     * @return array|null
     */
    public function parseFile($fileID)
    {
        $file = $this->loadFile($fileID);
        if($file === null) return null;

        $raw = $this->decode($file['content'], $file['name']);
        if($raw === null) return null;
        if(!$this->validateStructure($raw)) return null;

        $raw = $this->resolveRefs($raw, $raw);

        return array(
            'version'      => $raw['openapi'] ?? '',
            'info'         => $this->parseInfo($raw),
            'servers'      => $this->parseServers($raw),
            'groupedPaths' => $this->groupByTag($raw),
            'components'   => $this->parseComponents($raw),
        );
    }

    /**
     * 直接解析字符串（测试用）。
     * Parse OpenAPI content from string.
     *
     * @param string $content
     * @param string $filename
     * @return array|null
     */
    public function parseString($content, $filename = 'api.yaml')
    {
        $raw = $this->decode($content, $filename);
        if($raw === null) return null;
        if(!$this->validateStructure($raw)) return null;

        $raw = $this->resolveRefs($raw, $raw);

        return array(
            'version'      => $raw['openapi'] ?? '',
            'info'         => $this->parseInfo($raw),
            'servers'      => $this->parseServers($raw),
            'groupedPaths' => $this->groupByTag($raw),
            'components'   => $this->parseComponents($raw),
        );
    }

    /**
     * 获取解析统计信息。
     * Get parsed document stats.
     *
     * @param array $parsed
     * @return array
     */
    public function getStats($parsed)
    {
        $totalPaths   = 0;
        $totalMethods = 0;

        foreach($parsed['groupedPaths'] as $paths)
        {
            foreach($paths as $methods)
            {
                $totalPaths++;
                $totalMethods += count($methods);
            }
        }

        return array(
            'title'      => $parsed['info']['title'],
            'version'    => $parsed['version'],
            'groups'     => count($parsed['groupedPaths']),
            'paths'      => $totalPaths,
            'operations' => $totalMethods,
            'schemas'    => count($parsed['components']['schemas'] ?? array()),
            'servers'    => count($parsed['servers']),
        );
    }

    /**
     * 按 operation 的 tags 分组；无 tag 时归入空分组。
     * Group paths by the first tag of each operation.
     *
     * @param array $raw
     * @return array
     */
    public function groupByTag($raw)
    {
        $groups = array();

        foreach($raw['paths'] ?? array() as $path => $methods)
        {
            if(!is_array($methods)) continue;

            foreach($methods as $method => $operation)
            {
                if(!is_array($operation)) continue;
                $method = strtolower($method);
                if(in_array($method, array('parameters', 'summary', 'description'))) continue;

                $tags  = $operation['tags'] ?? array();
                $group = !empty($tags) ? $tags[0] : '';

                $groups[$group][$path][$method] = $operation;
            }
        }

        return $groups;
    }

    /**
     * 验证是否为有效的 OpenAPI 3.x 文档。
     * Validate OpenAPI 3.x document structure.
     *
     * @param array $data
     * @return bool
     */
    private function validateStructure($data)
    {
        $version = $data['openapi'] ?? null;
        if(!$version) return false;

        $valid = false;
        foreach($this->supportedVersions as $sv) if(strpos($version, $sv) === 0) $valid = true;

        if(!$valid) return false;

        if(empty($data['paths']) || !is_array($data['paths'])) return false;

        return true;
    }

    /**
     * 解析文件内容，自动检测 JSON/YAML。
     * Decode content, auto-detect JSON or YAML.
     *
     * @param string $content
     * @param string $filename
     * @return array|null
     */
    private function decode($content, $filename)
    {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if($ext === 'yaml') return $this->decodeYaml($content);
        if($ext === 'json') return $this->decodeJson($content);

        $json = json_decode($content, true);
        if(json_last_error() === JSON_ERROR_NONE) return $json;

        return $this->decodeYaml($content);
    }

    /**
     * JSON 解码。
     * Decode JSON string.
     *
     * @param string $content
     * @return array|null
     */
    private function decodeJson($content)
    {
        $data = json_decode($content, true);
        return json_last_error() === JSON_ERROR_NONE ? $data : null;
    }

    /**
     * YAML 解码（使用 Spyc）。
     * Decode YAML string using Spyc library.
     *
     * @param string $content
     * @return array|null
     */
    private function decodeYaml($content)
    {
        $spyc = $this->loadSpyc();
        if($spyc === null) return null;

        $data = $spyc->YAMLLoadString($content);
        return is_array($data) ? $data : null;
    }

    /**
     * 加载 Spyc YAML 库。
     * Load Spyc YAML library.
     *
     * @return Spyc|null
     */
    private function loadSpyc()
    {
        $app = $GLOBALS['app'] ?? null;
        if($app === null) return null;

        return $app->loadClass('spyc');
    }

    /**
     * 解析 info 块。
     * Parse OpenAPI info block.
     *
     * @param array $raw
     * @return array
     */
    private function parseInfo($raw)
    {
        $info = $raw['info'] ?? array();
        return array(
            'title'       => $info['title'] ?? '',
            'version'     => $info['version'] ?? '1.0.0',
            'description' => $info['description'] ?? '',
        );
    }

    /**
     * 解析 servers 块。
     * Parse OpenAPI servers block.
     *
     * @param array $raw
     * @return array
     */
    private function parseServers($raw)
    {
        return $raw['servers'] ?? array();
    }

    /**
     * 解析 components 块。
     * Parse OpenAPI components block.
     *
     * @param array $raw
     * @return array
     */
    private function parseComponents($raw)
    {
        if(!empty($raw['components'])) return $raw['components'];
        return array();
    }

    /**
     * 递归解析本地 $ref 引用。
     * Resolve local $ref references recursively.
     *
     * @param array $node
     * @param array $root
     * @param int   $depth
     * @return array
     */
    private function resolveRefs($node, $root, $depth = 0)
    {
        if($depth > 20) return array('type' => 'object');

        foreach($node as $key => &$value)
        {
            if($key === '$ref' && is_string($value) && strpos($value, '#/') === 0)
            {
                $target = $this->getRefTarget($value, $root);
                if($target !== null) return $this->resolveRefs($target, $root, $depth + 1);
                $node['type'] = 'string';
                unset($node['$ref']);
                continue;
            }

            if(is_array($value))
            {
                $value = $this->resolveRefs($value, $root, $depth + 1);
            }
        }

        return $node;
    }

    /**
     * 根据 JSON Pointer 获取引用目标。
     * Get target node by JSON Pointer path.
     *
     * @param string $ref
     * @param array  $root
     * @return array|null
     */
    private function getRefTarget($ref, $root)
    {
        $parts = explode('/', trim($ref, '#/'));
        $node  = $root;

        foreach($parts as $part)
        {
            if(!isset($node[$part])) return null;
            $node = $node[$part];
        }

        return is_array($node) ? $node : null;
    }

    /**
     * 从系统文件表中读取文件内容。
     * Load file content from file table.
     *
     * @param int $fileID
     * @return array|null
     */
    private function loadFile($fileID)
    {
        $app = $GLOBALS['app'] ?? null;
        if($app === null) return null;

        $file = $app->loadModel('file')->getByID($fileID);
        if(empty($file)) return null;

        $content = $app->loadModel('file')->getContent($file);
        if($content === false || $content === null) return null;

        return array('content' => $content, 'name' => $file->title . '.' . $file->extension);
    }
}
