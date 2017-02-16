<?php
$options = array('S' => 'Sim', 'N' => 'Nao');
$attributes = array('legend' => false);
?>
<h1>Edit Article</h1>
<?php
    echo $this->Form->create($article);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '3']);
	echo $this->Form->radio('status', $options, $attributes); 
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
?>