<div class="row">
	<?php
	   echo $this->Form->create("Localizations");
	   echo $this->Form->radio("locale",[
	      ['value'=>'en_US','text'=>'English'],
	      ['value'=>'es_ES','text'=>'Español'],
	      ['value'=>'fr_FR','text'=>'French'],
	      ['value'=>'pt_PT','text'=>'Português'],
	   ]);
	   echo $this->Form->button('Change Language');
	   echo $this->Form->end();
	?>
</div>