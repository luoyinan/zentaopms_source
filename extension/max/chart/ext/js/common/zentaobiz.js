var filterValues = {};

window.latin1ToBase64 = function(str)
{
    const encoder = new TextEncoder();
    const latin1Array  = encoder.encode(str);
    const latin1String = String.fromCharCode.apply(null, latin1Array);
    return btoa(latin1String);
}

/**
 * Listen filter change.
 *
 * @param string field
 * @param string dateSelect
 * @param string $filterValue
 * @access public
 * @return void
 */
function filterChange(field, dateSelect, $filterValue)
{
    var parse = field.split('.');

    field = parse[0];
    var type = '';
    if(parse.length == 2) type = parse[1];
    var id = type.length == 0 ? field : field + '\\[' + type + '\\]';
    var value = $('#' + id).val();

    if(type.length == 0)
    {
        filterValues[field] = value;
        ajaxGetChart();
    }
    else
    {
        var check = checkDate(dateSelect, $filterValue);
        if(!check) return;
        if(!filterValues[field]) filterValues[field] = {begin: '', end: ''};

        filterValues[field][type] = value;

        var begin = filterValues[field].begin;
        var end   = filterValues[field].end;
        if((begin.length > 0 && end.length > 0) || (begin.length == 0 && end.length == 0)) ajaxGetChart();
    }
}

/**
 * Validate form required.
 *
 * @access public
 * @return void
 */
function validate(showError = false)
{
    var chart   = DataStorage.chart;
    var step    = DataStorage.step;
    var type    = chart.settings[0].type;
    var isReady = true;

    if(type == 'waterpolo')
    {
        isReady = validateWaterpolo(showError);
    }
    else
    {
        isReady = validateOther(showError);
    }

    if(!isReady)
    {
        $('#draw-tip').removeClass('hidden');
        $('#step' + step + 'Content').find('#draw-no-data').addClass('hidden');
        $('.btn-export').addClass('hidden');
    }
    if(isReady)
    {
        $('#draw-tip').addClass('hidden');
        $('.btn-export').removeClass('hidden');
    }

    return isReady;
}

function validateOther(showError)
{
    var chart        = DataStorage.chart;
    var formSettings = chart.settings[0];
    var type         = formSettings.type;
    var chartSetting = chartSettings[type];
    var multiColumn  = multiColumns[type];

    /* Code for temporary */
    var isReady = true;
    Object.keys(chartSetting).forEach(function(key)
    {
        chartSetting[key].forEach(function(setting)
        {
            var isMulti = multiColumn == setting.field;
            var title   = (type == 'pie' && setting.field == 'metric') ? chartLang.columnField : chartLang[type][setting.field];
            var error   = '<div id="' + setting.field + 'Label" class="text-danger help-text">' + notemptyLang.replace('%s', title) + '</div>';

            /* If this option is required and the option is multi-selected, call the multiValidate function. */
            /* 如果这个选项必填，并且这个选项是多选的, 调用multiValidate方法。*/
            if(setting.required && isMulti)
            {
                result = multiValidate(setting, showError);
                if(result == false) isReady = false;
            }
            else
            {
                $('#' + setting.field + 'Label').remove();
                $('#' + setting.field).removeClass('has-error');
                if(setting.required &&(!formSettings[setting.field] || formSettings[setting.field][0].field == ''))
                {
                    isReady = false;
                    if(showError)
                    {
                        $('#' + setting.field).addClass('has-error');
                        $('#' + setting.field).next().after(error);
                    }
                }
            }
        });
    });

    return isReady;
}

/**
 * Multi Validate.
 *
 * @param  setting $setting
 * @param  showError $showError
 * @access public
 * @return void
 */
function multiValidate(setting, showError)
{
    var chart = DataStorage.chart;
    var type = chart.settings[0].type;
    var isReady = true;
    var field = setting.field;
    var error = '<div id="' + field + 'Label"' + ' class="text-danger help-text">' + notemptyLang.replace('%s', chartLang.columnField) + '</div>';
    $('#chartForm .table-form').find('.multi-' + field).each(function()
    {
        $(this).parent('td').find('#' + field + 'Label').remove();
        $(this).parent('td').find('#' + field).removeClass('has-error');

        if(setting.required && $(this).val().length == 0)
        {
            isReady = false;
            if(showError)
            {
                $(this).parent('td').find('#' + field).addClass('has-error');
                $(this).parent('td').find('#' + field).next().after(error);
            }
        }
    });

    return isReady;
}

/**
 * Check date.
 *
 * @param  string dateSelect
 * @param  object $filterValue
 * @access public
 * @return void
 */
