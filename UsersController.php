<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $helpers = array('Html', 'Form', 'Session', 'Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('logout', 'register');
	}

	public $components = array('Paginator', 'Session', 'Auth');

	public function index() {
		$this->set('title_for_layout', 'Registered Users');
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect(array('controller' => 'contacts', 'action' => 'index'));
			}
			$this->Session->setFlash('Your username/password is incorrect.');
		}
		$this->set('title_for_layout', 'Contacts: Login');
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);
		$this->set('user', $user);
		$this->set('title_for_layout', 'Profile: '.$user['User']['first_name'].' '.$user['User']['last_name']);
	}

	public function register() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'login'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$this->set('title_for_layout', 'Contacts: Sign Up');
	}

	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Update successful.'));
				return $this->redirect(array('controller' => 'contacts', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$user = $this->User->find('first', $options);
			$this->request->data = $user;
			$this->set('title_for_layout', 'Edit Profile: '.$user['User']['first_name'].' '.$user['User']['last_name']);
		}
	}

	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
