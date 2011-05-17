<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('User', array('action' => 'login'));
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->end('Login');
?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Create New User Account', true), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List Listings', true), array('controller' => 'listings', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Listing', true), array('controller' => 'listings', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Messages', true), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Message', true), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>