<div class="messages view">
<h2><?php  __('Message');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('From'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($message['From']['username'], array('controller' => 'messages', 'action' => 'add', $message['From']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Sent'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $message['Message']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Text'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo nl2br($message['Message']['text']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Message', true), array('action' => 'edit', $message['Message']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Message', true), array('action' => 'delete', $message['Message']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $message['Message']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Messages', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Reply', true), array('action' => 'add', $message['From']['id'] )); ?> </li>
	</ul>
</div>
