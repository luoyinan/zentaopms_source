<?php
namespace zin;

$controlTypeList = $lang->workflowfield->controlTypeList;
unset($controlTypeList['label']);

jsVar('window.hiddenPlaceholder', $config->workflowfield->hiddenPlaceholder);
jsVar('window.defaultField', $config->workflowfield->default);
jsVar('window.maxField', $config->workflowfield->max);
jsVar('window.minField', $config->workflowfield->min);
jsVar('window.tips', $lang->workflowfield->tips);
jsVar('window.placeholder', $lang->workflowfield->placeholder);
jsVar('window.formulaLang', $lang->workflowfield->formula);
jsVar('determine', $lang->determine);
jsVar('window.expression', array());
jsVar('typeList', $config->workflowfield->typeList);

formPanel(
    set::title($lang->workflowfield->create),
    set::modeSwitcher(false),
    set::showExtra(false),
    set::formID('fieldTable'),
    set::formClass('fieldForm'),
    set::submitBtnText($lang->save),
    set::actions(array('submit')),
    on::change('[name="control"]', 'changeControl'),
    on::change('[name="type"]', 'changeType'),
    on::change('[name="length"]', 'changeLength'),
    on::change('[name="integerDigits"]', 'changeLength'),
    on::change('[name="decimalDigits"]', 'changeLength'),
    on::change('[name="optionType"]', 'changeOptionType'),
    on::change('input[name^=options]', 'setDefaultControl'),
    on::change('#sql', 'setDefaultControl'),
    on::click('.addItem', 'addItem'),
    on::click('.delItem', 'delItem'),
    formGroup(
        set::width('1/2'),
        set::label($lang->workflowfield->name),
        set::required(true),
        set::name('name')
    ),
    formGroup(
        set::width('1/2'),
        set::label($lang->workflowfield->field),
        set::required(true),
        input(
            set::name('field'),
            set::placeholder($lang->workflowfield->placeholder->code)
        )
    ),
    formGroup(
        set::width('1/2'),
        set::label($lang->workflowfield->control),
        picker(
            set::name('control'),
            set::id('control'),
            set::items($controlTypeList),
            set::required(true),
            set::value('input')
        )
    ),
    formRow(
        setClass('hide-in-file'),
        formGroup(
            set::width('1/2'),
            set::label($lang->workflowfield->type),
            picker(
                set::name('type'),
                set::id('type'),
                set::items($config->workflowfield->typeList['varchar']),
                set::required(true),
                set::value('varchar')
            )
        ),
        formGroup(
            set::width('1/2'),
            setClass('varcharBox'),
            inputGroup(
                $lang->workflowfield->length,
                control(
                    set::type('number'),
                    set::name('length'),
                    set::max($config->workflowfield->max->varcharLength),
                    set::min($config->workflowfield->min->varcharLength),
                    set::value(255)
                )
            )
        ),
        formGroup(
            set::width('1/2'),
            setClass('integerBox hidden'),
            inputGroup(
                $lang->workflowfield->integerDigits,
                control(
                    set::type('number'),
                    set::name('integerDigits'),
                    set::max($config->workflowfield->max->integerDigits),
                    set::min($config->workflowfield->min->integerDigits),
                    set::value(10)
                ),
                $lang->workflowfield->decimalDigits,
                control(
                    set::type('number'),
                    set::name('decimalDigits'),
                    set::max($config->workflowfield->max->decimalDigits),
                    set::min($config->workflowfield->min->decimalDigits),
                    set::value(2)
                )
            )
        )
    ),
    div(setClass('dataTip text-warning hide-in-file'), set::id('dataTip')),
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
            input(set::type('hidden'), set::name('expression'), set::id('expression'))
        )
    ),
    formGroup(
        setClass('hidden hide-in-file'),
        set::width('1/2'),
        set::label($lang->workflowfield->datasource),
        picker(
            set::name('optionType'),
            set::id('optionType'),
            set::items($datasources),
            set::required(true),
            set::value('custom')
        )
    ),
    formGroup(
        setClass('sqlGroup hidden hide-in-file'),
        set::width('full'),
        set::label($lang->workflowfield->sql),
        textarea(
            set::name('sql'),
            set::id('sql'),
            set::rows(4),
            setClass('form-control'),
            set::placeholder($lang->workflowfield->placeholder->sql)
        )
    ),
    formGroup(
        set::width('full'),
        setClass('hidden optionGroupWrap hide-in-file'),
        set::label($lang->workflowfield->options),
        div(
            setClass('option-rows-sortable'),
            formGroup(
                set::width('full'),
                setClass('optionGroup'),
                set::label(''),
                inputGroup(
                    $lang->workflowfield->key,
                    input(
                        set::name('options[code][]'),
                        set::placeholder($lang->workflowfield->placeholder->optionCode)
                    ),
                    $lang->workflowfield->value,
                    input(
                        set::name('options[name][]')
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
            )
        )
    ),
    formGroup(
        setClass('hide-in-file'),
        set::label($lang->workflowfield->defaultValue),
        inputGroup(
            setClass('defaultBox'),
            input(
                set::name('default'),
                set::id('default')
            )
        )
    ),
    formGroup(
        setClass('tipInfoBox hide-in-file'),
        set::label($lang->workflowfield->tipInfo),
        input(
            set::name('placeholder')
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
            set::multiple(true)
        )
    )
);

include __DIR__ . '/expression.html.php';
