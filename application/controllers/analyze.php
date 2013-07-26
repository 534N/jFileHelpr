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
 * @link       $web_root/TS_Helper/public/$user_id
 *
 */

class Analyze_Controller extends Controller {

	public function __construct()
	{
		parent::__construct();
		// Run CSRF filtering on POST actions
		$this->filter('before', 'csrf')->on('post');
	}

	public function action_info($user_id, $filename) {

        $user = Portal::find($user_id);
        if ($user)
        {
            $username 	 = $user->username;
            $file_path = Config::get('site.user_upload_path') . $user->username . DS;
            $path = $file_path . $filename;
            $string = file_get_contents($path);
			$content = json_decode($string, true);
			
			$summary = $this->getSummary($content['summary']);
			$pie = $this->formatChartValue($content['summary']['jPie']);
           
            $data = array('user' => $user, 'user_id' => $user_id, 'username' => $username, 'filename' => $filename, 'summary' => $summary, 'pie' => $pie);
            return View::make('analyze.info')->with($data);
        }
        else
            return Response::error('404');
    }

    public function getSummary($array) {
    	array_pop($array);
    	return $array;
    }

    public function formatChartValue($array) {
    	$result = array();
    	if (!empty($array)) {
    		$i = 0;
    		foreach ($array as $key => $value) {
    			$result[$i][] = $key;
    			$result[$i][] = (float)explode('GB', $value)[0];
    			$i++;
    		}
    	}
    	return $result;
    }

	public function print_r_html ($arr) {
        ?><pre><?
        print_r($arr);
        ?></pre><?
	}

}