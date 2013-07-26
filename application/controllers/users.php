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
 * @link       $web_root/TS_Helper/public/
 *
 */

class Users_Controller extends Base_Controller {

	public $restful = true;

	public function __construct()
	{
		//$this->filter('before','auth')->only('index');
		$this->filter('before', 'csrf')->on('post');
	}

	public function get_index()
	{
		return View::make('admin.users.userlist')->with('users', Portal::get());
	}

	public function get_user($user_id = NULL, $section = NULL, $action = NULL)
	{
		// check if the ID provided exists as a user
		$user = Portal::find($user_id);
		// if the ID does not math a user 404 returned
		if ($user)
		{
			// set the action value taken from the URI segment
			if (URI::segment(5) != NULL) $action = URI::segment(5);
			// initialize the data array with the user information
			$data = array('user' => $user);

			switch ($section) {
				case 'delete':
					return View::make('admin.users.user-delete')->with($data);
					break;
				case 'files':
					return View::make('admin.users.user-files')->with($data);
					break;
				case 'general':
				case '':
					return View::make('admin.users.user-general')->with($data);
					break;
				default:
					return Redirect::to('admin/user')->with('user_id',$user->id);
					break;
			}
		}
		else return Response::error('404');
	}

	}

	public function post_user_general($user_id = NULL)
	{
		// check if the ID provided exists as a user
		$user = Portal::find($user_id);
		// if the ID does not math a user 404 returned
		if (!$user) return Response::error('404');
		// Get all form inputs
		$form = Input::get();
		// Generate the categories array
		// Generate the validation rules
		$rules = array(
						'username'		=>	'required|max:100|unique:users,username,'.$user->id,
					);
		$validation = Validator::make($form,$rules);
		if ($validation->fails()) {
			// Flash all inputs
			Input::flash();
			return View::make('admin.users.user-general')->with('user', $user)
														 ->with('alert','alert-error')
														 ->with('alert_message', 'Review your form')
														 ->with('errors',$validation->errors);
		}
		else {
			$user->username 	= 	$form['username'];
			$user->save();

			return View::make('admin.users.user-general')->with('user', $user)
														 ->with('alert','alert-success')
														 ->with('alert_message', 'User updated');
		}
	}
	public function post_user_delete($user_id = NULL)
	{
		// check if the ID provided exists as a user
		$user = Portal::find($user_id);
		// if the ID does not math a user 404 returned
		if (!$user) return Response::error('404');
		// store the file uploaded
		$form = Input::get();
		// create the validation rules
		$rules = array('delete'	=> 	'required|in:,I AGREE');
		$validation = Validator::make($form,$rules);
		// check the validation
		if ($validation->fails()) {
			Input::flash();
			return View::make('admin.users.user-delete')->with('user', $user)
														->with('alert','alert-error')
														->with('alert_message', 'Review your form')
														->with('errors',$validation->errors);
		}
		else {
			// Delete the user
			$user->delete();
			// Delete the folder of the user and all it's contents
			removeDirectory(Config::get('site.user_upload_path').$user->folder);
			return Redirect::to_action('admin@users')->with('alert','alert-success')
													 ->with('alert_message', 'User deleted');
		}
		return Response::error('500');		
	}

}
