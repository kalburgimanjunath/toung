<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMPaths {

	public static function getPath($relativepath) {		
		return base_url() . $relativepath;
	}
	
	public static function signin() {
		return base_url() . "home/signin";
	}
	
	public static function signup() {
		return base_url() . "home/signup";
	}
	
	public static function signedup() {
		return base_url() . "home/signedup";
	}
	
	public static function updateUser() {
		return base_url() . "user/update";
	}

	public static function getAccount() {
		return base_url() . "user/account/get";
	}

	public static function updateAccount() {
		return base_url() . "user/account/update";
	}
	
	public static function getAboutme() {
		return base_url() . "user/aboutme/get";
	}

	public static function updateAboutme() {
		return base_url() . "user/aboutme/update";
	}
	
}