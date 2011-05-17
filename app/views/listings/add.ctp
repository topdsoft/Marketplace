<div class="listings form">
<?php echo $this->Form->create('Listing');?>
	<fieldset>
		<legend><?php __('Add Listing'); ?></legend>
	<?php
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$this->Session->read('Auth.User.id')));
		echo '<p><strong>Category:</strong>'.$catName.'</p>';
		echo $this->Form->input('name',array('label'=>'Title for Listing'));
//		echo $this->Form->input('closed');
		echo $this->Form->input('text');
		echo $this->Form->input('amount');
		echo $this->Form->input('location_id');
		echo $this->Form->input('category_id',array('type'=>'hidden','value'=>$cat));
//		echo $this->Form->input('relist_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Search Listings', true), array('action' => 'index'));?></li>
		<li><?php if($role>9) echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>