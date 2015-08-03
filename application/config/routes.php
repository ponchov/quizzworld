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

$languages="en|id|ar|ru|es|zh|nl|fr|pl|tr|pt|de|it";

$route['default_controller'] = "home";





// URI like '/en/about' -> use controller 'about'

//$route['^(en|de|fr|nl|bn)/(.+)$'] = "$2";



// '/en', '/de', '/fr' and '/nl' URIs -> use default controller


$route["^($languages)"] = "/home";
$route["^($languages)/home/(:any)"] = "/home/$2";


$route['404_override'] = '';

// custom routes for messages / inbox





$route["^($languages)/page"] = '/home/index';

$route['page'] = '/home/index';




$route['page/([0-9]+)'] = '/home/index/$1';

$route["^($languages)/page/([0-9]+)"] = '/home/index/$2';





$route['^([a-z0-9_-]+)\.html'] = '/home/view/$1';


//-------- this is for list view
$route['list/(:any)\.html'] = '/home/list_view/$1';

//-------- this is for article view
$route['article/(:any)\.html'] = '/home/article/$1';

//-------- this is for article view
$route['videos/(:any)\.html'] = '/home/video/$1';



//---- name meaning quizz
$route['name.html'] = '/name_meaning/index';
$route['name-create.html'] = '/name_meaning/result';
//---- Personality quizz
$route['personality-quiz.html'] = '/home/games/';
$route["^($languages)/personality-quiz.html"] = '/home/games/';
$route["^($languages)/games/page/([0-9]+)"] = '/home/games/$2';

$route['trivia.html'] = '/home/trivia/';
$route["^($languages)/trivia.html"] = '/home/trivia/';
$route["^($languages)/trivia/page/([0-9]+)"] = '/home/trivia/$2';


$route['apps.html'] = '/home/apps/';
$route["^($languages)/apps.html"] = '/home/apps/';
$route["^($languages)/apps/page/([0-9]+)"] = '/home/apps/$2';


$route['name.html'] = '/home/name/';
$route["^($languages)/name.html"] = '/home/name/';
$route["^($languages)/name/page/([0-9]+)"] = '/home/name/$2';

//---- Lists 
$route['lists.html'] = '/home/lists/';
$route["^($languages)/lists.html"] = '/home/lists/';

//---- Article list 
$route['articles.html'] = '/home/articles/';
$route["^($languages)/articles.html"] = '/home/articles/';

//---- Video list 
$route['videos.html'] = '/home/videos/';
$route["^($languages)/videos.html"] = '/home/videos/';

//----------------
//$route['^(not-found.html)'] = '/home/not_found';
$route['not-found.html'] = '/home/not_found';
$route["^($languages)/not-found.html"] = '/home/not_found';

$route['contact-us.html'] = '/contact_us/index';
$route["^($languages)/contact-us.html"] = '/contact_us/index';

$route["^($languages)/question/(:any)"] = '/home/question/$2';
$route['question/(:any)'] = '/home/question/$1';

$route['top.html'] = '/home/top/';
$route['top/page/(:any)'] = '/home/top/$1';

$route['start/(:any)\.html'] = '/home/start/$1';
$route["^($languages)/start/(:any)\.html"] = '/home/start/$2';







$route["^($languages)/result/(:any)\.html"] = '/home/result/$2';

$route['result/(:any)\.html'] = '/home/result/$1';

$route["^($languages)/top/page/(:any)"] = '/home/top/$2';





$route["^($languages)/top.html"] = '/home/top';


$route['random.html'] = '/home/random';
$route["^($languages)/random.html"] = '/home/random';


$route["^($languages)/home/privacy_policy"] = '/home/privacy_policy';



//--------------

//$route['^(en|de|fr|nl|bn)/(.+)$']  = 'home/view/$2';

$route["^($languages)/([a-z0-9_-]+)\.html"] = '/home/view/$2';





$route['category/(:any)\.html'] = '/home/category/$1';

$route["^($languages)/(:any)/(:any)\.html"] = '/home/view_3apps_result/$2/$3';
$route['(:any)/(:any)\.html'] = '/home/view_3apps_result/$1/$2';































/* End of file routes.php */

/* Location: ./application/config/routes.php */