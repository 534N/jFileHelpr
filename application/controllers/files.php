<?php

/**
 *
 * 
 *
 * PHP version 5.5
 * LARAVEL 3.2.5
 *
 * @author     Sean Yang
 * @copyright  2013
 * @version    1.0
 * @link       $web_root/TS_Helper/public/file/$file_id
 *
 */

class Files_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		// Run CSRF filtering on POST actions
		$this->filter('before', 'csrf')->on('post');
	}

	public function action_upload($user_id) {
		// check if the ID provided exists as a user
		$user = Portal::find($user_id);
		// if the ID does not math a user 404 returned
		if ($user && Auth::user()->id == $user_id)
		{
			// initialize the data array with the user information
			$data = array('user' => $user, 'user_id' => $user_id);
			return View::make('files.upload')->with($data);
		}
		else 
			return Response::error('404');
	}

    public function action_loadSearch($userid, $filename) {
        $user = Portal::find($userid);
        if ($user) {
            $username = $user->username;
            $file_path = Config::get('site.user_upload_path') . $user->username . DS;
            $path = $file_path . $filename;
            $string = file_get_contents($path);
            $content = json_decode($string, true);
            
            $summary = $content['summary'];
            array_pop($summary);
            array_pop($summary);
            return json_encode($summary);
        }
	}
	
}