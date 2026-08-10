<?php
namespace zin;

$controlTypeList = $lang->workflowfield->controlTypeList;
unset($controlTypeList['label']);

jsVar('fieldName', $field->field);
jsVar('window.hiddenPlaceholder', $config->workflowfield->hiddenPlaceholder);
jsVar('window.defaultField', $config->workflowfield->default);
jsVar('window.maxField', $config->workflowfield->max);
jsVar('window.minField', $config->workflowfield->min);
jsVar('window.tips', $lang->workflowfield->tips);
jsVar('placeholder', $lang->workflowfield->placeholder);
jsVar('window.formulaLang', $lang->workflowfield->formula);
jsVar('determine', $lang->determine);
jsVar('window.expression', array());
jsVar('typeList', $config->workflowfield->typeList);
jsVar('fieldDefaultValue', $field->default);

if(!empty($groupPairs))
{
    jsVar('syncQuoteNoOptions', $lang->workflowfield->tips->syncQuoteNoOptions);
    jsVar('syncQuoteFields', $lang->workflowfield->tips->syncQuoteFields);
    jsVar('joinedGroupName', implode(',', $groupPairs));
}

if($field->type == 'decimal')
{
    list($integerDigits, $decimalDigits) = explode(',', $field->length);
}
else
{
    $integerDigits = $config->workflowfield->default->integerDigits;
    $decimalDigits = $config->workflowfield->default->decimalDigits;
}

$allTypeItems = array();
foreach($config->workflowfield->typeList as $typeClass => $typeList)
{
    foreach($typeList as $key => $label) $allTypeItems[$key] = $label;
}

$optionType     = (is_array($field->options)) ? 'custom' : $field->options;
$optionDisabled = ($field->field == 'subStatus' or $field->role == 'quote');

$statusList = array();
if(!$field->readonly && $field->field == 'subStatus')
{
    $statusField = $this->workflowfield->getByField($flow->module, 'status');
    if($statusField) $statusList = $this->workflowfield->getFieldOptions($statusField, false);
}

$tipsBox = null;
if(!empty($groupPairs))
{
    $groupName = implode(',', $groupPairs);
    $tips      = $lang->workflowfield->tips->syncQuoteNoOptions;
    if(in_array($field->control, $config->workflowfield->optionControls) && is_array($field->options)) $tips = $lang->workflowfield->tips->syncQuoteFields;
    $tips = sprintf($tips, $groupName);
    $tipsBox = div(setID('tipsBox'), setClass('alert alert-warning'), $tips);
}

$controlDisabled = (in_array($field->field, array('status', 'subStatus')) || $config->db->driver != 'mysql' || $field->role == 'quote' || $field->readonly == '1');

