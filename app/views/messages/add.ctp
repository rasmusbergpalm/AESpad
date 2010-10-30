<div class="types form">
<?php echo $form->create('Message');?>
	<fieldset>
 		<legend><?php __('Add Message');?></legend>
	<?php
		echo $form->input('Chat');
		echo $form->input('author');
		echo $form->input('message');
	?>
	</fieldset>
    <div class="cancel"><?php echo $html->link(__('Cancel', true), array('action'=>'index'));?></div>
<?php echo $form->end('Submit');?>
</div>