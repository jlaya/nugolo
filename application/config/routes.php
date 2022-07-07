<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'User';
$route['home'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Quienes Somos | Planes | Contacto
$route['about'] = "Home/about_us";
$route['plans'] = "Home/plans";
$route['contact'] = "Home/contact";
$route['contact/add'] = "Home/contact_add";

// landingpage
$route['registro'] = "User/register_public";
$route['register_private'] = "User/register_private";
$route['users/add'] = "User/register";
$route['users/add-private'] = "User/registers_private";
$route['users/preview_users'] = "User/preview_users";
$route['users/register_preview_users'] = "User/register_preview_users";
// find sub-category GyM
$route['find/sub_category'] = "User/ajax_sub_category";
// Chat
$route['chat'] = "Chat";
$route['chat_private'] = "Chat/chat_private";
$route['chat/register'] = "Chat/register";
$route['chat/join_channel_group_users'] = "Chat/join_channel_group_users";
$route['chat/users'] = "Chat/users";
$route['chat/joins_channel_group_users'] = "Chat/joins_channel_group_users";
$route['chat/close_group/([0-9]+)'] = "Chat/close_group/$1";
// Question
$route['question'] = "Question";
$route['pull_res'] = "Question/pull_response";
// Video Users
$route['video/register'] = "VideoUsers/register";
$route['video/show_items'] = "VideoUsers/show_items";
$route['video/progressbar'] = "VideoUsers/progressbar";
// Tareas
$route['admin/homework'] = "Homework";
$route['admin/homework/register'] = "Homework/register";
$route['admin/homework/edit/([0-9]+)'] = "Homework/edit/$1";
$route['admin/homework/add'] = "Homework/add";
$route['admin/homework/update'] = "Homework/update";
$route['admin/homework/delete/([0-9]+)'] = "Homework/delete/$1";
$route['admin/homework/joins/([0-9]+)'] = "Homework/joins/$1";
$route['admin/homework/join_people'] = "Homework/join_people";
$route['admin/homework/delete_people/([0-9]+)/([0-9]+)'] = "Homework/delete_people/$1/$2";
$route['admin/homework/notifications_users'] = "Homework/notifications_users";
// Confirmacion
$route['admin/confirmation'] = "Confirmation";
$route['admin/confirmation/send/([0-9]+)/([0-9]+)'] = "Confirmation/send/$1/$2";

// E-mail
$route['send_email'] = "Home/send_email";

// Cartera de anuncios
$route['announce'] = "Announce";
$route['announce/new'] = "Announce/new";
$route['announce/add'] = "Announce/add";
$route['announce/edit/([0-9]+)'] = "Announce/edit/$1";
$route['announce/update'] = "Announce/update";
$route['announce/delete/([0-9]+)'] = "Announce/delete/$1";

// Matriculacion
$route['Logros'] = "Logros";
$route['Logros/new'] = "Logros/new";
$route['Logros/add'] = "Logros/add";
$route['Logros/edit/([0-9]+)'] = "Logros/edit/$1";
$route['Logros/update'] = "Logros/update";
$route['Logros/delete/([0-9]+)'] = "Logros/delete/$1";

// Matricula
$route['admin/is_checked'] = "Admin/is_checked";

// URLS personalidas por el tema de geo-localizacion
$route['home/courses'] = "Home/courses";
$route['home/mycourses'] = "Home/my_courses";
$route['home/mywishlist'] = "Home/my_wishlist";
$route['home/messages'] = "Home/my_messages";
$route['home/history'] = "Home/purchase_history";
$route['home/profile'] = "Home/profile/([a-z 0-9 -]+)";
$route['home/credentials'] = "Home/profile/([a-z 0-9 -]+)";


// Catalogo de productos
$route['catalogs'] = "Catalogs";



// Insignias
$route['insignias'] = "Insignias";
$route['insignias/new'] = "Insignias/new";
$route['insignias/add'] = "Insignias/add";
$route['insignias/edit/([0-9]+)'] = "Insignias/edit/$1";
$route['insignias/update'] = "Insignias/update";
$route['insignias/delete/([0-9]+)'] = "Insignias/delete/$1";
$route['insignias/ajax_insignias'] = "Insignias/ajax_insignias";