$optionBlock = null;
if(!$field->readonly)
{
    if($field->field == 'subStatus')
    {
        $subStatusBody = null;
        if(empty($statusList))
        {
            $subStatusBody = div(setClass('text-red'), $lang->workflowfield->tips->emptyStatus);
        }
        else
        {
            $bodyRows = array();
            foreach($statusList as $parentCode => $parentName)
            {
                if(!$parentName) continue;

                $subStatusData = zget($field->options, $parentCode, array());
                $default       = zget($subStatusData, 'default', '');
                $options       = zget($subStatusData, 'options', array());
                $optionRows    = array();

                if(is_array($options))
                {
                    if(empty($options)) $options = array('' => '');
                    $hiddenSort = count($options) == 1 ? 'hidden' : '';
                    foreach($options as $code => $name)
                    {
                        $optionRows[] = inputGroup(
                            span(setClass('statusKey input-group-addon'), $lang->workflowfield->key),
                            input(
                                set::name("optionCode[$parentCode][]"),
                                set::value($code)
                            ),
                            span(setClass('input-group-addon'), $lang->workflowfield->value),
                            input(
                                set::name("optionName[$parentCode][]"),
                                set::value($name)
                            ),
                            span(setClass("input-group-btn sort-btn $hiddenSort"),
                                a(
                                    setClass('btn sortItem'),
                                    set::href('javascript:;'),
                                    html("<i class='icon-move'></i>")
                                )
                            ),
                            span(setClass('input-group-btn'),
                                a(
                                    setClass('btn addItem'),
                                    set::href('javascript:;'),
                                    html("<i class='icon-plus'></i>")
                                )
                            ),
                            span(setClass('input-group-btn'),
                                a(
                                    setClass('btn delItem'),
                                    set::href('javascript:;'),
                                    html("<i class='icon-trash'></i>")
                                )
                            ),
                            span(setClass('input-group-addon'),
                                html(html::radio("optionDefault[$parentCode]", array($code => $lang->workflowfield->defaultSubStatus), $default))
                            )
                        );
                    }
                }
                else
                {
                    $optionRows[] = inputGroup(
                        span(setClass('statusKey input-group-addon'), $lang->workflowfield->key),
                        input(
                            set::name("optionCode[$parentCode][]"),
                            set::value('')
                        ),
                        span(setClass('input-group-addon'), $lang->workflowfield->value),
                        input(
                            set::name("optionName[$parentCode][]"),
                            set::value('')
                        ),
                        span(setClass('input-group-btn sort-btn hidden'),
                            a(
                                setClass('btn sortItem'),
                                set::href('javascript:;'),
                                html("<i class='icon-move'></i>")
                            )
                        ),
                        span(setClass('input-group-btn'),
                            a(
                                setClass('btn addItem'),
                                set::href('javascript:;'),
                                html("<i class='icon-plus'></i>")
                            )
                        ),
                        span(setClass('input-group-btn'),
                            a(
                                setClass('btn delItem'),
                                set::href('javascript:;'),
                                html("<i class='icon-trash'></i>")
                            )
                        ),
                        span(setClass('input-group-addon'),
                            html(html::radio("optionDefault[$parentCode]", array('default' => $lang->workflowfield->defaultSubStatus)))
                        )
                    );
                }

                $bodyRows[] = h('tr',
                    h('td', setClass('text-left status-td'),
                        $parentName,
                        formHidden('parentCode[]', $parentCode),
                        formHidden('parentName[]', $parentName)
                    ),
                    h('td', setClass('sortTd'),
                        $optionRows,
                        div(setID("optionDefault{$parentCode}"))
                    )
                );
            }

            $subStatusBody = h('table', setClass('table table-form table-bordered'),
                h('thead',
                    h('tr', setClass('text-left'),
                        h('th', $lang->workflowfield->status),
                        h('th', $lang->workflowfield->subStatus)
                    )
                ),
                h('tbody', $bodyRows)
            );
        }

        $optionBlock = formGroup(
            setID('optionTR'),
            set::width('full'),
            set::label($lang->workflowfield->options),
            div(
                setClass('subStatusTd'),
                $subStatusBody,
                div(setID('optionsDIV'))
            )
        );
    }
    else
    {
        $optionRows = array();
        $options    = (!empty($field->options) && is_array($field->options)) ? $field->options : ['' => ''];
        foreach($options as $code => $name)
        {
            $optionRows[] = formGroup(
                set::width('full'),
                setClass('optionGroup'),
                set::label(''),
                inputGroup(
                    $lang->workflowfield->key,
                    input(
                        set::name('options[code][]'),
                        set::value($code),
                        set::placeholder($lang->workflowfield->placeholder->optionCode)
                    ),
                    $lang->workflowfield->value,
                    input(
                        set::name('options[name][]'),
                        set::value($name)
                    ),
                    a(
                        setClass('btn sortItem'),
                        set::href('javascript:;'),
                        html("<i class='icon-move'></i>")
                    ),
                    a(
                        setClass('btn addItem'),
                        set::href('javascript:;'),
                        html("<i class='icon-plus'></i>")
                    ),
                    a(
                        setClass('btn delItem'),
                        set::href('javascript:;'),
                        html("<i class='icon-trash'></i>")
                    )
                )
            );
        }
        $optionBlock = formGroup(
            setID('optionTR'),
            set::width('full'),
            setClass('optionGroupWrap hide-in-file'),
            set::label($lang->workflowfield->options),
            div(
                setClass('option-rows-sortable sortTd'),
                $optionRows
            )
        );
    }
}

