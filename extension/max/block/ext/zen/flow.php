<?php
/**
 * 地盘欢迎区块追加自定义工作流指派统计。
 * Append custom workflow assigned statistics to the welcome block.
 *
 * @access protected
 * @return void
 */
protected function printWelcomeBlock()
{
    parent::printWelcomeBlock();

    $flows = $this->loadModel('my')->getFlowPairs();
    if(empty($flows)) return;

    foreach($flows as $module => $name)
    {
        $count = $this->loadModel('my')->getAssignedFlowCount($module);
        $link  = '';
        if(common::hasPriv('my', 'work') && $this->config->vision != 'lite')
        {
            $link = helper::createLink('my', 'work', "mode={$module}&type=assignedTo");
        }

        $this->lang->block->welcome->assignList[$module] = $name;
        $this->view->assignToMe[$module] = array('number' => $count, 'href' => $link);
    }
}
