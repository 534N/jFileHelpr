<?php
class More_Controller extends Controller {

	public function __construct() {
		parent::__construct();
		// Run CSRF filtering on POST actions
		$this->filter('before', 'csrf')->on('post');
	}

	public function action_index($user_id, $filename) {
		$user = Portal::find($user_id);
        if ($user) {
            $username 	 = $user->username;
           
            $data = array('user' => $user, 'user_id' => $user_id, 'username' => $username, 'filename' => $filename);
            return View::make('more.index')->with($data);
        }
        else
            return Response::error('404');
	}
}