<div class="categories index">
	<h2><?php __('Categories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>ID<?php //echo $this->Paginator->sort('id');?></th>
			<th><?php //echo $this->Paginator->sort('root_id');?></th>
			<th>Category<?php //echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($categories as $id => $category):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $id; ?>&nbsp;</td>
		<td><?php //echo $category['Category']['root_id']; ?>&nbsp;</td>
		<td><?php echo $category; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $id)); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $id)); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $id), null, sprintf(__('Are you sure you want to delete # %s?', true), $id)); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
/*	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));//*/
	?>	</p>

	<div class="paging">
		<?php //echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php //echo $this->Paginator->numbers();?>
 |
		<?php //echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Category', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Search Listings', true), array('controller' => 'listings', 'action' => 'index')); ?> </li>
	</ul>
</div>