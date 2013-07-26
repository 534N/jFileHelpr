<?php

class Base_Controller extends Controller {


	public function __construct()
	{
		parent::__construct();
		// Run CSRF filtering on POST actions
		$this->filter('before', 'csrf')->on('post');
	}
	
	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}