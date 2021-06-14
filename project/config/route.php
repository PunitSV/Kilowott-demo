<?php

$tmp_url_array = array();
$tmp_url_array = explode("/", $url_str);

if($tmp_url_array[1] == 'user' && $tmp_url_array[2] == 'add') {
	$url_str = 'user/add';
}
elseif($tmp_url_array[1] == 'user' && $tmp_url_array[2] == 'save') {
	$url_str = 'user/save/';
}
elseif($tmp_url_array[1] == 'user' && $tmp_url_array[2] == 'signup') {
	$url_str = 'login/saveSignup/';
}
elseif($tmp_url_array[1] == 'sendMail' && $tmp_url_array[2] == '') {
	$url_str = 'login/sendMail/';
}
elseif($tmp_url_array[1] == 'user' && $tmp_url_array[2] == 'delete') {
	$url_str = 'user/deleteUser';
}
elseif(($tmp_url_array[1] == 'login' && $tmp_url_array[2] == '')|| $tmp_url_array[1] == '') {
	$url_str = 'login/login/';
}
elseif($tmp_url_array[1] == 'login' && $tmp_url_array[2] == 'authenticate') {
	$url_str = 'login/authenticate/';
}
elseif($tmp_url_array[1] == 'signup' && $tmp_url_array[2] == '') {
	$url_str = 'login/signup/';
}
elseif($tmp_url_array[1] == 'logout' && $tmp_url_array[2] == '') {
	$url_str = 'login/logout/';
}
elseif($tmp_url_array[1] == 'forgot' && $tmp_url_array[2] == '') {
	$url_str = 'login/forgot/';
}
elseif($tmp_url_array[1] == 'dashboard' && $tmp_url_array[2] == '') {
	$url_str = 'dashboard/usersList/';
}
elseif($tmp_url_array[1] == 'user') {
	$url_str = 'user/edit/'.$tmp_url_array[2];
}