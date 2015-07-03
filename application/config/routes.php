<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//MAIN ROUTES
$route['default_controller'] = "main";
//USER LOGIN
$route['profile']            = "users";
$route['login']              = "users/login";
$route['logout']             = "users/logout";
$route['register']           = "users/register";
$route['editProfile']        = "users/editProfile";
$route['updateProfile']      = "users/updateProfile";
//TRACKING NUMBERS
$route['tracking/addKey']       = "track/addKey";
$route['tracking/updateKey']    = "track/updateKey";
$route['tracking/removeKey/(:any)']  = "track/deleteKey/$1";
$route['tracking/getKeys/(:any)'] = "track/getKeys/$1";

$route['404_override'] = 'errors/er404';

//end of routes.php