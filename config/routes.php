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
$route['default_controller'] = 'Welcome/index';
$route['Forgot_Password'] = 'welcome/New_Password';
$route['Signup_Signin'] = 'welcome/User_Authentication';
$route['Google_Login'] = 'Welcome/Google_Login';
$route['Fb_Login'] = 'Welcome/Fb_Login';
$route['Linkedin_Login'] = 'Welcome/Linkedin_Login';
$route['Signin_Signup'] = 'Welcome/Logout';
$route['Admin_Login'] = 'Welcome/adminLogout';
$route['Signin'] = 'Welcome/Signin';
$route['Signup'] = 'Welcome/Signup';
$route['Confirmemail'] = 'Welcome/confirmEmail';
$route['Ask_question'] = 'Questions/addquestion';
$route['Play_quiz'] = 'Questions/set_session';
$route['Quiz_result'] = 'Questions/resultdisplay';
$route['Play_again'] = 'Questions/unset_session';
$route['User_profile'] = 'Task_Controller/show_student_id';
$route['New_password'] = 'Welcome/New_Password';
$route['Question_added'] = 'Task_Controller/form_insert';
$route['Update_password'] = 'Task_Controller/update_student_id1';
$route['Chapter_notes'] = 'Questions/pmp_notes';
$route['Give_answer'] = 'Questions/question_answer';
$route['Update_question'] = 'Task_Controller/form_update';
$route['PMP_Access'] = 'Welcome/PMP_Access';
$route['Admin_Login'] = 'Welcome/admin_login';
$route['Admin_Check'] = 'Welcome/admin_login_check';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
