<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

if(ENVIRONMENT == 'production'){
	// $mysql_host = "mysql10.000webhost.com";
	// $mysql_database = "a9716758_taurin";
	// $mysql_user = "a9716758_taurin";
	// $mysql_password = "taurinpassword!!";
	$db['default']['hostname'] = 'mysql10.000webhost.com';
	$db['default']['username'] = 'a9716758_taurin';
	$db['default']['password'] = 'taurinpassword!!';
	$db['default']['database'] = 'a9716758_taurin';
}else{
	$db['default']['hostname'] = '127.0.0.1';
	$db['default']['username'] = 'root';
	$db['default']['password'] = 'mysqlpassword';
	$db['default']['database'] = 'trakit';
}

$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

//end of database.php