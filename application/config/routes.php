<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['categories/posts/(:any)'] = 'categories/posts/$1';
$route['categories/create'] = 'categories/create';
$route['categories'] = 'categories/index';

$route['post/create'] = 'posts/create';
$route['post/update'] = 'posts/update';
$route['post/edit/(:any)'] = 'posts/edit/$1';
$route['post/(:any)'] = 'posts/view/$1';


$route['posts'] = 'posts/index';
$route['programming-exp'] = 'posts/index/program';
$route['programming-exp/(:any)'] = 'posts/index/program/$1';
$route['websites/(:any)'] = 'posts/index/website/$1';
$route['websites'] = 'posts/index/website';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
