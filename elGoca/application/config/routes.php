<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "elGoca";
$route['404_override'] = '';

/* Special routing */
/* just to give a lil semantic to the URIs */
$route['register'] 				= "elGoca/register";
$route['register/(:any)'] 		= "elGoca/register/$1";
$route['user/registered'] 		= "elGoca/registered";
$route['login'] 				= "elGoca/login";
$route['logout'] 				= "elGoca/logout";
$route['admin'] 				= "elGoca/admin";

//Home categories
$route['events'] 				= "elGoca/viewEvents";
$route['movies'] 				= "elgoca/viewPlaces/movies";
$route['restaurants']	 		= "elGoca/viewPlaces/food";
$route['bar']	 				= "elGoca/viewPlaces/bar";
$route['hobbies'] 				= "elGoca/viewPlaces/hobbies";
$route['culture'] 				= "elGoca/viewPlaces/culture";

//View
$route['events/view/(:any)']	= "elGoca/viewEvent/$1";
$route['places/view/(:any)']	= "elGoca/viewPlace/$1";
$route['coupons/view/(:any)']	= "elGoca/viewCoupon/$1";
$route['coupons/viewAll/(:any)']= "elGoca/viewCoupons/$1";

//Search
$route['Search']				= "elGoca/search";
$route['places/events/(:any)']	= "elGoca/viewEvents/$1";
$route['getEvents/(:any)']		= "elGoca/getEvents/$1";

//Exchange-Coupons
$route['coupons/exchange/(:any)']= "elGoca/exchangeCoupon/$1";

//Users
$route['users/edit']			= "elGoca/editUser";
$route['users/changePassword']	= "elGoca/changePassword";
$route['users/passwordChanged']	= "elGoca/passChanged";

/* End of file routes.php */
/* Location: ./application/config/routes.php */