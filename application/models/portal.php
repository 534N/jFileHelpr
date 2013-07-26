<?php

class Portal extends Eloquent {
	public static $table = 'portals';

	public static $rules = array(
		'username'=>'required|min:2|unique:portals',
		'password'=>'required|min:4',
		'firstname'=>'required',
		'lastname'=>'required',
		'customer'=>'required'
	);

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}
}