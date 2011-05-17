<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Role'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['role']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Listings', true), array('controller' => 'listings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listing', true), array('controller' => 'listings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Messages', true), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message', true), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Listings');?></h3>
	<?php if (!empty($user['Listing'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Closed'); ?></th>
		<th><?php __('Text'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Location Id'); ?></th>
		<th><?php __('Category Id'); ?></th>
		<th><?php __('Relist Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Listing'] as $listing):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $listing['id'];?></td>
			<td><?php echo $listing['user_id'];?></td>
			<td><?php echo $listing['name'];?></td>
			<td><?php echo $listing['created'];?></td>
			<td><?php echo $listing['closed'];?></td>
			<td><?php echo $listing['text'];?></td>
			<td><?php echo $listing['amount'];?></td>
			<td><?php echo $listing['location_id'];?></td>
			<td><?php echo $listing['category_id'];?></td>
			<td><?php echo $listing['relist_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'listings', 'action' => 'view', $listing['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'listings', 'action' => 'edit', $listing['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'listings', 'action' => 'delete', $listing['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listing['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Listing', true), array('controller' => 'listings', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Messages');?></h3>
	<?php if (!empty($user['Message'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('From Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Read'); ?></th>
		<th><?php __('Text'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Message'] as $message):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $message['id'];?></td>
			<td><?php echo $message['user_id'];?></td>
			<td><?php echo $message['from_id'];?></td>
			<td><?php echo $message['created'];?></td>
			<td><?php echo $message['read'];?></td>
			<td><?php echo $message['text'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'messages', 'action' => 'view', $message['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'messages', 'action' => 'edit', $message['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'messages', 'action' => 'delete', $message['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $message['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Message', true), array('controller' => 'messages', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
