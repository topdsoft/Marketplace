<div class="messages form">
<?php echo $this->Form->create('Message');?>
	<fieldset>
		<legend><?php __('Add Message'); ?></legend>
	<?php
		echo "<strong>To User:</strong>{$uname['User']['username']}";
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$to_id));
		echo $this->Form->input('from_id',array('type'=>'hidden','value'=>$uid));
//		echo $this->Form->input('read');
		echo $this->Form->input('text',array('label'=>'Message'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Messages', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Search Listings', true), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>