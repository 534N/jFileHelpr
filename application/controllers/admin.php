<?php

class Admin_Controller extends Base_Controller {

	public $restful = true;

	public function __construct()
	{
		//$this->filter('before','auth')->only('index');
		$this->filter('before', 'csrf')->on('post');
	}

	public function get_index()
	{
		return View::make('admin.index');
	}

	public function get_users()
	{
		return Controller::call('users@index');
	}

	public function get_user($id = NULL, $section = NULL)
	{
		if ($id === 'new') return View::make('admin.users.user-new');
		return Controller::call('users@user', array('id' => $id, 'section' => $section));
	}

	public function post_user($id = NULL, $section = NULL)
	{
		if ($id == 'new') return Controller::call('users@user_new');
		elseif (!in_array($section , array('general','files','delete'))) return "ERROR: $id<BR>";//Response::error('500');
		else return Controller::call('users@user_'.$section, array('id' => $id));
	}
}
