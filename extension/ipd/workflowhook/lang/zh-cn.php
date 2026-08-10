<?php
$lang->workflowhook->common = '工作流扩展动作';
$lang->workflowhook->browse = '浏览扩展动作';
$lang->workflowhook->create = '添加扩展动作';
$lang->workflowhook->edit   = '编辑扩展动作';
$lang->workflowhook->delete = '删除扩展动作';

$lang->workflowhook->condition = '触发条件';
$lang->workflowhook->hook      = '扩展动作';
$lang->workflowhook->type      = '条件类型';
$lang->workflowhook->result    = '条件结果';
$lang->workflowhook->sql       = 'SQL';
$lang->workflowhook->varName   = '变量名';
$lang->workflowhook->varValue  = '变量值';
$lang->workflowhook->action    = '操作';
$lang->workflowhook->table     = '表';
$lang->workflowhook->field     = '字段';
$lang->workflowhook->value     = '值';
$lang->workflowhook->where     = '条件';
$lang->workflowhook->message   = '提示信息';

$lang->workflowhook->confirmDelete = '您确定要执行删除操作吗？';

$lang->workflowhook->tables['product']     = $lang->productCommon;
$lang->workflowhook->tables['project']     = $lang->executionCommon;
$lang->workflowhook->tables['storyspec']   = '需求描述';
$lang->workflowhook->tables['file']        = '附件';
$lang->workflowhook->tables['action']      = '历史记录';
$lang->workflowhook->tables['attend']      = '考勤';
$lang->workflowhook->tables['branch']      = '平台/分支';
$lang->workflowhook->tables['deploy']      = '上线';
$lang->workflowhook->tables['dept']        = '部门';
$lang->workflowhook->tables['effort']      = '日志';
$lang->workflowhook->tables['faq']         = 'FAQ';
$lang->workflowhook->tables['holiday']     = '节假日';
$lang->workflowhook->tables['host']        = '主机';
$lang->workflowhook->tables['leave']       = '请假';
$lang->workflowhook->tables['lieu']        = '调休';
$lang->workflowhook->tables['makeup']      = '补办';
$lang->workflowhook->tables['overtime']    = '加班';
$lang->workflowhook->tables['score']       = '积分';
$lang->workflowhook->tables['serverroom']  = '机房';
$lang->workflowhook->tables['service']     = '服务';
$lang->workflowhook->tables['testreport']  = '测试报告';
$lang->workflowhook->tables['todo']        = '待办';
$lang->workflowhook->tables['trip']        = '出差';
$lang->workflowhook->tables['user']        = '用户';

$lang->workflowhook->typeList['data'] = '以数据作为校验方式';
$lang->workflowhook->typeList['sql']  = '以SQL语句作为校验方式';

$lang->workflowhook->resultList['empty']    = '查询结果为空或0时通过校验';
$lang->workflowhook->resultList['notempty'] = '查询结果不为空和0时通过校验';

$lang->workflowhook->logicalOperatorList['and'] = '并且';
$lang->workflowhook->logicalOperatorList['or']  = '或者';

$lang->workflowhook->actionList['insert'] = '新增';
$lang->workflowhook->actionList['update'] = '修改';
$lang->workflowhook->actionList['delete'] = '删除';

$lang->workflowhook->options['currentUser'] = '当前用户';
$lang->workflowhook->options['currentDept'] = '当前部门';
$lang->workflowhook->options['deptManager'] = '部门经理';
$lang->workflowhook->options['actor']       = '操作人';
$lang->workflowhook->options['today']       = '操作日期';
$lang->workflowhook->options['now']         = '操作时间';
$lang->workflowhook->options['formula']     = '公式';

$lang->workflowhook->placeholder = new stdclass();
$lang->workflowhook->placeholder->sql = '直接写入一条SQL查询语句，只能进行查询操作。';

$lang->workflowhook->error = new stdclass();
$lang->workflowhook->error->wrongSQL = 'SQL语句有错！错误：';

/* Formula */
$lang->workflowhook->formula = new stdclass();
$lang->workflowhook->formula->common    = '公式';
$lang->workflowhook->formula->target    = '计算对象';
$lang->workflowhook->formula->operator  = '计算符号';
$lang->workflowhook->formula->numbers   = '数字';
$lang->workflowhook->formula->clearLast = '删除';
$lang->workflowhook->formula->clearAll  = '清空';
$lang->workflowhook->formula->set       = '设置公式';

$lang->workflowhook->formula->functions['sum']     = '%s_%s_合计值';
$lang->workflowhook->formula->functions['average'] = '%s_%s_平均值';
$lang->workflowhook->formula->functions['max']     = '%s_%s_最大值';
$lang->workflowhook->formula->functions['min']     = '%s_%s_最小值';
$lang->workflowhook->formula->functions['count']   = '%s_%s_计数';

$lang->workflowhook->formula->error = new stdclass();
$lang->workflowhook->formula->error->empty = '请为公式设置计算方式';
$lang->workflowhook->formula->error->error = '公式存在错误，请检查后再保存';
