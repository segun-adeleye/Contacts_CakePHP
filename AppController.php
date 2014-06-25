App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'contacts', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authError' => 'You can\'t access this page',
			'authorize' => array('Controller')
		),
	);

	public function isAuthorized($user) {
		return true;
	}

	public function beforeFilter() {
		//$this->Auth->userModel = 'Owner';
		$this->Auth->allow('login');
		$this->set('logged_in', $this->Auth->loggedIn());
		$this->set('current_user', $this->Auth->user());
	}
}
