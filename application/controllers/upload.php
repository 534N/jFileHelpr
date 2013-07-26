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
 * @link       $web_root/TS_Helper/public/files/$user_id/upload
 *
 */

class Upload_Controller extends Base_Controller {

	public function __construct()
	{
		//$this->filter('before','auth')->only('index');
		$this->filter('before', 'csrf')->on('post');
	}

	/**
	* handle file upload and delete action
	*/
	public function action_index($user_id)
	{
		// check if the ID provided exists as a user
		$user = Portal::find($user_id);
		// if the ID does not math a user 404 returned
		if (!$user) return Response::error('404');
		// start the bundle and create the object
		Bundle::start('jfileupload');
		$upload_handler = new UploadHandler(array(
			'upload_dir' 		=> Config::get('site.user_upload_path') . $user->username . DS,
			'upload_url' 		=> URL::base() . DS .Config::get('site.user_upload_url') . $user->username . DS,
			'delete_route' 		=> 'admin/user'.DS.$user_id.DS.'upload',
			'accept_file_types' => '//',
			'user_id'			=> $user_id,
			'username'			=> $user->username
		));

		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
		
		switch ($_SERVER['REQUEST_METHOD']) 
		{
			case 'OPTIONS':
				break;
			case 'HEAD':
			case 'GET':
				$upload_handler->get();
				break;
			case 'POST':
				if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
					$upload_handler->delete();
				} else {
					$upload_handler->post();
				}
				break;
			case 'DELETE':
				$upload_handler->delete();
				break;
			default:
				header('HTTP/1.1 405 Method Not Allowed');
		}
	}
}
