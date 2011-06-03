<div class="listings view">
<h2><?php  __('Listing');?></h2>
	<?php 
		echo '<dl>';
		echo "<strong>{$listing['Listing']['name']}</strong><br>";
		$text=nl2br($listing['Listing']['text']);
		echo $text;
		echo "<br><small>Listed {$listing['Listing']['created']} in $catName</small>";
		foreach($listing['Image'] as $img) echo '<br>'.$this->Html->image('../files/'.$img['filename']);
		echo '</dl>';
	?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php if($uid==$listing['User']['id']) echo $this->Html->link(__('Edit Listing', true), array('action' => 'edit', $listing['Listing']['id'])); ?> </li>
		<li><?php if($uid==$listing['User']['id']) echo $this->Html->link(__('Delete Listing', true), array('action' => 'delete', $listing['Listing']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listing['Listing']['id'])); ?> </li>
		<li><?php if($uid!=$listing['User']['id']) echo $this->Html->link(__('Contact Seller', true), array('controller' => 'messages','action' => 'add', $listing['Listing']['user_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Search Listings', true), array('action' => 'index')); ?> </li>
		<li><?php if($role>0) echo $this->Html->link(__('New Listing', true), array('action' => 'add')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php if($role>9) echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
