<div class="listings index">
<?php echo $this->Form->create('Listing');?>
	<h2><?php __('Listings');?></h2>
	<?php echo $this->Form->input('search'); echo $this->Form->submit('Search Listings') ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php if ($role>9) echo $this->Paginator->sort('id');?></th>
			<th><?php if ($role>9) echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php if ($role>9) echo $this->Paginator->sort('closed');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('location_id');?></th>
			<th><?php echo $this->Paginator->sort('category_id');?></th>
			<th><?php if ($role>9) echo $this->Paginator->sort('relist_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($listings as $listing):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php if ($role>9) echo $listing['Listing']['id']; ?>&nbsp;</td>
		<td>
			<?php if ($role>9) echo $this->Html->link($listing['User']['username'], array('controller' => 'users', 'action' => 'view', $listing['User']['id'])); ?>
		</td>
		<td><?php echo $listing['Listing']['name']; ?>&nbsp;</td>
		<td><?php echo $listing['Listing']['created']; ?>&nbsp;</td>
		<td><?php if ($role>9) echo $listing['Listing']['closed']; ?>&nbsp;</td>
		<td><?php echo $listing['Listing']['amount']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($listing['Location']['name'], array('controller' => 'locations', 'action' => 'view', $listing['Location']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($listing['Category']['name'], array('controller' => 'categories', 'action' => 'view', $listing['Category']['id'])); ?>
		</td>
		<td><?php if ($role>9) echo $listing['Listing']['relist_id']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $listing['Listing']['id'])); ?>
			<?php if($uid==$listing['User']['id']) echo $this->Html->link(__('Edit', true), array('action' => 'edit', $listing['Listing']['id'])); ?>
			<?php if($uid==$listing['User']['id']) echo $this->Html->link(__('Delete', true), array('action' => 'delete', $listing['Listing']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listing['Listing']['id'])); ?>
			<?php if($uid>0 && $uid!=$listing['User']['id']) echo $this->Html->link(__('Contact', true), array('controller'=>'messages','action' => 'add', $listing['Listing']['user_id']), null); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<?php echo $this->Form->end();?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Listing', true), array('action' => 'add')); ?></li>
		<li><?php if ($role>0) echo $this->Html->link(__('Messages', true), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php if ($role>9) echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php if ($role>9) echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php if ($role>9) echo $this->Html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php if ($role>9) echo $this->Html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php if ($role>9) echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php if ($role>9) echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>