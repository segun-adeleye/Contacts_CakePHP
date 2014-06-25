<div class="contacts index">
	<h2><?php echo __('Contacts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<?php if ($current_user['role'] == 'admin'): ?>
				<th><?php echo $this->Paginator->sort('user_id', 'Added by'); ?></th>
			<?php endif; ?>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('number'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($contacts as $contact): ?>
	<?php if ($current_user['id'] == $contact['User']['id'] || $current_user['role'] == 'admin'): ?>
	<tr>
		<?php if ($current_user['role'] == 'admin'): ?>
		<td>
			<?php echo $this->Html->link(strtolower($contact['User']['username']), array('controller' => 'users', 'action' => 'view', $contact['User']['id'])); ?>
		</td>
		<?php endif; ?>
		<td><?php echo h($contact['Contact']['first_name']); ?>&nbsp;</td>
		<td><?php echo h(strtoupper($contact['Contact']['last_name'])); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['number']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['address']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['email']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['created']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $contact['Contact']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contact['Contact']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contact['Contact']['id']), array(), __('Are you sure you want to delete the contact?)); ?>
		</td>
	</tr>
<?php endif; ?>
<?php endforeach; ?>
	</tbody>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Contact'), array('action' => 'add')); ?></li>

	  <?php if($current_user['role'] == 'admin'): ?>
		  <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
	  <?php endif; ?>
		<li><?php echo $this->Html->link(__('Log out'), array('controller' => 'users', 'action' => 'logout')); ?>
		<?php if ($current_user['role'] == 'admin'): ?>
			<li><?php echo $this->Html->link(_('Admin'), array('controller' => 'users', 'action' => 'view', $current_user['id'])) ?></li>
		<?php else: ?>
			<li><?php echo $this->Html->link(_('View Your Profile'), array('controller' => 'users', 'action' => 'view', $current_user['id'])) ?></li>
		<?php endif; ?>
	</ul>
</div>
