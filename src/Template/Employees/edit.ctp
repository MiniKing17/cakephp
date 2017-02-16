<?php
$options=array('S' => 'Sim', 'N' => 'Não');
$attributes = array('legend' => false);
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employee->employee_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $employee->employee_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employers'), ['controller' => 'Employers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employer'), ['controller' => 'Employers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee, array( 'enctype' => 'multipart/form-data')) ?>
    <fieldset>
        <legend><?= __('Edit Employee') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('idade');
            echo "Já trabalhou nesta área?";
            echo $this->Form->radio('area', $options, $attributes);
            echo $this->Form->input('employer_id', ['options' => $employers]);
            echo $this->Form->input('imagem', array('type' => 'file'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
