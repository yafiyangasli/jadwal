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
|	https://codeigniter.com/userguide3/general/routing.html
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

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//auth URI

//dashboard URI

$route['dashboard'] = 'y_controller/dashboard';
$route['dashboard/(:any)'] = 'y_controller/dashboard/$1';
$route['dashboard/ajaxLoadDashAdmin/(:any)'] = 'y_controller/dashboard/ajaxLoadDashAdmin/$1';
$route['dashboard/ajaxGetUserName/(:any)'] = 'y_controller/dashboard/ajaxGetUserName/$1';

$route['dashboard/penjadwalan/(:any)'] = 'y_controller/dashboard/penjadwalan/$1';
$route['dashboard/penjadwalan2/(:any)'] = 'y_controller/dashboard/penjadwalan2/$1';

$route['dashboard/input_harianBA/(:any)'] = 'y_controller/dashboard/input_harianBA/$1';
$route['dashboard/hapus_harianBA/(:any)'] = 'y_controller/dashboard/hapus_harianBA/$1';
$route['dashboard/penggunaan_harian/detail_penggunaan_harian/(:any)'] = 'y_controller/dashboard/detail_penggunaan_harian/$1';

$route['dashboard/printBAP/(:any)'] = 'y_controller/dashboard/printBAP/$1';
$route['dashboard/ajaxLoadPertemuan/(:any)'] = 'y_controller/dashboard/ajaxLoadPertemuan/$1';
$route['dashboard/hapus_asprakBA/(:any)'] = 'y_controller/dashboard/hapus_asprakBA/$1';


$route['dashboard/laboratorium/detail_laboratorium/(:any)'] = 'y_controller/dashboard/detail_laboratorium/$1';
$route['dashboard/hapus_laboratorium/(:any)'] = 'y_controller/dashboard/hapus_laboratorium/$1';

$route['dashboard/ajaxLoadJadwal/(:any)'] = 'y_controller/dashboard/ajaxLoadJadwal/$1';
$route['dashboard/ajaxInputJadwal/(:any)'] = 'y_controller/dashboard/ajaxInputJadwal/$1';
$route['dashboard/ajaxHapusJadwal/(:any)'] = 'y_controller/dashboard/ajaxHapusJadwal/$1';
$route['dashboard/ajaxCekInputDatetimeBetween/(:any)'] = 'y_controller/dashboard/ajaxCekInputDatetimeBetween/$1';

$route['dashboard/ajaxLoadLabSide/(:any)'] = 'y_controller/dashboard/ajaxLoadLabSide/$1';
$route['dashboard/ajaxLoadLabByID/(:any)'] = 'y_controller/dashboard/ajaxLoadLabByID/$1';
$route['dashboard/ajaxLoadLab/(:any)'] = 'y_controller/dashboard/ajaxLoadLab/$1';
$route['dashboard/ajaxLoadKPByID/(:any)'] = 'y_controller/dashboard/ajaxLoadKPByID/$1';
$route['dashboard/ajaxLoadDosenByID/(:any)'] = 'y_controller/dashboard/ajaxLoadDosenByID/$1';
$route['dashboard/ajaxLoadBAPByID/(:any)'] = 'y_controller/dashboard/ajaxLoadBAPByID/$1';

$route['dashboard/edit_lab/(:any)'] = 'y_controller/dashboard/edit_lab/$1';
$route['dashboard/ubah_kelas/(:any)'] = 'y_controller/dashboard/ubah_kelas/$1';
$route['dashboard/hapus_kelas/(:any)'] = 'y_controller/dashboard/hapus_kelas/$1';
$route['dashboard/ubahStatusKelas/(:any)'] = 'y_controller/dashboard/ubahStatusKelas/$1';
$route['dashboard/ajaxLoadJadwalByID/(:any)'] = 'y_controller/dashboard/ajaxLoadJadwalByID/$1';

$route['dashboard/laboratorium/detail_laboratorium/ubah_foto_laboratorium/(:any)/(:any)'] = 'y_controller/dashboard/ubah_foto_laboratorium/$1/$2';







