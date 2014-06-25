<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	public $validate = array(
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			),
		),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			),
		),
		'username' => array(
			'rule' => 'notEmpty'
		),
		'password' => array(
			'Not_Empty' => array(
				'rule' => array('minLength', 6),
				'message' => 'Password must be at least six characters.'
			),
			'Match_Password' => array(
				'rule' => 'matchPasswords',
				'message' => 'Your passwords do not match.'
			)
		),
		'confirm_password' => array(
			'Not_Empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please confirm your password.'
			)
		),
		'email' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'This field is required.'
			)
		),
	);

	public function matchPasswords($data) {
		if ($data['password'] == $this->data['User']['confirm_password']) {
			return true;
		}
		$this->invalidate('confirm_password', 'Your passwords do not match.');
		return false;
	}

	public $hasMany = array(
		'Contact' => array(
			'className' => 'Contact',
			'foreignKey' => 'user_id',
			'dependent' => false
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}

}
