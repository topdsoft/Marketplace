<div class="getCat form">
<?php echo $this->Form->create('Listing');?>
	<fieldset>
		<legend><?php __('Choose Category'); ?></legend>
	<?php
//	debug($root);
	echo '<table>';
	if ($root) {
		//this is not the first division, so show back
		echo $this->Form->input('cat_id',array('type'=>'hidden','value'=>$cat));
		echo '<tr><th></th><th>Selected<br>Category</th><th>Sub Categories</th></tr>';
		echo '<td>';
		echo $this->Html->link('Back', array('action' => 'getCat', $root['parent_id'])).'</td>';
		echo "<td><strong>{$root['name']}</strong></td>";
	} else {
		echo '<tr><th>Main Categories</th></tr>';
	}//endif root
	echo '<td>';
	foreach ($catList as $line) {
		//loop for all categories
		$line=$line['categories'];
		echo $this->Html->link($line['name'], array('action' => 'getCat', $line['id'])).'<br>';
	}//end foreach
	echo '</td></table>';
	?>
	</fieldset>
<?php if ($cat) echo $this->Form->end(__('Use Category '.$root['name'], true));?>
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