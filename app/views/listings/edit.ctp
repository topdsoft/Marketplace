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
		if (count($this->Form->data['Image'])<4) echo $this->Html->link(__('Upload Image', true), array('action' => 'upload',$this->Form->value('Listing.id')));
		foreach($this->Form->data['Image'] as $img) {
			//loop for all images
			echo '<br><b>Filename:</b>'.$img['filename'];
			echo '<b>Uploaded:</b>'.$img['created'];
			echo $this->Html->link(__('Remove Image', true), array('action' => 'delImage',$img['id']));
			echo '<br>';
			echo $this->Html->image('../files/'.$img['filename']);
		}//end foreach Image
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete This Listing', true), array('action' => 'delete', $this->Form->value('Listing.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Listing.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Search Listings', true), array('action' => 'index'));?></li>
		<li><?php if($role>9) echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>