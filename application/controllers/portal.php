<?php
/**
 *
 *
 * PHP version 5.4.6
 * LARAVEL 3.2.5
 *
 * @author     Sean Yang
 * @copyright  2013
 * @version    1.0
 * @link       $web_root/TS_Helper/public/portal
 *
 */

class Portal_Controller extends Base_Controller {

	public $restful = true;

	public function __construct()
	{
		//$this->filter('before','auth')->only('index');
		$this->filter('before', 'csrf')->on('post');
	}

	/**
	* link: $web_root/TS_Helper/public/portal
	* display the login page
	*/
	public function get_login() {
		$message = Session::get('message');
		$data 	 = array('title' => 'User Login', 'message' => $message);

		return View::make('portal.login')->with($data);
	}

	/**
	* link: $web_root/TS_Helper/public/portal/index
	* check the login info
	* if valid then go to $web_root/TS_Helper/public/files/$user_id, else show error message
	*/
	public function post_index() {
		$userinfo = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if (Auth::attempt($userinfo)) {

			$cc = DB::table('portals')
    				->where('username', '=', Input::get('username'))
    				->get();

    		$uid = $cc[0]->id;

			return Redirect::to('files/'.$uid);
		} else {
			return Redirect::to_route('portal')->with('error', 'User name or password is invalid!');
		}
	}

	public function get_home() {
		return View::make('portal.home')
			->with('title', 'User Home Page');
	}

	/**
	* link: $web_root/TS_Helper/public/portal/register
	* display the registration page
	*/
	public function get_register() {
		return View::make('portal.register')
			->with('title', 'Register New User');
	}

	/**
	* link: $web_root/TS_Helper/public/portal/create
	* validate the registration fields, create the user
	* also create corresponding folders for the user 
	*/
	public function post_create() {
		$validation = Portal::validate(Input::all());

		if ($validation->fails()) {
			return Redirect::to_route('register_user')->with_errors($validation)->with_input();
		}
		else {
			$portal 		   = new Portal();
			$portal->username  = Input::get('username');
			$portal->password  = Hash::make(Input::get('password'));
			$portal->firstname = Input::get('firstname');
			$portal->lastname  = Input::get('lastname');
			$portal->customer  = Input::get('customer');
			$portal->save();

			if (mkdir(Config::get('site.user_upload_path').Input::get('username'), 0777) ) {
				mkdir(Config::get('site.decore_init_path').Input::get('username'), 0777);
				mkdir(Config::get('site.decore_op_path').Input::get('username'), 0777);
				mkdir(Config::get('site.user_download_path').Input::get('username'), 0777);
			} else {
				return Redirect::to_route('register_user')->with('error', 'Failed to create user directory');
			}

			return Redirect::to_route('portal')
				->with('message', 'The user was created successfully!');
		}
	}

	/**
	* link: $web_root/TS_Helper/public/portal/logout
	* logout the user, display the login page
	*/
	public function post_logout() {
		Auth::logout();

		return Redirect::to_route('portal');
	}

}