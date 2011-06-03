<div class="listings form">
<?php echo $this->Form->create('Listing',array('enctype'=>'multipart/form-data'));?>
<?php
//	echo '	<input type="hidden" name="MAX_FILE_SIZE" value="524288">';
	echo $this->Form->input('MAX_FILE_SIZE',array('type'=>'hidden','value'=>'524288'));
	echo '	<fieldset><legend>Select a JPEG or PNG image of 512KB or smaller to be uploaded:</legend>';
//	echo '	<p><b>File:</b> <input type="file" name="upload" /></p>';
	echo $this->Form->input('upload',array('type'=>'file','label'=>'File:'));
	echo ' 	</fieldset>';
//	echo '	<div align="center"><input type="submit" name="submit" value="Submit" /></div>';
//	echo '	<input type="hidden" name="submitted" value="TRUE" />';
//	echo "<input type='hidden' name='listingID' value='$listingID'>";
	echo $this->Form->input('listingID',array('type'=>'hidden','value'=>$listingID));
	echo $this->Form->input('submitted',array('type'=>'hidden','value'=>'true'));
	echo $this->Form->end(__('Submit', true));
?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Edit This Listing', true), array('action' => 'edit', $listingID)); ?></li>
		<li><?php echo $this->Html->link(__('Search Listings', true), array('action' => 'index'));?></li>
		<li><?php if($role>9) echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>