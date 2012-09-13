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
| General Constants
|--------------------------------------------------------------------------
|
| Various constants used throughout the system
|
*/
define('Credentials',	'e!-6oC4Sy5'); //Credentials to access the system
define('uri_replace',	'fnb9784r');  //Just a random string to replace the %2F in the URLs
define('resultsPerPage', 5);

/*
|--------------------------------------------------------------------------
| Database constants
|--------------------------------------------------------------------------
|
| Names of database tables to avoid case sensitive issues
|
*/
/************************* TABLE NAMES *************************/
define('categories', 	'Categories');
define('countries', 	'Countries');
define('users', 		'gocaUsers');
define('places',		'Places');
define('events', 		'Events');
define('coupons', 		'CouponGroup');
define('CatsPerUser', 	'CategoriesPerUser');
define('CouponsPerUser','CouponsPerUser');

//Views
define('placesView', 	'PlacesView');
define('eventsView', 	'EventsView');
define('couponsView', 	'CouponsView');
define('couponsViewEx',	'CouponsExView');
define('commercialView','CUsersView');
define('registeredView','RUsersView');
define('publicistView',	'PUsersView');
define('adminView',		'AUsersView');
define('userCouponView','UserCouponsView');
define('exCouponsView', 'gocaExchangedCouponsView');


/************************* FIELD NAMES *************************/
//General
define('name',			'Name');
define('state',			'State');
define('city',			'City');
define('eMail',			'eMail');
define('phone',			'PhoneNumber');
define('Website',		'Website');
define('FB',			'FacebookURL');
define('Twitter',		'Twitter');
define('status',		'Status');
define('price',			'Price');

//Categories
define('idCategory',	'idGocaCategories');
define('Category',		'Category');

//CategoriesPerUsers
define('idCatUser',		'idGocaUser');
define('idCat',			'idGocaCategory');

//Countries
define('idCountry',		'idGocaCountries');
define('Country',		'Country');

//Coupons
define('idCoupon',		'idGocaCoupons');
define('couponEvent',	'idGocaEvent');
define('regPrice',		'RegularPrice');
define('couponPrice',	'CouponPrice');
define('startDate',		'StartDate');
define('endDate',		'EndDate');
define('Qty',			'TotalQuantity');
define('restrictions',	'Restrictions');

//CouponsPerUser
define('idUserCoupon',	'idGocaCoupon');
define('idCUser',		'idGocaUser');
define('code'	,		'Code');

//CouponsView
define('startHour',		'StartHour');
define('endHour',		'EndHour');

//Events
define('idEvent',		'idGocaEvents');
define('eventPlace',	'idGocaPlace');
define('eventDate',		'EventDate');

//EventsView
define('eventHour',		'EventHour');

//Places
define('idPlace',		'idGocaPlaces');
define('owner',			'idOwner');
define('placeCat',		'idGocaCategory');
define('description',	'Description');
define('type',			'PlaceType');
define('capacity',		'Capacity');
define('placeCountry',	'idGocaCountry');
define('address',		'Address');
define('latitude',		'x');
define('longitude',		'y');

//Users
define('idUser',		'idGocaUsers');
define('Level',			'idGocaUserLevel');
define('userName',		'Username');
define('password',		'Password');
define('surname',		'Surname');
define('birthDate',		'BirthDate');
define('userCountry',	'idGocaCountry');


/* End of file constants.php */
/* Location: ./application/config/constants.php */