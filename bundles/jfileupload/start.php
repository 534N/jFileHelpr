<?php
/*
 * jQueryFileUpload Bundle for Laravel
 * https://github.com/boparaiamrit/laravel-jqueryfileupload
 *
 * Plugin from
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

//Autoload UploadHander Class of jqueryfileupload
Autoloader::map(array(
    'UploadHandler' => path('bundle').DS.'jfileupload'.DS.'UploadHandler'.EXT,
));

// Register the upload handler in the IoC container
// Laravel\IoC::singleton('uploadhandler', function(){
// 	return new UploadHandler();
// });