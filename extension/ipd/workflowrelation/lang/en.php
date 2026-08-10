<?php
$lang->workflowrelation->common           = 'Workflow Relation';
$lang->workflowrelation->admin            = 'Admin Relation';
$lang->workflowrelation->createForeignKey = 'Create';

$lang->workflowrelation->prev       = 'Prev Flow';
$lang->workflowrelation->next       = 'Next Flow';
$lang->workflowrelation->action     = 'Action';
$lang->workflowrelation->foreignKey = 'Foreign Key';

$lang->workflowrelation->relationActionList['one2one']   = 'One prev flow create one next flow';
$lang->workflowrelation->relationActionList['one2many']  = 'One prev flow create many next flows';
$lang->workflowrelation->relationActionList['many2one']  = 'Many prev flow create one next flow';
$lang->workflowrelation->relationActionList['many2many'] = 'Many prev flow create many next flows';

$lang->workflowrelation->tableWidth = 1000;

/* Tips */
$lang->workflowrelation->tips = new stdclass();
$lang->workflowrelation->tips->foreignKey = '<strong>Foreign key</strong> is the field used in the post-flow to associate and display the current flow data. The field set as the foreign key can only be a field of type <strong>Text</strong> or <strong>Number</strong>. After saving, the system will update the field type to <strong>Integer</strong> and convert existing data to 0.';

/* Error */
$lang->workflowrelation->error = new stdclass();
$lang->workflowrelation->error->existNextField = 'The field has been used in the relations of %s.';