function checkDate(dateSelect, $filterValue)
{
    var begin = new Date($(dateSelect).parent().find('.default-begin').val().replace(/-/g, "\/")).getTime();
    var end   = new Date($(dateSelect).parent().find('.default-end').val().replace(/-/g, "\/")).getTime();
    if(begin > end)
    {
        $(dateSelect).val('');
        if(typeof $filterValue == 'object') $filterValue.val('');
        bootbox.alert(chartLang.beginGtEnd);
        return false;
    }
    return true;
}

function success(mes)
{
    var message = new $.zui.Messager(mes,
    {
        html: true,
        icon: 'check-circle',
        type: 'success',
        close: true,
    });

    message.show();
}

function resizeChart(step)
{
    var filterHeight = $('#step' + step + 'Content .display-content .cell #filterContent').height();
    $('#step' + step + 'Content .display-content .cell #draw').css('height', 'calc(100% - ' + (filterHeight + 16) + 'px)')
    if(echart) echart.resize();
}

/**
 * Ajax get chart data.
 *
 * @access public
 * @return bool
 */
function ajaxGetChart(check = true, chart = DataStorage.chart, echart = window.echart, noDataDom = window.noDataDom)
{
    var chartParams = JSON.parse(JSON.stringify(chart));
    if(typeof DataStorage != 'undefined') chartParams.fieldSettings = JSON.parse(JSON.stringify(DataStorage.fieldSettings));
    if(typeof DataStorage != 'undefined') chartParams.langs         = JSON.parse(JSON.stringify(DataStorage.langs));

    /* Redraw echart. */
    /* 拿数据并重绘图表。*/
    $.post(createLink('chart', 'ajaxGetChart'), chartParams, function(resp)
    {
        var data = JSON.parse(resp);
        if(echart)
        {
            var type = chartParams.settings[0].type;
            if(type == 'waterpolo')
            {
                data.series[0].label.formatter = function(params) { return (params.value * 100).toFixed(2) + '%';};
                data.tooltip.formatter         = function(params) { return (params.value * 100).toFixed(2) + '%';};
            }

            if(canLabelRotate.includes(type))
            {
                if(!data.xAxis.axisLabel) data.xAxis.axisLabel = {};
                if(!data.yAxis.axisLabel) data.yAxis.axisLabel = {};
                var labelFormatter = function(value)
                {
                    value = value.toString();
                    return (value.length <= labelMaxLength) ? value : value.substring(0, labelMaxLength) + '...';
                }

                data.xAxis.axisLabel.formatter = labelFormatter;
                data.yAxis.axisLabel.formatter = labelFormatter;
            }

            echart.resize();
            echart.clear();
            if(isChartHaveData(data, type))
            {
                echart.setOption(data, true);
                $('.btn-export').removeClass('hidden');
                noDataDom.addClass('hidden');
            }
            else
            {
                noDataDom.removeClass('hidden');
            }
        }
    });
}

/**
 * Init picker.
 *
 * @access public
 * @return void
 */
function initPicker($row, pickerName = 'picker-select', onready = false)
{
    $row.find('.' + pickerName).picker(
    {
        maxDropHeight: pickerHeight,
        onReady: function()
        {
            if(!onready) return;
            if(!$row.find('.picker')) return;
            if(window.getComputedStyle($row.find('.picker').find('.picker-selections')[0]).getPropertyValue('width') !== 'auto')
            {
                var pickerWidth = $row.find('.picker')[0].getBoundingClientRect().width;
                $row.find('.picker').find('.picker-selections').css('width', pickerWidth);
            }
        }
    });
    $row.find("." + pickerName).each(function(index)
    {
       if($(this).hasClass('required')) $(this).siblings("div .picker").addClass('required');
    });
}

/**
 * Determine whether the returned data is available.
 *
 * @access public
 * @return bool
 */
function isChartHaveData(dataInfo, type)
{
    if(type == 'waterpolo') return true;
    var data = [];
    if(type == 'pie') data = dataInfo.series[0].data;
    if(type == 'line') data = dataInfo.xAxis.data;
    if(type == 'radar') data = dataInfo.radar.indicator;
    if(type == 'cluBarY' || type == 'stackedBarY') data = dataInfo.yAxis.data;
    if(type == 'cluBarX' || type == 'stackedBar') data = dataInfo.xAxis.data;

    return data.length;
}

/**
 * Init datepicker.
 *
 * @param  object   $obj
 * @param  function callback
 * @access public
 * @return void
 */
function initDatepicker($obj, callback)
{
    $obj.find('.form-date').datepicker();
    $obj.find('.form-datetime').datetimepicker();

    if(typeof callback == 'function') callback($obj);
}

/**
 * Attr date check.
 *
 * @param  object $obj
 * @access public
 * @return void
 */
function attrDateCheck($obj)
{
    $obj.find('.form-date').attr('onchange', 'checkDate(this, this.value)');
    $obj.find('.form-datetime').attr('onchange', 'checkDate(this, this.value)');
}
