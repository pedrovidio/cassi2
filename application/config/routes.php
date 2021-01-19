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
/** login */
$route['default_controller'] = "login";

/** admin home */
$route['home'] = "admin/home";

/** admin operadores */
$route['operadores'] = "admin/operadores";
$route['operadores/:any'] = "admin/operadores/index/$1";
$route['operadores/form'] = "admin/operadores/form";
$route['operadores/delete/:number'] = "admin/operadores/delete/$1";
$route['operadores/update/:number'] = "admin/operadores/update/$1";

/** admin importar */
$route['importar'] = "admin/importar";
$route['importar/:any'] = "admin/importar/index/$1";
$route['importar/upload'] = "admin/importar/upload";

/** admin cotas */
$route['cotas'] = "admin/cotas";
$route['cotas/:any'] = "admin/cotas/$1";
$route['cotas/add'] = "admin/cotas/add";

/** admin listas respondentes segmentadas */
$route['lists/respondentes/:any'] = "admin/lists/index/$1";

/** admin meta */
$route['meta'] = "admin/meta";

/** admin historico */
$route['historico'] = "admin/historic";
$route['historico/update'] = "admin/historic/update";

/** admin dashboard */
$route['dashboard'] = "admin/dashboard";

/** redistribute */
$route['distribuir'] = "admin/redistribute";

/** */

/** oper home*/
$route['painel'] = "oper/painel";
$route['painel/elegiveis'] = "oper/painel/elegiveis";
$route['painel/lists/:any'] = "oper/painel/lists/$1";

$route['finish/:number'] = "finish/$1";
$route['404_override'] = 'home/erro_404';



/* End of file routes.php */
/* Location: ./application/config/routes.php */