<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//auth routes.
$route['register'] = 'auth/register';
$route['login'] = 'auth/login';

//odoo
$route['odoo'] = 'integrations/odoo';


//clients routes.
$route['clients'] = 'clients/index';
$route['clients/create'] = 'clients/create';
$route['clients/update/(:any)'] = 'clients/update/$1';
$route['clients/delete/(:any)'] = 'clients/delete/$1';
$route['clients/(:any)'] = 'clients/show/$1';

//parts routes.
$route['parts'] = 'parts/index';
$route['parts/create'] = 'parts/create';
$route['parts/update/(:any)'] = 'parts/update/$1';
$route['parts/delete/(:any)'] = 'parts/delete/$1';
$route['parts/(:any)'] = 'parts/show/$1';

//plants routes.
$route['plants'] = 'plants/index';
$route['plants/create'] = 'plants/create';
$route['plants/update/(:any)'] = 'plants/update/$1';
$route['plants/delete/(:any)'] = 'plants/delete/$1';
$route['plants/(:any)'] = 'plants/show/$1';

//production lines routes.
$route['productionlines'] = 'productionlines/index';
$route['productionlines/create'] = 'productionlines/create';
$route['productionlines/update/(:any)'] = 'productionlines/update/$1';
$route['productionlines/delete/(:any)'] = 'productionlines/delete/$1';
$route['productionlines/(:any)'] = 'productionlines/show/$1';
$route['productionlines/get_lines_by_plant_id'] = 'productionlines/get_lines_by_plant_id';

//workstations routes.
$route['workstations'] = 'workstations/index';
$route['workstations/create'] = 'workstations/create';
$route['workstations/update/(:any)'] = 'workstations/update/$1';
$route['workstations/delete/(:any)'] = 'workstations/delete/$1';
$route['workstations/(:any)'] = 'workstations/show/$1';


$route['hourbyhour'] = 'hourbyhour/menu';//menu to choose planning or client (operator) view.


/*
* Hour By Hour routes for planning.
*/
$route['workorders/hourbyhour'] = 'hourbyhour/index';
$route['workorders/hourbyhour/create'] = 'hourbyhour/create';
$route['workorders/hourbyhour/update/(:any)'] = 'hourbyhour/update/$1';
$route['workorders/hourbyhour/delete/(:any)'] = 'hourbyhour/delete/$1';
$route['workorders/hourbyhour/(:any)'] = 'hourbyhour/$1';
$route['workorders/hourbyhour/cancel/(:any)'] = 'hourbyhour/cancel/$1';
$route['workorders/hourbyhour/activate/(:any)'] = 'hourbyhour/activate/$1';


/*
* hour by hour client routes.
*/
$route['floor/hourbyhour'] = 'hourbyhour_clients/index';//shows all workstations where the client has workorders.
$route['floor/hourbyhour/(:any)'] = 'hourbyhour_clients/show/$1';//shows all workorders for the client in the workstation.
$route['floor/hourbyhour/update/(:any)'] = 'hourbyhour_clients/update/$1';//updates the workorder.
$route['floor/hourbyhour/delete/(:any)'] = 'hourbyhour_clients/delete/$1';//deletes the workorder.



//screen routes.
$route['screens'] = 'screens/index';
$route['screens/create'] = 'screens/create';
$route['screens/update/(:any)'] = 'screens/update/$1';
$route['screens/test'] = 'screens/test_screen';
$route['screens/chart'] = 'screens/chart_screen';
$route['screens/(:any)'] = 'screens/show/$1';


$route['teams'] = 'teams/index';
$route['teams/create'] = 'teams/create';
$route['teams/update/(:any)'] = 'teams/update/$1';
$route['teams/delete/(:any)'] = 'teams/delete/$1';
$route['teams/(:any)'] = 'teams/show/$1';


$route['alerts'] = 'alerts/index';
$route['alerts/create'] = 'alerts/create';
$route['alerts/update/(:any)'] = 'alerts/update/$1';
$route['alerts/delete/(:any)'] = 'alerts/delete/$1';
$route['alerts/(:any)'] = 'alerts/show/$1';




//operations routes.
$route['operations'] = 'operations/index';
$route['operations/create'] = 'operations/create';
$route['operations/update/(:any)'] = 'operations/update/$1';
$route['operations/delete/(:any)'] = 'operations/delete/$1';
$route['operations/(:any)'] = 'operations/show/$1';
$route['operations/customfields/(:any)'] = 'operations/customfields/$1';
    


//andon client routes.
$route['andon/client'] = 'andons/client';
$route['andon/client/(:any)'] = 'andons/single/$1';

//andon support routes.
$route['andon/support'] = 'andons/support';
$route['andon/respond/(:any)'] = 'andons/respond/$1';
$route['andon/solve/(:any)'] = 'andons/solve/$1';




//projects routes.
$route['projects'] = 'projects/index';
$route['projects/create'] = 'projects/create';
$route['projects/update/(:any)'] = 'projects/update/$1';
$route['projects/delete/(:any)'] = 'projects/delete/$1';
$route['projects/search'] = 'projects/search';
$route['projects/show/(:any)'] = 'projects/show/$1';
$route['projects/(:any)/operations'] = 'projects/operations/$1';
$route['projects/update_order'] = 'projects/update_order';



//workorders routes.
$route['workorders'] = 'workorders/index';
$route['workorders/update/(:any)'] = 'workorders/update/$1';
$route['workorders/print/(:any)'] = 'workorders/print/$1';
$route['workorders/print_template/(:any)'] = 'workorders/print_template/$1';


//users routes.
$route['users'] = 'users/index';
$route['users/create'] = 'users/create';
$route['users/update/(:any)'] = 'users/update/$1';
$route['users/delete/(:any)'] = 'users/delete/$1';
$route['users/signature/(:any)'] = 'users/signature/$1';


//users operators routes.
$route['users/create_operator'] = 'users/create_operator';
$route['users/update_operator/(:any)'] = 'users/update_operator/$1';
$route['users/delete_operator/(:any)'] = 'users/delete_operator/$1';



//reports routes.
$route['reports'] = 'reports/index';

$route['mobile'] = 'mobile/index';
$route['mobile/login'] = 'mobile/login';

//default routes.
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
