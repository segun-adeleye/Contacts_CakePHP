<div>
  <?php echo $this->Form->create('User'); ?>
  	<fieldset>
  		<legend><?php echo __('Create an account'); ?></legend>
  	<?php
  		echo $this->Form->input('first_name');
  		echo $this->Form->input('last_name');
  		echo $this->Form->input('username');
  		echo $this->Form->input('gender', array('options' => array('female' => 'Female', 'male' => 'Male')));
  		echo $this->Form->input('email', array('value' => ''));
  		echo $this->Form->input('password', array('value' => ''));
  		echo $this->Form->input('confirm_password', array('type' => 'password'));
  	?>
  	</fieldset>
  <?php echo $this->Form->end(__('Submit')); ?>
</div>
