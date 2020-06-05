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

$route['default_controller'] = "welcome/login";
$route['lead_create']="welcome/user_info";
$route['appointment']="welcome/appointment_booking";
$roue['app_booking']="welcome/appointment_booking";
$route['permissions']="welcome/permission_page";
$route['set_permissions']="welcome/set_user_permissions";
/*$route['apptmnt_booking']="welcome/app_booking";*/
$route['managelead']="welcome/managelead";
$route['filter_leads']='welcome/managelead';
$route['get_lead_record/(:any)']="welcome/get_lead_record/$1";
$route['get_leadtype_record/(:any)']="welcome/get_leadtype_record/$1";
$route['edit_lead_details']="welcome/update_lead";
$route['edit_lead_type_details']="welcome/update_lead_type_details";
$route['lead_type_depdent']='welcome/lead_type_depdent';
$route['user_information']="welcome/user_info";
$route['add_lead_type']="welcome/view_lead_type";
$route['newlead_type']="welcome/addlead_type";
$route['lead_source_depdent']='welcome/lead_source_depdent';
$route['display_lead_type']="welcome/lead_type_details";
$route['delete_lead/(:any)']="welcome/delete_lead_code/$1";
$route['delete_lead_type/(:any)']="welcome/delete_lead_type/$1";
$route['delete_appoint/(:any)']="googlecalendar/delete_appoint_dt/$1";
$route['get_appointment_record/(:any)']="welcome/get_appointment_records/$1";
$route['manage_appointment']="welcome/dispaly_manage_appointment";
$route['filter_appointments']="welcome/dispaly_manage_appointment";
$route['managerelationship']='welcome/managerelationship';
$route['edit_reltionship_details']='welcome/edit_reltionship_details';
$route['relationship']="welcome/relationship";
$route['get_relationship_record/(:any)']='welcome/get_relationship_record/$1';
$route['delete_relationship/(:any)']="welcome/delete_relationship/$1";
$route['get_leads']="welcome/get_leads";
$route['get_users']="welcome/get_users";
$route['get_lead_data_appointment/(:any)']='welcome/get_lead_data_appointment/$1';
$route['get_dealers_data/(:any)']='welcome/get_dealers_data/$1';
//$route['edit_appointment_details']="welcome/edit_appointment_form";
$route['getcalendar/(:any)']='googlecalendar/showcalendar/$1';
$route['login']='welcome/login';
$route['logindata']='welcome/logincode';
$route['home_page']='welcome/home_page_view';
//$route['logout']="welcome/logoutcode";
/*$route['dashboard']='welcome/dashboard';*/
$route['check_lead_duplicate']='welcome/check_lead_duplicate';
$route['edit_page_access/(:any)']="welcome/edit_page_access/$1";
// google api
//$route['linkgoogleapi']='auth/login';
//$route['sync_appointment']='googlecalendar/sync_appointments';
$route['sync_appointment']='googlecalendar/addEvent';
$route['appointment_bkng_login']='googlecalendar/bkng_login';
$route['google_appointments']='googlecalendar/view_appointments';
$route['attendees']='googlecalendar/addEvent';
//$route['view_appointments']='welcome/view_local_appointments';
//$route['use_calendar']='';
$route['api_login']='googlecalendar/login';
$route['appointment_login']='googlecalendar/login1';
//$route['api_login/(:any)']='googlecalendar/login/$1';
$route['edit_appointment_details']="googlecalendar/addEvent";
$route['getcal_list']='googlecalendar/GetCalendarsList';
$route['apptmnt_booking']="googlecalendar/addEvent";
$route['show_appoinment_page']='welcome/appointment_booking';
$route['getapi']='googlecalendar';
$route['logout']='googlecalendar/logout';
$route['logout1']='welcome/logout';
$route['show_appoinments']='welcome';
$route['user_creation']='welcome/create_user_data';
$route['create_dealer']='welcome/create_dealer_data';
$route['user_dtl']='welcome/display_data_emp';
$route['edit/(:any)']='welcome/edit_data/$1';
$route['edit_sales_rep']='welcome/edit_sales_rep_data';
$route['delete_sales/(:any)']='welcome/delete_sales_representatives/$1';
$route['dealer_dtl']='welcome/dealer_detail_display';
$route['dealer_edit/(:any)']='welcome/dealer_edit_data/$1';
$route['edit_dealer']='welcome/edit_dealer_rep_data';
$route['delete_dealer/(:any)']='welcome/delete_dealer_rep/$1';

$route['addevent']='auth/oauth';
$route['404_override'] = '';

$route['newcustomer_type']="welcome/addcustomer_type";
$route['display_customer_type']="welcome/customer_type_details";
$route['newcategory_type']="welcome/addcategory_type";
$route['display_category_type']="welcome/category_type_details";
$route['account_create']="welcome/user_info";


$route['quotation']="Quotation_Estimate/index";
$route['manageorder']="Quotation_order/index";


$route['getorderinfo/(:any)'] = "Quotation_Estimate/getorderinfo/$1";


$route['funnelreport']="Funnelreport/index";
$route['wonreport']="Wonreport/index";
$route['lostreport']="Lostreport/index";
$route['customerreport']="Customerreport/index";
$route['outlooklogin']="googlecalendar/check_session_outllok";
$route['googlemaps']="Googlemapcontroller/index";


/* End of file routes.php */
/* Location: ./application/config/routes.php */