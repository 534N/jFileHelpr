<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Site Name
	|--------------------------------------------------------------------------
	|
	| The name of your site
	|
	*/

	'name' => 'j.FILE.HELP',

	/*
	|--------------------------------------------------------------------------
	| Courses related upload paths
	|--------------------------------------------------------------------------
	|
	| Where should we store the avatars/files uploaded by users for courses
	|
	*/

	'user_upload_path' => dirname(dirname(__DIR__)) . DS . 'public' . DS . 'uploads' . DS . 'users' . DS,
	'user_upload_url' => 'uploads' . DS . 'users' . DS,
);