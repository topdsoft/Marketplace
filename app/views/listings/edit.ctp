<div class="listings form">
<?php echo $this->Form->create('Listing');?>
	<fieldset>
		<legend><?php __('Edit Listing'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id',array('type'=>'hidden'));
		echo $this->Form->input('name');
//		echo $this->Form->input('closed');
		echo $this->Form->input('text');
		echo $this->Form->input('amount');
		echo $this->Form->input('location_id');
		echo $this->Form->input('category_id');
//		echo $this->Form->input('relist_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Listing.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Listing.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Listings', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>