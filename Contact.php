<?php
App::uses('AppModel', 'Model');

class Contact extends AppModel {

	public $validate = array(
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			),
		),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			)
		),
		'number' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			)
		),
		'address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email')
			),
		),
	);

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);
}