if($field->readonly)
{
    formPanel(
        set::title($lang->workflowfield->edit),
        set::modeSwitcher(false),
        set::showExtra(false),
        set::formID('editFieldForm'),
        set::formClass('fieldForm'),
        set::submitBtnText($lang->save),
        set::actions(array('submit')),
        formGroup(
            set::width('1/2'),
            set::label($lang->workflowfield->name),
            input(
                set::name('name'),
                set::value($field->name),
                set::disabled($field->role == 'quote')
            )
        ),
        $tipsBox ? formGroup(set::width('full'), $tipsBox) : null
    );
}
else
{
    $lengthInput = control(
            set::type('number'),
            set::name('length'),
            set::max($config->workflowfield->max->varcharLength),
            set::min($config->workflowfield->min->varcharLength),
            set::value($field->length)
        );

    $integerDigitsInput = control(
            set::type('number'),
            set::name('integerDigits'),
            set::max($config->workflowfield->max->integerDigits),
            set::min($config->workflowfield->min->integerDigits),
            set::value($integerDigits)
        );

    $decimalDigitsInput = control(
            set::type('number'),
            set::name('decimalDigits'),
            set::max($config->workflowfield->max->decimalDigits),
            set::min($config->workflowfield->min->decimalDigits),
            set::value($decimalDigits)
        );

    formPanel(
        set::title($lang->workflowfield->edit),
        set::modeSwitcher(false),
        set::showExtra(false),
        set::formID('editFieldForm'),
        set::formClass('fieldForm'),
        set::submitBtnText($lang->save),
        set::actions(array('submit')),
        on::change('[name="control"]', 'changeControl'),
        on::change('[name="type"]', 'changeType'),
        on::change('[name="length"]', 'changeLength'),
        on::change('[name="integerDigits"]', 'changeLength'),
        on::change('[name="decimalDigits"]', 'changeLength'),
        on::change('[name="optionType"]', 'changeOptionType'),
        on::change('[name^=options]', 'setDefaultControl'),
        on::change('#sql', 'setDefaultControl'),
        on::click('.addItem', 'addItem'),
        on::click('.delItem', 'delItem'),
        formGroup(
            set::width('1/2'),
            set::label($lang->workflowfield->name),
            input(
                set::name('name'),
                set::value($field->name),
                set::disabled($field->role == 'quote')
            )
        ),
        formGroup(
            set::width('1/2'),
            set::label($lang->workflowfield->field),
            input(
                set::name('field'),
                set::value($field->field),
                set::placeholder($lang->workflowfield->placeholder->code),
                set::disabled(true)
            )
        ),
        formGroup(
            set::width('1/2'),
            set::label($lang->workflowfield->control),
            $controlDisabled ? formHidden('control', $field->control) : null,
            picker(
                set::name('control'),
                set::id('control'),
                set::items($controlTypeList),
                set::required(true),
                set::value($field->control),
                set::disabled($controlDisabled)
            )
        ),
        formRow(
            setClass('hide-in-file'),
            formGroup(
                set::width('1/2'),
                set::label($lang->workflowfield->type),
                $controlDisabled ? formHidden('type', $field->type) : null,
                picker(
                    set::name('type'),
                    set::id('type'),
                    set::items($allTypeItems),
                    set::required(true),
                    set::value($field->type),
                    set::disabled($controlDisabled)
                )
            ),
            formGroup(
                set::width('1/2'),
                setClass('varcharBox'),
                inputGroup(
                    $lang->workflowfield->length,
                    $lengthInput
                )
            ),
            formGroup(
                set::width('1/2'),
                setClass('integerBox hidden'),
                inputGroup(
                    $lang->workflowfield->integerDigits,
                    $integerDigitsInput,
                    $lang->workflowfield->decimalDigits,
                    $decimalDigitsInput
                )
            )
        ),
        div(setClass('dataTip text-warning hide-in-file')),
        formGroup(
            setClass('hidden hide-in-file'),
            set::width('full'),
            set::label($lang->workflowfield->expression),
            div(
                div(setClass('expression')),
                a(
                    setClass('set-expression btn ghost'),
                    set::href('javascript:;'),
                    $lang->workflowfield->formula->set
                ),
                input(set::type('hidden'), set::name('expression'), set::id('expression'), set::value($field->expression))
            )
        ),
        formGroup(
            setClass('hide-in-file'),
            set::width('1/2'),
            set::label($lang->workflowfield->datasource),
            $optionDisabled ? formHidden('optionType', $optionType) : null,
            picker(
                set::name('optionType'),
                set::id('optionType'),
                set::items($datasources),
                set::required(true),
                set::value($optionType),
                set::disabled($optionDisabled)
            )
        ),
        formGroup(
            setClass('sqlGroup sqlTR hidden hide-in-file'),
            set::width('full'),
            set::label($lang->workflowfield->sql),
            textarea(
                set::name('sql'),
                set::id('sql'),
                set::rows(4),
                set::value($field->sql),
                set::placeholder($lang->workflowfield->placeholder->sql)
            )
        ),
        $optionBlock,
        formGroup(
            setClass('hide-in-file'),
            set::label($lang->workflowfield->defaultValue),
            inputGroup(
                setClass('defaultBox'),
                input(
                    set::name('default'),
                    set::id('default'),
                    set::value($field->default)
                )
            )
        ),
        formGroup(
            setClass('tipInfoBox hide-in-file'),
            set::label($lang->workflowfield->tipInfo),
            input(
                set::name('placeholder'),
                set::value($field->placeholder),
            )
        ),
        div(setClass('default-tip text-warning hide-in-file'), $lang->workflowfield->tips->placeholder),
        formGroup(
            setClass('hide-in-file'),
            set::width('full'),
            set::label($lang->workflowfield->rules),
            picker(
                set::name('rules'),
                set::id('rules'),
                set::items($rules),
                set::multiple(true),
                set::value($field->rules)
            )
        ),
        $tipsBox ? formGroup(set::width('full'), set::label(''), $tipsBox) : null
    );
}

include __DIR__ . '/expression.html.php';