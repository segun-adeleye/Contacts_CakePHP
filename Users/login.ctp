<h2>User login</h2>

<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create();
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->end('Sign in');
?>
Are you a new user? <?php echo $this->Html->link(__('Register'), array('action' => 'register')); ?>
