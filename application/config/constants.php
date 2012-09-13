<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/*
|--------------------------------------------------------------------------
| Application Constants
|--------------------------------------------------------------------------
|
| All the constants used through the app
|
*/
define('Credentials','J0BboXx');

/*
|--------------------------------------------------------------------------
| TABLE NAMES
|--------------------------------------------------------------------------
|
| The names of the tables of the database
|
*/
define('users','users');

/*
|--------------------------------------------------------------------------
| FIELD NAMES
|--------------------------------------------------------------------------
|
| The names of the fields of the tables
|
*/

//General
define('status','Status');
define('desc','Description');

//Jobs-View
define('idJob','idJob');
define('jobName','Position_Name');

//Honorifics
define('idHonorific','idHonorific');
define('honorific','Honorific');

//Religions
define('idReligion','idReligion');
define('religion','Religion');

//Countries
define('idCountry','idCountry');
define('country','Country');

//States
define('idState','idState');
define('state','State');

//Cities
define('idCity','idCity');
define('city','City');

/* End of file constants.php */
/* Location: ./application/config/constants.php */