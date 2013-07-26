<?php

/**********************************************************************
 *
 * GENERAL USE FUNCTIONS
 *
 *********************************************************************/

/**********************************************************************
 * Function to create the slugname from a string 
 *********************************************************************/
function create_slugname($str, $replace=array(), $delimiter='-')
{
	setlocale(LC_ALL, 'en_US.UTF8');
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	return $clean;
}
/**********************************************************************
 * Function to show the fist value only if the second is null,
 * used on form inputs
 *********************************************************************/
function input_value($first = NULL, $old = NULL)
{
	return (!$old)? $first : $old;
}
/**********************************************************************
 *
 * Function to remove a folder and all the files inside it
 *
 *********************************************************************/
function removeDirectory($directory)
{
    foreach(glob("{$directory}/*") as $file)
    {
        if(is_dir($file)) { 
            removeDirectory($directory);
        } else {
            unlink($file);
        }
    }
    rmdir($directory);
}