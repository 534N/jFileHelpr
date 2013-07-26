<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

/**********************************************************************
 *
 * With this route we allow users to upload files for their courses,
 *
 *********************************************************************/
Route::any('admin/user/(:num)/upload', function($user_id = null)
{
	return Controller::call('upload@index', array('id' => $user_id));
});

Route::any('files/(:num)', function($user_id = null)
{
	if (Auth::check()) {
		return Controller::call('files@upload', array('id' => $user_id));
	} else {
		return Controller::call('portal@login');
	}
	
});
Route::any('files/(:num)/upload', function($user_id = null)
{
	return Controller::call('upload@index', array('id' => $user_id));
});

Route::any('files/(:num)/loadSearch', function($userid = null, $filename = null)
{
    $userid 	= $_GET['userid'];
    $filename 	= $_GET['filename'];
    return Controller::call('files@loadSearch', array('userid' => $userid, 'filename' => $filename));
});

Route::any('analyze/(:num)/(:any)', function($user_id = null, $file_name = null)
{
    return Controller::call('analyze@info', array('user_id' => $user_id, 'filename' => $file_name));
});

Route::any('more/(:num)/(:any)', function($user_id = null, $file_name = null)
{
    return Controller::call('more@index', array('user_id' => $user_id, 'filename' => $file_name));
});

Route::get ('portal', array('as'=>'portal', 'uses'=>'portal@login'));
Route::post('portal/logout', array('uses'=>'portal@logout'));
Route::post('portal/index', array('uses'=>'portal@index'));
Route::any ('user/(:any)', array('as'=>'user', 'uses'=>'portal@home'));
Route::get ('portal/register', array('as'=>'register_user', 'uses'=>'portal@register'));
Route::post('portal/create', array('uses'=>'portal@create'));

Route::get('/', function()
{
	if (Auth::check()) {
		return View::make('home.intro');
	}
	else {
		return View::make('home.index');
	}
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});

// Route for Admin_Controller
Route::controller('admin');

// Route for Categories_Controller
Route::controller('categories');