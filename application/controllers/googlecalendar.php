<?php
/* * ***
 * Version: 1.0.0
 *
 * Description of Google Calendar Controller
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *
 * *** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Googlecalendar extends CI_Controller
{
     public  $tokendata="";
    public function __construct()
    {
        parent::__construct();

        //load library  

        $this->load->library('googleapi');
        $cal_id = $this->session->userdata('calendar_id');
        //$this->client->setLoginHint('indutestmail123@gmail.com');
        $this->googleapi->sethint($cal_id);
        $this->calendarapi = new Google_Service_Calendar($this->googleapi->client());
       
        // mocrosoft outlook client id and secret key
        define('CLIEND_ID', 'a1252244-099c-4899-b5a7-1a663b23b164');
        define('CLIEND_SECRET', '_SFr7/H?G]hgWatk1gZ6eJCSReqk4?0g');
       
       // load required outlook class
       require FCPATH . 'vendor/autoload.php';
       require APPPATH."third_party/src/Outlook/Authorizer/Contracts/SessionContract.php";

       require APPPATH.'third_party/src/Outlook/Authorizer/Authenticator.php';
        
       require_once APPPATH."third_party/src/Outlook/Exceptions/OutlookException.php";
       require_once APPPATH."third_party/src/Outlook/Exceptions/Authorizer/TokenException.php";
       require_once APPPATH."third_party/src/Outlook/Authorizer/Token.php";
       require_once APPPATH."third_party/src/Outlook/Authorizer/Session.php";
       require_once APPPATH."third_party/src/Outlook/Calendars/Calendar.php";
       require_once APPPATH."third_party/src/Outlook/Calendars/CalendarAuthorizer.php";

       require_once APPPATH."third_party/src/Outlook/Exceptions/Events/RestApiException.php";
       require_once APPPATH."third_party/src/Outlook/ApiRequester/Client.php";
       require_once APPPATH."third_party/src/Outlook/Calendars/CalendarManager.php";
      
 
    }
    public function demo()
    {
        echo "Testing";
    }
    public function index()
    {

        if (!$this->isLogin()) {

            /*$this->session->sess_destroy();  */

            redirect('googlecalendar/login');
        } else {
            /*    print_r($this->session->userdata('new'));
                exit;*/
            $data = array();

            $email = $this->session->userdata('email');


            $email = $this->session->userdata('email');

            $u_type = $this->user_model->get_usertype($email);

            $u = $u_type[0]['user_type'];

            $get = $this->user_model->get_permissions($u);

            $data['user_permission'] = unserialize($get[0]['permissions']);
            $data['layout'] = "public/layout";
            $data['header'] = "public/header";
            $data['footer'] = "public/footer";

            $data['body'] = "google-calendar/index";
            $this->load->view('welcome_message', $data);
        }
    }
    /*    public function attendees(){
        if($this->input->post('user_submit')){
            $cal_ids=$this->input->post('list');
            $fetch_ids=json_decode($cal_ids,true);
            $users_list=array();
            foreach ($fetch_ids as $key => $value) {
                $data =array();
                $data['email'] = $value;
            
                array_push($users_list,$data);

            }
           
            $id_list=$this->input->post('appointment_id');
            $list=json_decode($id_list,true);
            foreach ($list as $key ) {
                $rec=$this->user_model->get_appointment_details($key);
                $date=$rec[0]['start_date'];
                $time=$rec[0]['start_time'];
                   $dealer=$rec[0]['demo_dealer'];
                $ride=$rec[0]['ride_along'];
                $add_url=$rec[0]['add_url'];
                $addr=$rec[0]['appointment_address'];
                 $add_url=str_replace(' ', '', $add_url);
                  $adr=str_replace(' ', '', $add_url);
                $event = array(
                    'summary'     => 'Appointment',
                    'start'       => $date.'T'.$time.':00',
                    'end'         => $date.'T'.$time.':00',
                      'description' => 'Appointment with '.ucfirst($dealer).' and '.ucfirst($ride),
                      'location'=>$addr,
                      'colorId'=>2
                      
                    
                );
      
                $data = $this->actionEvent('primary',$event,$users_list);
                $event_id1=$data['id'];
             $result1=$this->user_model->sync_update_appointment($key,$cal,$event_id1);
              
            }
        
                $this->session->set_flashdata('app', 'data saved');
              redirect('manage_appointment');
        }
    }*/
    public function view_appointments()
    {


        $email = $this->session->userdata('email');
        if ($email) {
            $u_type = $this->user_model->get_usertype($email);

            $u = $u_type[0]['user_type'];

            $get = $this->user_model->get_permissions($u);

            $data['user_permission'] = unserialize($get[0]['permissions']);
            $data['layout'] = "public/layout";
            $data['header'] = "public/header";
            $data['footer'] = "public/footer";

            $data['body'] = "google-calendar/index";
            $this->load->view('welcome_message', $data);
        } else {
            redirect('login');
        }



        // $this->load->view('google-calendar/index', $data);

    }

    public function getCalendar($id = 'primary')
    {
        if (!$this->isLogin()) {

            /*   print_r("getCalendar");
            exit();*/
            /*  $this->session->sess_destroy();  */

            //redirect('googlecalendar/login');
            $data = array();
            $curentDate = date('Y-m-d', time());
            //echo $this->input->post('page').'-';
            if ($this->input->post('page') != '') {
                
                $malestr = str_replace("?", "", $this->input->post('page'));
                $navigation = explode('/', $malestr);
                $getYear = $navigation[1];
                $getMonth = $navigation[2];
                $start = date($getYear . '-' . $getMonth . '-01') . ' 00:00:00';
                $start1 = date($getYear . '-' . $getMonth . '-01');
                $end1 = date($getYear . '-' . $getMonth . '-t');
                $end = date($getYear . '-' . $getMonth . '-t') . ' 23:59:59';
            } else {
                $getYear = date('Y');
                $getMonth = date('m');
                $start = date('Y-m-01') . ' 00:00:00';
                $end = date('Y-m-t') . ' 23:59:59';
                $start1 = date('Y-m-01');
                $end1 = date('Y-m-t');
            }
            if ($this->input->post('year') != '') {
                $getYear = $this->input->post('year');
                $start = date($getYear . '-m-01') . ' 00:00:00';
                $end = date($getYear . '-m-t') . ' 23:59:59';
                $start1 = date($getYear . '-m-01');
                $end1 = date($getYear . '-m-t');
            }
            if ($this->input->post('month') != '') {
                $getMonth = $this->input->post('month');
                $start = date($getYear . '-' . $getMonth . '-01') . ' 00:00:00';
                $end = date($getYear . '-' . $getMonth . '-t') . ' 23:59:59';
                $start1 = date($getYear . '-' . $getMonth . '-01');
                $end1 = date($getYear . '-' . $getMonth . '-t');
            }

            $already_selected_value = $getYear;
            $earliest_year = 1950;
            $startYear = '';
            $googleEventArr = array();
            $calendarData = array();

            // $eventData = $this->getEvents($id, $start, $end, 40);


            $eventData = array();
            $email = $this->session->userdata('email');
            $user_id = $this->user_model->user_id($email);
            $user_type = $this->session->userdata('user_type');
            if ($user_type == 'Admin') {

                $eventData = $this->user_model->get_admin_local_appointments($start1, $end1);
                $eventData1 = $this->user_model->get_user_appointments($user_id, $start1, $end1);
                $eventData = array_merge($eventData, $eventData1);
            } else {
                $eventData = $this->user_model->get_local_appointments($user_id, $start1, $end1);
            }


            /*  $token = $this->session->userdata('is_authenticate_user');
            if($token){
                 $google_events = $this->getEvents($id, $start, $end, 40);
             $eventData=array_merge($eventData, $google_events);
            } */


            foreach ($eventData as $element) {
             
                if($element['resudeal_date'] !="" && $element['reschedultime'] !=""){
                    $googleEventArr[ltrim(date('d', strtotime($element['resudeal_date'])), 0)] = '<a data-google_event="' . ltrim(date('Y-m-d', strtotime($element['start_date'])), 0) . '" href="#" data-caltoggle="tooltip" data-placement="bottom" title="Google Events" class="small google-event" data-toggle="modal" data-target="#google-cal-data" rel="noopener noreferrer"><i class="fa fa-fw fa-circle text-primary"></i></a>';

                }else{
                    $googleEventArr[ltrim(date('d', strtotime($element['start_date'])), 0)] = '<a data-google_event="' . ltrim(date('Y-m-d', strtotime($element['start_date'])), 0) . '" href="#" data-caltoggle="tooltip" data-placement="bottom" title="Google Events" class="small google-event" data-toggle="modal" data-target="#google-cal-data" rel="noopener noreferrer"><i class="fa fa-fw fa-circle text-primary"></i></a>';

                }
            }

            //print_r($googleEventArr);
            foreach (array_keys($googleEventArr) as $key) {
                //$x=$x+1;
                $calendarData[$key] =  '<div class="calendar-dot-area small" style="position: relative;z-index: 2;">' . (isset($googleEventArr[$key]) ? $googleEventArr[$key] : '')  . '</div>';
            }

            $class = 'href="#" data-currentdate="' . $curentDate . '" class="add-gc-event" data-toggle="modal" data-target="#gc-create-event" data-year="' . $getYear . '" data-month="' . $getMonth . '" data-days="{day}"';

            $startYear .= '<div class="col-md-2"><div class="select-control"><select name="year" id="setYearVal" class="form-control">';
            foreach (range(date('Y') + 50, $earliest_year) as $x) {
                $startYear .= '<option value="' . $x . '"' . ($x == $already_selected_value ? ' selected="selected"' : '') . '>' . $x . '</option>';
            }
            $startYear .= '</select></div></div>';
            $startMonth = '<div class="col-md-2"><div class="select-control"><select name="month" id="setMonthVal" class="form-control"><option value="0">Select Month</option>
            <option value="01" ' . ('01' == $getMonth ? ' selected="selected"' : '') . '>January</option>
            <option value="02" ' . ('02' == $getMonth ? ' selected="selected"' : '') . '>February</option>
            <option value="03" ' . ('03' == $getMonth ? ' selected="selected"' : '') . '>March</option>
            <option value="04" ' . ('04' == $getMonth ? ' selected="selected"' : '') . '>April</option>
            <option value="05" ' . ('05' == $getMonth ? ' selected="selected"' : '') . '>May</option>
            <option value="06" ' . ('06' == $getMonth ? ' selected="selected"' : '') . '>June</option>
            <option value="07" ' . ('07' == $getMonth ? ' selected="selected"' : '') . '>July</option>
            <option value="08" ' . ('08' == $getMonth ? ' selected="selected"' : '') . '>August</option>
            <option value="09" ' . ('09' == $getMonth ? ' selected="selected"' : '') . '>September</option>
            <option value="10" ' . ('10' == $getMonth ? ' selected="selected"' : '') . '>October</option>
            <option value="11" ' . ('11' == $getMonth ? ' selected="selected"' : '') . '>November</option>
            <option value="12" ' . ('12' == $getMonth ? ' selected="selected"' : '') . '>December</option>
    </select></div></div>';

            //{heading_title_cell}<th colspan="{colspan}">'.$startMonth.'&nbsp;'.$startYear.'{heading}</th>{/heading_title_cell}      
            $prefs['template'] = '
        

        {table_open}<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

        {heading_row_start}<tr style="border:none;">{/heading_row_start}

        {heading_previous_cell}<th style="border:none; " class="padB"><a class="calnav"  data-calvalue="{previous_url}" href="javascript:void(0);"><i class="fa fa-chevron-left fa-fw"></i></a></th>{/heading_previous_cell}
        {heading_title_cell}<th style="border:none;" colspan="{colspan}"><div class="row">' . $startMonth . '' . $startYear . '</div></th>{/heading_title_cell}
        {heading_next_cell}<th style="border:none;" class="padB"><a class="calnav" data-calvalue="{next_url}" href="javascript:void(0);"><i class="fa fa-chevron-right fa-fw calendar_style"  ></i></a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<th>{week_day}</th>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a ' . $class . '>{day}</a>{content}{/cal_cell_content}
        {cal_cell_content_today}<a ' . $class . '>{day}</a>{content}<div class="highlight"></div>{/cal_cell_content_today}

        {cal_cell_no_content}<a ' . $class . '>{day}</a>{/cal_cell_no_content}
        {cal_cell_no_content_today}<a ' . $class . '>{day}</a><div class="highlight"></div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}';
            $prefs['start_day'] = 'monday';
            $prefs['day_type'] = 'short';
            $prefs['show_next_prev'] = TRUE;
            $prefs['next_prev_url'] = '?';

            $this->load->library('calendar', $prefs);
            $data['calendar'] = $this->calendar->generate($getYear, $getMonth, $calendarData, $this->uri->segment(3), $this->uri->segment(4));
            /*print_r("getcal".$data['calendar']);
        exit();*/
            echo $data['calendar'];
        } else {

            $data = array();
            $curentDate = date('Y-m-d', time());
            //echo $this->input->post('page').'-';
            if ($this->input->post('page') != '') {
                $malestr = str_replace("?", "", $this->input->post('page'));
                $navigation = explode('/', $malestr);
                $getYear = $navigation[1];
                $getMonth = $navigation[2];
                $start = date($getYear . '-' . $getMonth . '-01') . ' 00:00:00';
                $end = date($getYear . '-' . $getMonth . '-t') . ' 23:59:59';
                $start1 = date($getYear . '-' . $getMonth . '-01');
                $end1 = date($getYear . '-' . $getMonth . '-t');
            } else {
                $getYear = date('Y');
                $getMonth = date('m');
                $start = date('Y-m-01') . ' 00:00:00';
                $end = date('Y-m-t') . ' 23:59:59';
                $start1 = date('Y-m-01');
                $end1 = date('Y-m-t');
            }
            if ($this->input->post('year') != '') {
                $getYear = $this->input->post('year');
                $start = date($getYear . '-m-01') . ' 00:00:00';
                $end = date($getYear . '-m-t') . ' 23:59:59';
                $start1 = date($getYear . '-m-01');
                $end1 = date($getYear . '-m-t');
            }
            if ($this->input->post('month') != '') {
                $getMonth = $this->input->post('month');
                $start = date($getYear . '-' . $getMonth . '-01') . ' 00:00:00';
                $end = date($getYear . '-' . $getMonth . '-t') . ' 23:59:59';
                $start1 = date($getYear . '-' . $getMonth . '-01');
                $end1 = date($getYear . '-' . $getMonth . '-t');
            }

            $already_selected_value = $getYear;
            $earliest_year = 1950;
            $startYear = '';
            $googleEventArr = array();
            $calendarData = array();

            // $eventData = $this->getEvents($id, $start, $end, 40);
            $eventData = array();
            $email = $this->session->userdata('email');
            $user_id = $this->user_model->user_id($email);
            $user_type = $this->session->userdata('user_type');
            if ($user_type == 'Admin') {
                $eventData = $this->user_model->get_admin_local_appointments_sync($start1, $end1);
            } else {
                $eventData = $this->user_model->get_local_appointments($user_id, $start1, $end1);
            }
            /* $eventData=$this->user_model->get_local_appointments($user_id,$start1,$end1);*/
            $token = $this->session->userdata('is_authenticate_user');
            if ($token) {
                $google_events = $this->getEvents($id, $start, $end, 40);
                /*  print_r($google_events);
                 exit;*/
                if ($eventData) {
                    $eventData = array_merge($eventData, $google_events);
                } else {
                    $eventData = $google_events;
                }
                /*    print_r($eventData);
             exit;*/
            }

            foreach ($eventData as $element) {

                $googleEventArr[ltrim(date('d', strtotime($element['start_date'])), 0)] = '<a data-google_event="' . ltrim(date('Y-m-d', strtotime($element['start_date'])), 0) . '" href="#" data-caltoggle="tooltip" data-placement="bottom" title="Google Events" class="small google-event" data-toggle="modal" data-target="#google-cal-data" rel="noopener noreferrer"><i class="fa fa-fw fa-circle text-primary"></i></a>';
            }

            //print_r($googleEventArr);
            foreach (array_keys($googleEventArr) as $key) {
                //$x=$x+1;
                $calendarData[$key] =  '<div class="calendar-dot-area small" style="position: relative;z-index: 2;">' . (isset($googleEventArr[$key]) ? $googleEventArr[$key] : '')  . '</div>';
            }

            $class = 'href="#" data-currentdate="' . $curentDate . '" class="add-gc-event" data-toggle="modal" data-target="#gc-create-event" data-year="' . $getYear . '" data-month="' . $getMonth . '" data-days="{day}"';

            $startYear .= '<div class="col-md-2"><div class="select-control"><select name="year" id="setYearVal" class="form-control">';
            foreach (range(date('Y') + 50, $earliest_year) as $x) {
                $startYear .= '<option value="' . $x . '"' . ($x == $already_selected_value ? ' selected="selected"' : '') . '>' . $x . '</option>';
            }
            $startYear .= '</select></div></div>';
            $startMonth = '<div class="col-md-2 "><div class="select-control"><select name="month" id="setMonthVal" class="form-control"><option value="0">Select Month</option>
            <option value="01" ' . ('01' == $getMonth ? ' selected="selected"' : '') . '>January</option>
            <option value="02" ' . ('02' == $getMonth ? ' selected="selected"' : '') . '>February</option>
            <option value="03" ' . ('03' == $getMonth ? ' selected="selected"' : '') . '>March</option>
            <option value="04" ' . ('04' == $getMonth ? ' selected="selected"' : '') . '>April</option>
            <option value="05" ' . ('05' == $getMonth ? ' selected="selected"' : '') . '>May</option>
            <option value="06" ' . ('06' == $getMonth ? ' selected="selected"' : '') . '>June</option>
            <option value="07" ' . ('07' == $getMonth ? ' selected="selected"' : '') . '>July</option>
            <option value="08" ' . ('08' == $getMonth ? ' selected="selected"' : '') . '>August</option>
            <option value="09" ' . ('09' == $getMonth ? ' selected="selected"' : '') . '>September</option>
            <option value="10" ' . ('10' == $getMonth ? ' selected="selected"' : '') . '>October</option>
            <option value="11" ' . ('11' == $getMonth ? ' selected="selected"' : '') . '>November</option>
            <option value="12" ' . ('12' == $getMonth ? ' selected="selected"' : '') . '>December</option>
    </select></div></div>';

            //{heading_title_cell}<th colspan="{colspan}">'.$startMonth.'&nbsp;'.$startYear.'{heading}</th>{/heading_title_cell} 

            $prefs['template'] = '
        

        {table_open}<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

        {heading_row_start}<tr style="border:none;">{/heading_row_start}

        {heading_previous_cell}<th style="border:none;" class="padB"><a class="calnav" data-calvalue="{previous_url}" href="javascript:void(0);"><i class="fa fa-chevron-left fa-fw"></i></a></th>{/heading_previous_cell}
        {heading_title_cell}<th style="border:none;" colspan="{colspan}"><div class="row" st>' . $startMonth . '' . $startYear . '</div></th>{/heading_title_cell}
        {heading_next_cell}<th style="border:none;" class="padB"><a class="calnav" data-calvalue="{next_url}" href="javascript:void(0);"><i class="fa fa-chevron-right fa-fw calendar_style" ></i></a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<th>{week_day}</th>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a ' . $class . '>{day}</a>{content}{/cal_cell_content}
        {cal_cell_content_today}<a ' . $class . '>{day}</a>{content}<div class="highlight"></div>{/cal_cell_content_today}

        {cal_cell_no_content}<a ' . $class . '>{day}</a>{/cal_cell_no_content}
        {cal_cell_no_content_today}<a ' . $class . '>{day}</a><div class="highlight"></div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}';
            $prefs['start_day'] = 'monday';
            $prefs['day_type'] = 'short';
            $prefs['show_next_prev'] = TRUE;
            $prefs['next_prev_url'] = '?';

            $this->load->library('calendar', $prefs);
            $data['calendar'] = $this->calendar->generate($getYear, $getMonth, $calendarData, $this->uri->segment(3), $this->uri->segment(4));
            /*print_r("getcal".$data['calendar']);
        exit();*/
            echo $data['calendar'];
        }
    }
    public function bkng_login()
    {
        if ($this->session->userdata('is_authenticate_user') == TRUE) {

            redirect('googlecalendar/index');
        } else {


            $data = array();
            $this->session->set_userdata('y', 'true');
            $data['loginUrl'] = $this->loginUrl();
            $email = $this->session->userdata('email');
            $u_type = $this->user_model->get_usertype($email);
            $u = $u_type[0]['user_type'];
            $get = $this->user_model->get_permissions($u);
            $data['user_permission'] = unserialize($get[0]['permissions']);
            $data['layout'] = "public/layout";
            $data['header'] = "public/header";
            $data['footer'] = "public/footer";
            $data['body'] = "google-calendar/login";
            $this->load->view('welcome_message', $data);
        }
    }
    //get calendar id's using curl
    public function GetCalendarsList()
    {
        /*
               $list1 =array(
                    'minAccessRole'=>'owner');
           
                $list=$this->calendarapi->calendarList->listCalendarList($list1); 
                $l=$list['items'];
                $cal_list=array();
                foreach ($l as $key => $value) {
                    $data =array();
                        $data['id'] = $value['id'];          
                        array_push($cal_list,$data);        
                }
                print_r(json_encode($cal_list));*/
        $tk = $this->session->userdata('google_calendar_access_token');
        $access_token = json_decode($tk, true);
        /*print_r($access_token['access_token']);
            exit();*/
        $a_token = $access_token['access_token'];
        $url_parameters = array();

        $url_parameters['fields'] = 'items(id,summary,timeZone)';
        $url_parameters['minAccessRole'] = 'owner';

        $url_calendars = 'https://www.googleapis.com/calendar/v3/users/me/calendarList?' . http_build_query($url_parameters);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_calendars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $a_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $data = json_decode(curl_exec($ch), true); //echo '<pre>';print_r($data);echo '</pre>';
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200)
            throw new Exception('Error : Failed to get calendars list');
        $this->session->set_userdata('cal_id', $data['items']);

        print_r(json_encode($data['items']));
    }
    public function login1()
    { 
        $email = $this->session->userdata('email');
        $u_type = $this->user_model->get_usertype($email);
        $u = $u_type[0]['user_type'];
        $get = $this->user_model->get_permissions($u);
        $user_permission = unserialize($get[0]['permissions']);
        if (in_array('createViewOutLookAppointment', $user_permission)){
               $this->check_session_outllok();
        }else{
       
        if ($this->session->userdata('is_authenticate_user') == TRUE) {

            redirect('googlecalendar/index');
        } else {

            $data = array();
            $data['loginUrl'] = $this->loginUrl();
            $email = $this->session->userdata('email');
            $u_type = $this->user_model->get_usertype($email);
            $u = $u_type[0]['user_type'];
            $get = $this->user_model->get_permissions($u);
            $data['user_permission'] = unserialize($get[0]['permissions']);
            $data['layout'] = "public/layout";
            $data['header'] = "public/header";
            $data['footer'] = "public/footer";
            $data['body'] = "google-calendar/login";
            $this->load->view('welcome_message', $data);
        }
    }
    }
    // login method
    public function login()
    {
        if ($this->session->userdata('is_authenticate_user') == TRUE) {

            redirect('googlecalendar/index');
        } else {

            $email = $this->session->userdata('email');
            if ($email) {
                $data = array();
                $this->session->set_userdata('x', 'true');
                $data['loginUrl'] = $this->loginUrl();

                $u_type = $this->user_model->get_usertype($email);
                $u = $u_type[0]['user_type'];
                $get = $this->user_model->get_permissions($u);
                $data['user_permission'] = unserialize($get[0]['permissions']);
                $data['layout'] = "public/layout";
                $data['header'] = "public/header";
                $data['footer'] = "public/footer";
                $data['body'] = "google-calendar/login";
                $this->load->view('welcome_message', $data);
            } else {
                redirect('login');
            }
        }
    }
    public function update_google_events()
    {
        print_r($_POST);
        exit;
    }
    public function notifications()
    {
        // $uid=uniqid();

        // $calendar=$this->session->userdata('email');
        // $url = sprintf("https://www.googleapis.com/calendar/v3/calendars/%s/events/watch", $calendar);
        // $tk=$this->session->userdata('google_calendar_access_token');
        //$access_token=json_decode($tk,true);
        //$a_token=$access_token['access_token'];
        // print_r($calendar);
        /* setup the POST parameters */
        /*$fields = json_encode(array(
                'id'        =>  $uid,
                'type'      => "web_hook",
                'address'   => "https://acmesoftware.net/lm/UAT1/googlecalendar/notifications"
                ));

            print_r($fields);
            /* setup POST headers */
        //  $headers[] = 'Content-Type: application/json';
        // $headers[] = 'Authorization: Bearer ' . $a_token;
        /* print_r($headers);
              exit;*/
        /* send POST request */
        /* $channel = curl_init();
            curl_setopt($channel, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($channel, CURLOPT_URL, $url);
            curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($channel, CURLOPT_POST, true);
            curl_setopt($channel, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($channel, CURLOPT_TIMEOUT, 3);
            $response = curl_exec($channel);
           print_r(curl_exec($channel));
           exit;
            curl_close($channel);
            error_log($response);*/

        //print_r($_GET);
        //print_r($_POST);exit;
    }
    // list of events
    public function events_list($cal_id)
    {
        date_default_timezone_set("Asia/Kolkata");
        /*    $y= date("Y");
             $s_date=$y.'01'.'01';
             $e_date=$y.'12'.'31';
             $timeMin= date("c", strtotime($s_date));
              $timeMax= date("c", strtotime($e_date));
              $optParams = array(
            'maxResults'   => $maxResults,
            'orderBy'      => 'updated',
            'singleEvents' => true,
            'timeMin'      => $timeMin,
            'timeMax'      => $timeMax,
            'timeZone'     => 'Asia/Kolkata',
        );*/
        $events = $this->calendarapi->events->listEvents($cal_id);
        $data = array();
        foreach ($events->getItems() as $item) {

            if (!empty($item->getStart()->date) && !empty($item->getEnd()->date)) {
                $startDate = date('Y-m-d H:i', strtotime($item->getStart()->date));

                $endDate = date('Y-m-d H:i', strtotime($item->getEnd()->date));
            } else {
                $startDate = date('Y-m-d H:i', strtotime($item->getEnd()->dateTime));
                $endDate = date('Y-m-d H:i', strtotime($item->getEnd()->dateTime));
            }

            $created = date('Y-m-d H:i', strtotime($item->getCreated()));
            $updated = date('Y-m-d H:i', strtotime($item->getUpdated()));
            array_push(
                $data,
                array(
                    'id'          => $item->getId(),
                    'summary'     => trim($item->getSummary()),
                    'description' => trim($item->getDescription()),
                    'creator'     => $item->getCreator()->getEmail(),
                    'organizer'     => $item->getOrganizer()->getEmail(),
                    'creatorDisplayName'     => $item->getCreator()->getDisplayName(),
                    'organizerDisplayName'     => $item->getOrganizer()->getDisplayName(),
                    'created'         => $created,
                    'updated'       => $updated,
                    'start_date'       => $startDate,
                    'end_date'         => $endDate,
                    'status'          => $item->getStatus(),
                    'location' => $item->getLocation(),
                    'sequence' => $item->getSequence(),
                    'attendees' => $item->getAttendees(),
                )
            );
        }
        return $data;
    }
    // oauth method
    public function oauth()
    {

        $code = $this->input->get('code', true);
        $this->oauthLogin($code);
        //$this->notifications();
        /* $list1 =array(
            'minAccessRole'=>'owner');  
        $list=$this->calendarapi->calendarList->listCalendarList($list1);    
        $cal_ids=$list['items'];
        $email=$this->session->userdata('email');
     
        foreach ($cal_ids as $key => $calendarId) {
           
                $events=$this->events_list($calendarId['id']);
       
           $user_id=$this->user_model->user_id($email);
           $localsynccalendardata=$this->user_model->get_appointments_details($user_id);
   
                foreach ($events as $key2 => $value2) {
                foreach ($localsynccalendardata as $key1 => $value1) {
                if(($value2['id']==$value1['event_id'])&&($value2['sequence']>$value1['sequence']))
                {            
                     $date=preg_split ("/\ /", $value2['start_date']);     
             
                     $attendees='';
                     foreach ($value2['attendees'] as $key => $value) {
                         $attendees.=$value['email'].',';
                         
                     }
                    
                    $update=$this->user_model->update_database_appointments($value1['event_id'],$date[0],$date[1],$attendees,$value2['description'],$value2['sequence']);                   
                }
             }
             }         
               
        }*/
        $uid = uniqid();

        $calendar = $this->session->userdata('email');
        $url = sprintf("https://www.googleapis.com/calendar/v3/calendars/%s/events/watch", $calendar);
        // echo $url;
        $tk = $this->session->userdata('google_calendar_access_token');
        $access_token = json_decode($tk, true);
        $a_token = $access_token['access_token'];
        // print_r($calendar);
        /* setup the POST parameters */
        $fields = json_encode(array(
            'id'        =>  $uid,
            'type'      => "web_hook",
            'address'   => "https://acmesoftware.net/lm/UAT1/googlecalendar/notifications"
        ));

        // print_r($fields);
        /* setup POST headers */
        $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $a_token);
        // $headers[] = 'Content-Type: application/json';
        //$headers[] = 'Authorization: Bearer ' . $a_token;
        //   print_r($headers);
        //exit;
        /* send POST request */
        $channel = curl_init();
        curl_setopt($channel, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($channel, CURLOPT_URL, $url);
        curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($channel, CURLOPT_POST, true);
        curl_setopt($channel, CURLOPT_POSTFIELDS, $fields);
        //  curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, 2);
        // curl_setopt($channel, CURLOPT_TIMEOUT, 3);
        $response = curl_exec($channel);
        // print_r($response);
        //   exit;           
        //  curl_close($channel);

        error_log($response);

        /* $event = new Google_Service_Calendar_Channel(array(
                'id'        => uniqid(),
                'type'      => "web_hook",
                'address'   => "https://acmesoftware.net/lm/UAT1/googlecalendar/notifications"
                ));
            $this->calendarapi->events->watch($calendarId, $event);*/



        //  $this->notifications();
        $y = $this->session->userdata('y');
        $x = $this->session->userdata('x');
        if ($x) {
            redirect('googlecalendar');
        } else if ($y) {
            redirect('appointment');
        } else {
            redirect('manage_appointment');
        }
    }
    // check login session
    public function isLogin()
    {
        $token = $this->session->userdata('google_calendar_access_token');
        if ($token) {
            $this->googleapi->client->setAccessToken($token);
        }
        if ($this->googleapi->isAccessTokenExpired()) {
            /* print_r("islogin-accesstokenexpired");
            exit();*/
            //  $this->googleapi->getRefreshToken();
            return false;
        }
        return $token;
    }
    public function loginUrl()
    {
        return $this->googleapi->loginUrl();
    }
    // oauthLogin
    public function oauthLogin($code)
    {
        $login = $this->googleapi->client->authenticate($code);

        if ($login) {
            $token = $this->googleapi->client->getAccessToken();
            //print_r($token);exit;
            $access_token = json_decode($token, true);

            $ref_token = $access_token['refresh_token'];
            $user = $this->session->userdata('email');

            $this->user_model->store_refresh_token($user, $ref_token);

            $this->session->set_userdata('refresh_token', $ref_token);

            $this->session->set_userdata('google_calendar_access_token', $token);

            $this->session->set_userdata('is_authenticate_user', TRUE);
            $this->googleapi->client->setAccessToken($token);
            return true;
        }
    }
    // get User Info
    public function getUserInfo()
    {
        return $this->googleapi->getUser();
    }
    // get Events
    public function getEvents($calendarId = 'primary', $timeMin = false, $timeMax = false, $maxResults = 10)
    {
        date_default_timezone_set("Asia/Kolkata");

        if (!$timeMin) {
            $timeMin = date("c", strtotime(date('Y-m-d ') . ' 00:00:00'));
        } else {
            $timeMin = date("c", strtotime($timeMin));
        }

        if (!$timeMax) {
            $timeMax = date("c", strtotime(date('Y-m-d ') . ' 23:59:59'));
        } else {
            $timeMax = date("c", strtotime($timeMax));
        }
        $optParams = array(
            'maxResults'   => $maxResults,
            'orderBy'      => 'startTime',
            'singleEvents' => true,
            'timeMin'      => $timeMin,
            'timeMax'      => $timeMax,
            'timeZone'     => 'Asia/Kolkata',
        );

        $results = $this->calendarapi->events->listEvents($calendarId, $optParams);

        $data = array();
        //  $creator = new Google_Service_Calendar_EventCreator();


        foreach ($results->getItems() as $item) {

            if (!empty($item->getStart()->date) && !empty($item->getEnd()->date)) {
                $startDate = date('d-m-Y H:i', strtotime($item->getStart()->date));
                $endDate = date('d-m-Y H:i', strtotime($item->getEnd()->date));
            } else {
                $startDate = date('d-m-Y H:i', strtotime($item->getEnd()->dateTime));
                $endDate = date('d-m-Y H:i', strtotime($item->getEnd()->dateTime));
            }

            $created = date('d-m-Y H:i', strtotime($item->getCreated()));
            $updated = date('d-m-Y H:i', strtotime($item->getUpdated()));

            array_push(
                $data,
                array(
                    'id'          => $item->getId(),
                    'summary'     => trim($item->getSummary()),
                    'description' => trim($item->getDescription()),
                    'creator'     => $item->getCreator()->getEmail(),
                    'organizer'     => $item->getOrganizer()->getEmail(),
                    'creatorDisplayName'     => $item->getCreator()->getDisplayName(),
                    'organizerDisplayName'     => $item->getOrganizer()->getDisplayName(),
                    'created'         => $created,
                    'updated'       => $updated,
                    'start_date'       => $startDate,
                    'end_date'         => $endDate,
                    'status'          => $item->getStatus(),
                    'location' => $item->getLocation(),
                    'sequence' => $item->getSequence(),
                    'attendees' => $item->getAttendees()
                )
            );
        }
        /*   print_r($data) ;
        exit;*/
        return $data;
    }


    // update google calendar event or appointment

    public function UpdateCalendarEvent($event_id, $calendar_id, $event, $access_token)
    {
        $url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events/' . $event_id;

        $curlPost = $event;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_events);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token, 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200)
            throw new Exception('Error : Failed to update event');
    }

    public function delete_appoint_dt($id)
    {

        $cal_id = $this->user_model->get_cal_id($id);
        $cal_id_val = $cal_id[0]['calendar_id'];
        $cal_event_id = $cal_id[0]['event_id'];
        if ($cal_id_val) {
            $tk = $this->session->userdata('google_calendar_access_token');
            $access_token = json_decode($tk, true);
            $a_token = $access_token['access_token'];
            $this->DeleteCalendarEvent($cal_event_id, $cal_id_val, $a_token);
        }
        $this->user_model->delete_appoint($id);

        echo "success";
    }
    // add google calendar event
    public function addEvent()
    {

        if ($this->input->post('ap_submit')) {
             
            $calendar_id = $this->input->post('ap_cal_id');
            $calendar_id1 = $this->input->post('show_cal');
            $ride[]=array();

            $email = $this->session->userdata('email');
            $u_type = $this->user_model->get_usertype($email);
            $u = $u_type[0]['user_type'];
            $get = $this->user_model->get_permissions($u);
            $user_permission = unserialize($get[0]['permissions']);
            if (in_array('createViewOutLookAppointment', $user_permission)){
                    $authenticator = new Outlook\Authorizer\Authenticator(
                    CLIEND_ID,
                    CLIEND_SECRET,
                    // $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
                    $redirectUri = "https://localhost/lead_management/appointment"
                    //$redirectUri="https://acmesoftware.net/lead_management/googlecalendar/calender_event"
                    );
                    
                    $sessionManager = new Outlook\Authorizer\Session();
                    
                    //$sessionManager->remove(); // if ne
                    
                    
                    
                    $eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);
                    
                    
                    $token= $eventAuthorizer->isAuthenticated();
                    //  $eventAuthorizer->renewToken();
                    
                    
                    if (!$token) {
                       // $this->outlook_login();
                       $lead = $this->input->post('lead');// change by sagar
                       $date = $this->input->post('ap_date');
                       $start_time = $this->input->post('ap_stime');
                       $end_time = $this->input->post('ap_stime');
                      // $gift = $this->input->post('gift');//change by sagar
                       $demo_dealer = $this->input->post('demo_dealer');
                       $ride = $this->input->post('ride');
                    //   $setby = $this->input->post('setby');
                       $addr = $this->input->post('ap_addr');
                       $notes = $this->input->post('ap_notes');
                       $add_url = $this->input->post('add_url');
                       $status = $this->input->post('status');
                       //$assistant = $this->input->post('assistant');
                      // $supervisor = $this->input->post('supervisor');
                       $demo_notes = $this->input->post('demo_notes');
                       //   $summary=$this->input->post('ap_summary');
                       $summary = 'appointment';
                       $email = $this->session->userdata('email');
                       $user_id = $this->user_model->user_id($email);
                       if($ride !=""){
                           $ride = implode(",", $ride);
                       }else{
                           $ride="";
                       }
                       
                    
       
                      
                       // $rideinfo=array();
                       // foreach($ride as $ridedata){
                       //     array_push($rideinfo,$ridedata);
                       // }
                    
       
                           
                     
       
                       $reg = array(
                           'user_id'       => $user_id,
                           'calendar_id' => '--',
                           'lead_id' => $lead,
                           'start_date'     => $date,
                           'start_time' => $start_time,
                           'end_time' => $end_time,
                          // 'gift'      => '',////change by sagar
                           'demo_dealer' => $demo_dealer,
                           'ride_along' => $ride,
                           'set_by'        => '',
                           'appointment_address'       => $addr,
                           'appointment_notes' => $notes,
                           'event_id' => '-----',//change by sagar
                           'synchronize' => 'local',
                           'add_url' => $add_url,
                           'appointment_status' => $status,
                           'demo_notes' => $demo_notes,
                           'assistant' => '',
                           'supervisor' => '',
       
                       );
                       $result = $this->user_model->app_info_insert($reg);
                       //set lead appointment status
       
                       $this->session->set_flashdata('app1', 'data saved');
                       
                       redirect('appointment');
                        
                    } else {   
                        
                        // $ap_date	= $this->input->post('ap_date');
                        // $subject	= $this->input->post('subject');
                        // $content	= $this->input->post('content');
                        // $ap_stime	= $this->input->post('ap_stime');
                        // $ed_date	= $this->input->post('ed_date');
                        // $ed_stime	= $this->input->post('ed_stime');
                        // $calenderid	= $this->input->post('calenderid');

                        $lead = $this->input->post('lead');// change by sagar
                        $date = $this->input->post('ap_date');
                        $start_time = $this->input->post('ap_stime');
                        $end_time = $this->input->post('ap_stime');
                       // $gift = $this->input->post('gift');//change by sagar
                        $demo_dealer = $this->input->post('demo_dealer');
                        $ride = $this->input->post('ride');
                     //   $setby = $this->input->post('setby');
                        $addr = $this->input->post('ap_addr');
                        $notes = $this->input->post('ap_notes');
                        $add_url = $this->input->post('add_url');
                        $status = $this->input->post('status');
                        //$assistant = $this->input->post('assistant');
                       // $supervisor = $this->input->post('supervisor');
                        $demo_notes = $this->input->post('demo_notes');
                        //   $summary=$this->input->post('ap_summary');
                        $summary = 'appointment';
                        $email = $this->session->userdata('email');
                        $user_id = $this->user_model->user_id($email);
                        if($ride !=""){
                            $ride = implode(",", $ride);
                        }else{
                            $ride="";
                        }
                    
                       // echo  $calenderid;
                    
                           $eventManager = new Outlook\Calendars\CalendarManager($token);
                          
                                  $event = new Outlook\Calendars\Calendar(['subject' => 'Appointment']);
                                  
                                 $event->body = ['ContentType' => 'HTML', 'Content' => 'Appointment with ' . ucfirst($demo_dealer) . ' and ' . ucfirst($ride),];
                                 $event->start = ["DateTime" => $date.'T'.$start_time.":00", "TimeZone" => "India Standard Time"];
                                 $event->end = ["DateTime" => $date.'T'.$start_time.":00", "TimeZone" => "India Standard Time"];
                             
                                 if (($calendar_id == '--' && $calendar_id1 == '') || ($calendar_id == '' && $calendar_id1 == '--')) {
                                    $event = $eventManager->create1($event);
                                }else{
                                    $event = $eventManager->create($event,$calendar_id);
                                  } 
                    
                               
                              if($event->id !=""){
                                $reg = array(
                                    'user_id'       => $user_id,
                                    'calendar_id' => '--',
                                    'lead_id' => $lead,
                                    'start_date'     => $date,
                                    'start_time' => $start_time,
                                    'end_time' => $end_time,
                                   // 'gift'      => '',////change by sagar
                                    'demo_dealer' => $demo_dealer,
                                    'ride_along' => $ride,
                                    'set_by'        => '',
                                    'appointment_address'       => $addr,
                                    'appointment_notes' => $notes,
                                    'event_id' => $event->id,//change by sagar
                                    'synchronize' => 'local',
                                    'add_url' => $add_url,
                                    'appointment_status' => $status,
                                    'demo_notes' => $demo_notes,
                                    'assistant' => '',
                                    'supervisor' => '',
                
                                );
                                $result = $this->user_model->app_info_insert($reg);
                                //set lead appointment status
                
                                $this->session->set_flashdata('app1', 'data saved');
                                
                                redirect('appointment');
                            }
                        }


            }else{
         
            if (($calendar_id == '--' && $calendar_id1 == '') || ($calendar_id == '' && $calendar_id1 == '--')) {
              //  $lead = $this->input->post('lead');
                 $lead = $this->input->post('lead');// change by sagar
                $date = $this->input->post('ap_date');
                $start_time = $this->input->post('ap_stime');
                $end_time = $this->input->post('ap_stime');
               // $gift = $this->input->post('gift');//change by sagar
                $demo_dealer = $this->input->post('demo_dealer');
                $ride = $this->input->post('ride');
             //   $setby = $this->input->post('setby');
                $addr = $this->input->post('ap_addr');
                $notes = $this->input->post('ap_notes');
                $add_url = $this->input->post('add_url');
                $status = $this->input->post('status');
                //$assistant = $this->input->post('assistant');
               // $supervisor = $this->input->post('supervisor');
                $demo_notes = $this->input->post('demo_notes');
                //   $summary=$this->input->post('ap_summary');
                $summary = 'appointment';
                $email = $this->session->userdata('email');
                $user_id = $this->user_model->user_id($email);
                if($ride !=""){
                    $ride = implode(",", $ride);
                }else{
                    $ride="";
                }
                
             

               
                // $rideinfo=array();
                // foreach($ride as $ridedata){
                //     array_push($rideinfo,$ridedata);
                // }
             

                    
              

                $reg = array(
                    'user_id'       => $user_id,
                    'calendar_id' => '--',
                    'lead_id' => $lead,
                    'start_date'     => $date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                   // 'gift'      => '',////change by sagar
                    'demo_dealer' => $demo_dealer,
                    'ride_along' => $ride,
                    'set_by'        => '',
                    'appointment_address'       => $addr,
                    'appointment_notes' => $notes,
                    'event_id' => '-----',//change by sagar
                    'synchronize' => 'local',
                    'add_url' => $add_url,
                    'appointment_status' => $status,
                    'demo_notes' => $demo_notes,
                    'assistant' => '',
                    'supervisor' => '',

                );
                $result = $this->user_model->app_info_insert($reg);
                //set lead appointment status

                $this->session->set_flashdata('app1', 'data saved');
                
                redirect('appointment');
            } else {
                if (!$this->isLogin()) {

                    redirect('googlecalendar/login');
                }
                $page = $this->input->post('page');
                if ($page == 'manage') {
                    $id_list = $this->input->post('ap_ids');
                    $cal = $this->input->post('show_cal');
                    $list = json_decode($id_list, true);
                    foreach ($list as $key) {
                        $rec = $this->user_model->get_appointment_details($key);
                        $date = $rec[0]['start_date'];
                        $time = $rec[0]['start_time'];
                        $dealer = $rec[0]['demo_dealer'];
                        $ride = $rec[0]['ride_along'];
                        $add_url = $rec[0]['add_url'];
                        $addr = $rec[0]['appointment_address'];
                        $add_url = str_replace(' ', '', $add_url);
                        $adr = str_replace(' ', '', $add_url);
                        $event = array(
                            'summary'     => 'Appointment',
                            'start'       => $date . 'T' . $time . ':00',
                            'end'         => $date . 'T' . $time . ':00',
                            'description' => 'Appointment with ' . ucfirst($demo_dealer) . ' and ' . ucfirst($ride),
                            'location' => $addr,
                            'colorId' => 2
                        );
                        $data = $this->actionEvent($cal, $event);
                        $event_id1 = $data['id'];
                        $result1 = $this->user_model->sync_update_appointment($key, $cal, $event_id1);
                    }
                    $this->session->set_flashdata('app', 'data saved');
                    redirect('manage_appointment');
                } else if ($page == 'manage1') {
                    /* echo "manage1";exit;*/
                    $cal_ids = $this->input->post('list');
                    $fetch_ids = json_decode($cal_ids, true);
                    $users_list = array();
                    $list_of_attendees = '';
                    foreach ($fetch_ids as $key => $value) {
                        $data = array();
                        $data['email'] = $value;
                        $list_of_attendees .= $value . ',';
                        array_push($users_list, $data);
                    }
                    $id_list = $this->input->post('appointment_id');
                    $list = json_decode($id_list, true);
                    foreach ($list as $key) {
                        $rec = $this->user_model->get_appointment_details($key);
                        $date = $rec[0]['start_date'];
                        $time = $rec[0]['start_time'];
                        $dealer = $rec[0]['demo_dealer'];
                        $ride = $rec[0]['ride_along'];
                        $add_url = $rec[0]['add_url'];
                        $addr = $rec[0]['appointment_address'];
                        $notes = $rec[0]['appointment_notes'];
                        $add_url = str_replace(' ', '', $add_url);
                        $adr = str_replace(' ', '', $add_url);
                        $event = array(
                            'summary'     => 'Appointment with ' . ucfirst($dealer) . ' and ' . ucfirst($ride),
                            'start'       => $date . 'T' . $time . ':00',
                            'end'         => $date . 'T' . $time . ':00',
                            'description' => $notes,
                            'location' => $addr,
                            'colorId' => 2
                        );

                        $data = $this->actionEvent('primary', $event, $users_list);
                        $event_id1 = $data['id'];
                        $email = $this->session->userdata('email');
                        $result1 = $this->user_model->sync_update_appointment1($key, $email, $event_id1, $list_of_attendees);
                    }
                    $this->session->set_flashdata('app', 'data saved');
                    redirect('manage_appointment');
                } else {
                    $lead = $this->input->post('lead');
                    $date = $this->input->post('ap_date');
                    $start_time = $this->input->post('ap_stime');
                    $end_time = $this->input->post('ap_stime');
                   // $gift = $this->input->post('gift');//change by sagar
                    $demo_dealer = $this->input->post('demo_dealer');
                    $ride = $this->input->post('ride');
                  // $setby = $this->input->post('setby');
                    $addr = $this->input->post('ap_addr');
                    $notes = $this->input->post('ap_notes');
                    $add_url = $this->input->post('add_url');
                    $status = $this->input->post('status');
                    $demo_notes = $this->input->post('demo_notes');
                   // $assistant = $this->input->post('assistant');
                   // $supervisor = $this->input->post('supervisor');
                    // $add_url=str_replace(' ', '', $add_url);
                    $adr = str_replace(' ', '', $add_url);
                    $summary = 'Appointment';
                    $email = $this->session->userdata('email');
                    $user_id = $this->user_model->user_id($email);
                    $ride = implode(",", $ride);
                    $event = array(
                        'summary'     => 'Appointment with ' . ucfirst($demo_dealer) . ' and ' . ucfirst($ride),
                        'start'       => $date . 'T' . $start_time . ':00',
                        'end'         => $date . 'T' . $end_time . ':00',
                        'description' => $notes,
                        'location' => $addr,
                        'colorId' => 2,
                    );
                    $data = $this->actionEvent($calendar_id, $event);


                    $reg = array(
                        'user_id'       => $user_id,
                        'calendar_id' => $calendar_id,
                        'lead_id' => $lead,
                        'start_date'     => $date,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        //'gift'      => $gift,
                        'demo_dealer' => $demo_dealer,
                        'ride_along' => $ride,
                        'set_by'        => '',
                        'appointment_address'       => $addr,
                        'appointment_notes' => $notes,
                       // 'event_id' => $data['id'],//change by sagar
                        'event_id' => $data['id'],
                        'synchronize' => 'google',
                        'add_url' => $add_url,
                        'appointment_status' => $status,
                        'demo_notes' => $demo_notes,
                        'assistant' => '',
                        'supervisor' => '',
                        'sequence' => 0
                    );
                    $result = $this->user_model->app_info_insert($reg);

                    $this->session->set_flashdata('app1', 'data saved');
                    redirect('appointment');
                }
            }
        }
        if ($this->input->post('app_update')) {
            $pre_cal_id = $this->input->post('c_id');
            $event_id = $this->input->post('event_id');
            $selected_cal_id = $this->input->post('cal_id');
            $date = $this->input->post('app_date');
            $time = $this->input->post('app_time');
            $gift = $this->input->post('gift');
            $demo_dealer = $this->input->post('demo_dealer');
            $ride = $this->input->post('ride');
            $ride = implode(",", $ride);
          $setby = $this->input->post('set');
            $addr = $this->input->post('app_addr');
            $notes = $this->input->post('note');
            $app_id = $this->input->post('app_id');
            $c = $this->input->post('cal_id');
            $lead = $this->input->post('lead');
            $assistant = $this->input->post('assistant');
            $supervisor = $this->input->post('supervisor');
            $status = $this->input->post('status');
            $demo_note = $this->input->post('demo_note');
            $attendees = $this->input->post('attendees');
            $tk = $this->session->userdata('google_calendar_access_token');
            if ($tk) {
                if ($pre_cal_id == $selected_cal_id) {
                    if (($pre_cal_id != '--') && ($selected_cal_id != '--')) {
                        $access_token = json_decode($tk, true);
                        $a_token = $access_token['access_token'];

                        $event = array(
                            'summary'     => 'Appointment with ' . ucfirst($demo_dealer) . ' and ' . ucfirst($ride),
                            'description' => $notes,
                            'start'       => array(
                                'dateTime' => $date . 'T' . $time . ':00',
                                'timeZone' => 'Asia/Kolkata',
                            ),
                            'end'         => array(
                                'dateTime' => $date . 'T' . $time . ':00',
                                'timeZone' => 'Asia/Kolkata',
                            ),
                            'location' => $addr,
                            'colorId' => 2,

                        );
                        //   $this->calendarapi->events->update($selected_cal_id, $event_id,$event);
                        $this->UpdateCalendarEvent($event_id, $selected_cal_id, $event, $a_token);
                    }
                    $this->user_model->update_appointment($app_id, $selected_cal_id, $event_id, $date, $time, $gift, $demo_dealer, $ride, $setby, $addr, $notes, $lead, $assistant, $supervisor, $status, $demo_note);
                    $this->session->set_flashdata('app', 'data saved');
                    redirect('manage_appointment');
                } else if (($pre_cal_id != '--') && ($selected_cal_id != '--')) {
                    $access_token = json_decode($tk, true);
                    $a_token = $access_token['access_token'];
                    $this->DeleteCalendarEvent($event_id, $pre_cal_id, $a_token);
                    $event = array(
                        'summary'     => 'Appointment with ' . ucfirst($demo_dealer) . ' and ' . ucfirst($ride),
                        'start'       => $date . 'T' . $time . ':00',
                        'end'         => $date . 'T' . $time . ':00',
                        'description' => $notes,
                        'location' => $addr
                    );
                    $data = $this->actionEvent($selected_cal_id, $event);
                    $event_id1 = $data['id'];
                    $this->user_model->update_appointment($app_id, $selected_cal_id, $event_id, $date, $time, $gift, $demo_dealer, $ride, $setby, $addr, $notes, $lead, $assistant, $supervisor, $status, $demo_note);
                    $this->session->set_flashdata('app', 'data saved');
                    redirect('manage_appointment');
                }
            } else {
                $this->user_model->update_appointment($app_id, $selected_cal_id, $event_id, $date, $time, $gift, $demo_dealer, $ride, $setby, $addr, $notes, $lead, $assistant, $supervisor, $status, $demo_note);
                $this->session->set_flashdata('app', 'data saved');
                redirect('manage_appointment');
            }
        }
    }
    }
    // delete event
    public function DeleteCalendarEvent($event_id, $calendar_id, $access_token)
    {

        $url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events/' . $event_id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_events);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 204)
            throw new Exception('Error : Failed to delete event');
    }

    // actionEvent
    public function actionEvent($calendarId, $data, $attendee = 0)
    {
        //Date Format: 2016-06-18T17:00:00+03:00
        /*print_r($data);
        exit;*/
        if ($attendee) {
            $event = new Google_Service_Calendar_Event(
                array(
                    'summary'     => $data['summary'],
                    'description' => $data['description'],
                    'start'       => array(
                        'dateTime' => $data['start'],
                        'timeZone' => 'Asia/Kolkata',
                    ),
                    'end'         => array(
                        'dateTime' => $data['end'],
                        'timeZone' => 'Asia/Kolkata',
                    ),
                    'location' => $data['location'],
                    'colorId' => $data['colorId'],
                    'attendees'   => $attendee
                )
            );
        } else {
            $event = new Google_Service_Calendar_Event(
                array(
                    'summary'     => $data['summary'],
                    'description' => $data['description'],
                    'start'       => array(
                        'dateTime' => $data['start'],
                        'timeZone' => 'Asia/Kolkata',
                    ),
                    'end'         => array(
                        'dateTime' => $data['end'],
                        'timeZone' => 'Asia/Kolkata',
                    ),
                    'location' => $data['location'],
                    'colorId' => $data['colorId']
                    /* 'attendees'   => array(
                    array('email' => 'hinduharika@gmail.com'),
                    array('email' => 'hindutestmail123@gmail.com'),
                )*/
                )
            );
        }



        return $this->calendarapi->events->insert($calendarId, $event);
    }
    // get event list
    public function viewEvent($id = 'primary')
    {
        $json = array();
        $eventData = array();
        if (!$this->isLogin()) {

            /* $this->session->sess_destroy(); */
            //redirect('googlecalendar/login');
            $google_event_date = $this->input->post('google_event_date');
            $start = date($google_event_date) . ' 00:00:00';
            $end = date($google_event_date) . ' 23:59:59';
            $email = $this->session->userdata('email');
            $user_id = $this->user_model->user_id($email);
            $user_type = $this->session->userdata('user_type');
            if ($user_type == "Admin") {
                $local = $this->user_model->get_admin_app_local_details($google_event_date);
                $user_appointments = $this->user_model->get_user_app_details($user_id, $google_event_date);
                if ($local) {
                    $local = array_merge($local, $user_appointments);
                } else {
                    $local = $user_appointments;
                }
            } else {
                $local = $this->user_model->get_app_local_details($user_id, $google_event_date);
            }
            //local events

            $json['eventData'] = $local;
            $this->output->set_header('Content-Type: application/json');

            $this->load->view('google-calendar/popup/render', $json);
        } else {
            $google_event_date = $this->input->post('google_event_date');
            $start = date($google_event_date) . '00:00';
            $end = date($google_event_date) . '23:59';


            /*           echo "<pre>";
            print_r($eventData);die;  */
            $email = $this->session->userdata('email');

            $user_id = $this->user_model->user_id($email);
            /* print_r($user_id);
            exit;*/
            $user_type = $this->session->userdata('user_type');
            if ($user_type == "Admin") {
                $localdata = $this->user_model->get_admin_app_local_details($google_event_date);
                $user_appointments = $this->user_model->get_user_app_details($user_id, $google_event_date);
                if ($localdata) {
                    $localdata = array_merge($localdata, $user_appointments);
                } else {
                    $localdata = $user_appointments;
                }
                // print_r($localdata);
            } else {
                //local
                $localdata = $this->user_model->get_app_local_details($user_id, $google_event_date);
                // local database calendar data           
            }
            $localsynccalendardata = $this->user_model->get_app_details($user_id, $google_event_date, $id);
            $googlesyncdata = $this->getEvents($id, $start, $end, null);
            /*print_r($googlesyncdata);
        exit;*/
            $google_sync_var = array();
            $google_sync_var1 = array();
            foreach ($googlesyncdata as $key2 => $value2) {
                foreach ($localsynccalendardata as $key1 => $value1) {
                    if ($value2['id'] == $value1['event_id']) {
                        $google_sync_var = $value1;
                        array_push($localdata, $value1);
                        //  print_r($localdata);                    
                    } else {
                        array_push($localdata, $value2);
                        //print_r($localdata);                  
                    }

                    # code...
                }
                if (empty($localsynccalendardata)) {
                    array_push($localdata, $value2);
                    // print_r($localdata);
                }
            }

            $json['eventData'] = $localdata;
            $this->output->set_header('Content-Type: application/json');

            $this->load->view('google-calendar/popup/render', $json);
        }
    }
    // render Event Form
    public function renderEventForm()
    {
        $json = array();
        if (!$this->isLogin()) {

            $datetime = $this->input->post('datetime');
            $json['datetime'] = $datetime;
            $this->output->set_header('Content-Type: application/json');
            $this->load->view('google-calendar/popup/renderadd', $json);
        } else {
            $datetime = $this->input->post('datetime');
            $json['datetime'] = $datetime;
            $this->output->set_header('Content-Type: application/json');
            $this->load->view('google-calendar/popup/renderadd', $json);
        }
    }
    //logout method
    public function logout()
    {

        $this->googleapi->revokeToken();
        $this->session->unset_userdata('is_authenticate_user');
        $this->session->unset_userdata('google_calendar_access_token');

        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('logout1');
    }

    // get accesstoken using refresh token 
    function getAccessToken()
    {
        $user = $this->session->userdata('email');
        $refresh_token = $this->user_model->get_refresh_token($user);
        $tokenURL = 'https://accounts.google.com/o/oauth2/token';
        $postData = array(
            'client_secret' => 'pzHYcE2idsDsK1SXwvGA-oZN',
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
            'client_id' => '836366606167-uj1a53mip4s6ckvtp95p437n7b3uu8ha.apps.googleusercontent.com'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenURL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //need this otherwise you get an ssl error
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tokenReturn = curl_exec($ch);
        $token = json_decode($tokenReturn);
        //var_dump($tokenReturn);
        $accessToken = $token->access_token;

        return ($accessToken);
    }
    function getAccessTokenEmail($email)
    {
        $this->config->load('calendar');
        $client_id = $this->config->item('client_id');
        $client_secret = $this->config->item('client_secret');
        $refresh_token = $this->user_model->get_refresh_token($email);
        if (isset($refresh_token) && !empty($refresh_token)) {
            print_r($refresh_token[0]['refresh_token']);
            $refresh_token = $refresh_token[0]['refresh_token'];
            $tokenURL = 'https://accounts.google.com/o/oauth2/token';
            $postData = array(
                'client_secret' => $client_secret,
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => $client_id
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $tokenURL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //need this otherwise you get an ssl error
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $tokenReturn = curl_exec($ch);
            $token = json_decode($tokenReturn);
            // var_dump($tokenReturn);

            $accessToken = isset($token->access_token) ? $token->access_token : "";

            return ($accessToken);
        } else {
            return "";
        }
    }
    //subscribe the users for notification
    public function subscribe()
    {
        // $email_list = $this->user_model->getUserEmail();

        // echo json_encode($email_list);
        // foreach ($email_list as $email) {
        //     $access_token = $this->getAccessTokenEmail($email['email']);
        //     if ($access_token != "") {
        //         $this->pushnotify($email['email'], $access_token);
        //     }
        // }
    }
    //on log in check from the db - subscription status 
    public function subscribeUser()
    {
        $currenttime = time();
        $enddate = strtotime("+7 days", time());
        $user = $this->session->userdata('email');
        $subscription_details = $this->user_model->getSubscriptionDetals($user);
        $channel_id = explode("@", $user);
        $channel_id = $currenttime;
        $details  = array(
            "user_id" => $user,
            "valid_from" => $currenttime,
            "valid_till" => $enddate,
            "channel_name" => $channel_id
        );
        print_r($details);
        echo "<br/>";
        if (empty($subscription_details)) {
            $access_token = $this->getAccessTokenEmail($user);
            if ($access_token != "") {
                if ($this->pushnotify($user, $access_token, $channel_id) == 200) {
                    $this->user_model->addSubscriptionDetails($details);
                }
            }
        } else {
            foreach ($subscription_details as $userwise) {
                print_r($userwise);
                if ($userwise['valid_till'] < $currenttime) {
                    $access_token = $this->getAccessTokenEmail($user);
                    if ($access_token != "") {
                        if ($this->pushnotify($user, $access_token, $channel_id) == 200) {
                            $this->user_model->addSubscriptionDetails($details);
                        }
                    }
                }
            }
        }
    }
    public function pushnotify($calendar_id, $access_token, $channel_id)
    {
        $url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events/watch';
        $duration = strtotime("+7 days", time());

        $curlPost = array(
            "id" => $channel_id,
            "type" => "web_hook",
            "address" => "https://bca82c78.ngrok.io/UAT/googlecalendar/handleNotification",
            // "expiration" => $duration,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_events);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token, 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return  $http_code;
        // if ($http_code != 200)
        //     throw new Exception('Error : Failed to create event');
        // else
        //     ret;
    }
    public function handleNotification()
    {
        $myfile = fopen("notify.txt", "a+");
        //json_encode(getallheaders());
        $data = getallheaders();
        $email = explode("/", $data['X-Goog-Resource-URI']);
        $email = $email[6];
        $txt = "notified from gcalander at " . date('Y-m-d H:i:s') . "\n" . json_encode(getallheaders()) . " \nchannel_id " . $data['X-Goog-Channel-ID'] . "\n" . $data['X-Goog-Resource-URI'] . "\n" . $email . "\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        $this->sync($email);
    }
    public function test(){
        $this->sync("arzoo.rkcet@gmail.com");
    }
    // calendar full sync
    public function sync($userid)
    {
        $access_token = $this->getAccessTokenEmail($userid);
        if ($access_token != "") {
            //get the nextsynctoken
            $row = $this->user_model->getNextSyncToken($userid);
            if (!empty($row))
                $nextSyncToken = $row['next_token'];
            else
                $nextSyncToken = null;

            $pagetoken = null;
            $pcount = 1;
            do {
                $url_events = 'https://www.googleapis.com/calendar/v3/calendars/primary/events?maxResults=10&singleEvents=true';
                if ($nextSyncToken != null)
                    $url_events = $url_events . '&syncToken=' . $nextSyncToken;
                if ($pagetoken != null)
                    $url_events = $url_events . '&pageToken=' . $pagetoken;


                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url_events);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($ch, CURLOPT_POST, 1);		
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token, 'Content-Type: application/json'));
                // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));	
                $data = json_decode(curl_exec($ch), true);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                
                $myfile = fopen("sync_data.txt", "a+");


                $txt = "sync from gcalander at " . date('Y-m-d H:i:s') . "\n" . ($pcount++) . "\n";
                if(isset($data['items'])) {
                    $items = $data['items'];
                    foreach ($items as $item) {
                        $attendee = "";
                        if(isset($item['attendees'])) {
                            $attendees = $item['attendees'];
                            foreach ($attendees as $att) {
                                $attendee = $attendee .",".$att["email"];
                            }
                        }
                        $start_dt = $item["start"]["dateTime"];
                        $start_dt = explode("T",$start_dt);
                        $start_date=$start_dt[0];
                        $start_time = substr($start_dt[1],0,5);
                        $end_dt =  $item["end"]["dateTime"];
                        $end_dt = explode("T",$end_dt);
                        $end_date=$end_dt[0];
                        $end_time = substr($end_dt[1],0,5);;
                        $event = array(
                            "user_id"=>0,
                            "lead_id"=>"",
                            "calendar_id"=>$userid,
                            "event_id"=>$item['id'],
                            "start_date"=>$start_date,
                            "start_time"=>$start_time,
                            // "end_date"=>$end_date,
                            "end_time"=>$end_time,
                            "gift"=>"",
                            "demo_dealer"=>"",
                            "ride_along"=>"",
                            "set_by"=>"",
                            "appointment_address"=>isset($item['location'])?$item['location']:"",
                            "appointment_notes"=>isset($item['summary'])?$item['summary']:"",
                            "status"=>1,
                            "synchronize"=>"google",
                            "add_url"=>$item['htmlLink'],
                            "appointment_status"=>$item['status'],
                            "demo_notes"=>isset($item['description'])?$item['description']:"",
                            "attendees"=>$attendee,
                            "assistant"=>"",
                            "supervisor"=>"",
                            "sequence"=>$item['sequence'],

                    );
                    if(strtotime($start_date." ".$start_time)>= time())
                        $this->user_model->app_info_insert($event);
                    }
                }
                




                fwrite($myfile, $txt);
                fclose($myfile);
                $pagetoken = isset($data['nextPageToken']) ? $data['nextPageToken'] : null;
                $nextSyncToken = isset($data['nextSyncToken']) ? $data['nextSyncToken'] : null;
                if ($http_code != 200)
                    throw new Exception('Error : Failed to create event');
            } while ($pagetoken != null);
            
            $details = array(
                'next_token'=>$nextSyncToken,
                'user_id'=>$userid,
        );
        $this->user_model->addNextSyncToken($details);
        }
    }

    public function outlook_login()
    {
    
       $authenticator = new Outlook\Authorizer\Authenticator(CLIEND_ID, CLIEND_SECRET);

        $token = $authenticator->getToken();
       
        if (!$token) {
           // echo $authenticator->getLoginUrl();
           // $scope=array("https://outlook.office.com/Calendars.ReadWrite");
        //    $Scopes=([
        //     'Calendars.Read',
        //     'Calendars.Read.Shared',
        //     'Calendars.ReadWrite',
        //     'User.Read',
        //     'offline_access',
        // ]);
        
           $url =  $authenticator->getLoginUrl($scopes = [], $redirectUri = null);;
         
            //echo $url;
           
           
            header('Location: '.$url);
        } else {
          //  var_dump($token);
            $sessionManager = new Outlook\Authorizer\Session();

//$sessionManager->remove(); // if ne

    
 
$eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);
$token = $eventAuthorizer->isAuthenticated();

        
           $eventManager = new Outlook\Calendars\CalendarManager($token);
           

           
            //             // get all Calendars returns each item as Event object
                      //$calendars = $eventManager->all();
                    
                 $allCalendars = $eventManager->getAllCalendars();
            
                
            
               // print_r($allCalendars);
                //  $event = new Outlook\Calendars\Calendar(['subject' => 'Create By Sagar Morvadiya']);
                //          $event->body = ['ContentType' => 'HTML', 'Content' => 'Hello this is test Event'];
                //          $event->start = ["DateTime" => "2020-05-18T7:00:00", "TimeZone" => "India Standard Time"];
                //          $event->end = ["DateTime" => "2020-05-18T8:00:00", "TimeZone" => "India Standard Time"];
                     
                        
                //          $event = $eventManager->create($event);
                       //  print_r($event);
        }
    }
    public function calender_event(){
        
       
       

        define('APP_ID','a1252244-099c-4899-b5a7-1a663b23b164');
        define('APP_PASSWORD','_SFr7/H?G]hgWatk1gZ6eJCSReqk4?0g');

$authenticator = new Outlook\Authorizer\Authenticator(
    APP_ID,
    APP_PASSWORD,
   // $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
    $redirectUri = "https://localhost/lead_management/googlecalendar/calender_event"
    //$redirectUri = "https://acmesoftware.net/lead_management/googlecalendar/calender_event"
);

$sessionManager = new Outlook\Authorizer\Session();

//$sessionManager->remove(); // if ne

    
 
$eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);


$token= $eventAuthorizer->isAuthenticated();
 //  $eventAuthorizer->renewToken();


 if (!$token) {
    echo '<a href=' . $eventAuthorizer->getLoginUrl($redirectUri,$authenticator) . '>Login</a>'; 
} else {   
   
           $eventManager = new Outlook\Calendars\CalendarManager($token);


    $allCalendars = $eventManager->getAllCalendars();
//print_r($allCalendars);
           
//              get all Calendars returns each item as Event object
         // $calendars = $eventManager->all();
         $calendars=array();
         foreach($allCalendars as $getdata){
            
            if(($getdata->name =="Birthdays") || ($getdata->name =="India holidays") || ($getdata->name =="United holidays") ){
               
            }else{
                
          $calendardata = $eventManager->all($getdata->id);
        // print_r($calendardata);
          foreach($calendardata as $caldata){
            //   $id=  $caldata->id;
            //   $subject=  $caldata->subject;
               $fromdate=  $caldata->start->DateTime;;
               $todate=  $caldata->end->DateTime;

            $timestamp = strtotime($fromdate);
            $fromdate = date("Y-m-d", $timestamp);

            $timestamp = strtotime($todate);
            $todate = strtotime("+1 day",$timestamp);
            $todate = date("Y-m-d", $todate);
            $color="#2a9df4";

              $calendars[]=array(
                  'id'=> $caldata->id,
                  'title'=>$caldata->subject,
                  'start'=>$fromdate,
                  'end'=>$todate,
                  'color'=>$color,

                //  'content'=>$caldata->body->Content,
              );
          }
        }
            }
            json_encode($calendars);
       // $calendars = $eventManager->all();
      //  print_r($calendars);

          $email=$this->session->userdata('email');
          if($email){
          if($this->input->post('submit'))
          {
          $email=$this->session->userdata('email');     
          $l_type=$this->input->post('lead_type');
          $l_source=$this->input->post('source');
          $l_dealer=$this->input->post('l_dealer');
          $sublead=$this->input->post('sublead');
          $user_id=$this->user_model->user_id($email);
          $rec=$this->user_model->add_new_lead($user_id,$l_type,$l_source,$l_dealer,$sublead);
          $this->session->set_flashdata('msglp', 'data saved');
          }
          $email=$this->session->userdata('email');     
          $u_type=$this->user_model->get_usertype($email);
          $u=$u_type[0]['user_type'];
          $get=$this->user_model->get_permissions($u);
          $user_id=$this->user_model->user_id($email);
          $data['user_permission']=unserialize($get[0]['permissions']);
          $user_id=$this->user_model->user_id($email);
          // $data['lead_source']=$this->user_model->get_lead_users();
          //$data['records']=$this->user_model->get_appointment_data($user_id);
          $data['flag']=0;
          $data['calendardata']=$calendars;
          $data['allCalendars']=$allCalendars;
          $data['layout']="public/layout";
          $data['header']="public/header";
          $data['footer']="public/footer";
          // $data['body']="static/user/new_lead_type";
          $data['body']="static/user/addoutlookdemo";
          $this->load->view('welcome_message',$data);
        }
         // print_r($calendars);
         
        //  echo "<table border='1'><thead><tr>
        //     <td>Event ID</td>
        //     <td>Event Name</td>
        //     <td>Event Start Time</td>
        //     <td>Event End Time</td>
           
        //  </tr></thead><tbody>";
        //     foreach ($calendars as $event) {
        //           //  echo $event->id . " -> " . $event->subject;
        //            echo    "<tr>";
        //            echo  "<td> $event->id</td>
        //            <td>$event->subject</td>";
        //            echo  "<td>";
        //            print_r($event->start);
        //           echo "</td>";
        //           echo "<td>";
        //            print_r($event->end);
        //            echo "</td>";
        //             echo "</tr>";
              
                  
        //         } 
        //         echo "</tbody><table>";
         // print_r($calendars);
    //  $allCalendars = $eventManager->getAllCalendars();
        
    // print_r($allCalendars);

    //print_r($allCalendars);
        //   $event = new Outlook\Calendars\Calendar(['subject' => 'Brith day of file']);
        //      $event->body = ['ContentType' => 'HTML', 'Content' => 'Brith day party'];
        //      $event->start = ["DateTime" => "2020-05-30T19:00:00", "TimeZone" => "India Standard Time"];
        //      $event->end = ["DateTime" => "2020-05-30T20:00:00", "TimeZone" => "India Standard Time"];
         
            
        //      $event = $eventManager->create($event);
        //      print_r($event);
    //         echo '<a href="?refresh_token=true">Renew Token</a>';
}
    }
//     public function add_event1(){
//         require APPPATH."/third_party/src/Outlook/Authorizer/Session.php";

       
//         $authenticator = new Outlook\Authorizer\Authenticator(
//             CLIEND_ID, CLIEND_SECRET,
//             $redirectUri = "http://localhost/lead_management/googlecalendar/add_event"
//         );

        
        
//          $sessionManager = new \Outlook\Authorizer\Session();
     

//     //     print_r($sessionManager);
//     //     //$sessionManager->remove(); // if need to remove token manually from session
        
//       $eventAuthorizer = new \Outlook\Events\EventAuthorizer($authenticator, $sessionManager);
        
//         $token = $eventAuthorizer->isAuthenticated();
//         if (!$token) {
//             echo '<a href='.$authenticator->getLoginUrl().'>Login</a>';
//         } else {
//             if (isset($_GET['refresh_token']) && $_GET['refresh_token']) {
//                 $newToken = $eventAuthorizer->renewToken();
//                 echo 'Refresh Token: <br />';
//                 var_dump($newToken);
//                 die();
//             }


       
//         $eventManager = new \Outlook\Events\EventManager($token);

      
        
    
       
    
//         //create event
//         // nested key name must be case sensitive correctly according to their docs.
//         // only outer properties will be converted to Study case automatically
//         $event = new \Outlook\Events\Event(['subject' => 'Discuss the Calendar REST API']);
//         $event->body = ['ContentType' => 'HTML', 'Content' => 'Hello this is test Event'];
//         $event->start = ["DateTime" => "2020-05-15T18:00:00", "TimeZone" => "Pacific Standard Time"];
//         $event->end = ["DateTime" => "2020-06-16T19:00:00", "TimeZone" => "Pacific Standard Time"];
//         $event = $eventManager->create($event);
//     }
// }

public function calender_create(){
        
       
       

   

$authenticator = new Outlook\Authorizer\Authenticator(
CLIEND_ID,
CLIEND_SECRET,
// $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
$redirectUri = "https://localhost/lead_management/googlecalendar/calender_event"
//$redirectUri="https://acmesoftware.net/lead_management/googlecalendar/calender_event"
);

$sessionManager = new Outlook\Authorizer\Session();

//$sessionManager->remove(); // if ne



$eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);


$token= $eventAuthorizer->isAuthenticated();
//  $eventAuthorizer->renewToken();


if (!$token) {
echo '<a href=' . $eventAuthorizer->getLoginUrl($redirectUri,$authenticator) . '>Login</a>'; 
} else {   
    $ap_date	= $this->input->post('ap_date');
    $subject	= $this->input->post('subject');
    $content	= $this->input->post('content');
    $ap_stime	= $this->input->post('ap_stime');
    $ed_date	= $this->input->post('ed_date');
    $ed_stime	= $this->input->post('ed_stime');
    $calenderid	= $this->input->post('calenderid');

   // echo  $calenderid;

       $eventManager = new Outlook\Calendars\CalendarManager($token);
      
              $event = new Outlook\Calendars\Calendar(['subject' => $subject]);
              
             $event->body = ['ContentType' => 'HTML', 'Content' => $content];
             $event->start = ["DateTime" => $ap_date.'T'.$ap_stime.":00", "TimeZone" => "India Standard Time"];
             $event->end = ["DateTime" => $ed_date.'T'.$ed_stime.":00", "TimeZone" => "India Standard Time"];
         
            
             $event = $eventManager->create($event,$calenderid);

           // print_r($event);
          if($event->id !=""){
            $res = array(
                'calendar_id'=>$calenderid,
                'event_id' => $event->id,
                'appointment_notes' =>  $subject,
                'appointment_address' =>  $content,
                'start_date' =>  $ap_date,
                'start_time' =>$ap_stime,
                'end_date' => $ed_date,
                'end_time' => $ed_stime,
                'synchronize'=>'outlook',
              
           
            );
            $this->db->insert('appointment_information',$res);
        }
            
            $allCalendars = $eventManager->getAllCalendars();
           // print_r($allCalendars);
           $calendars=array();
           foreach($allCalendars as $getdata){
            if(($getdata->name =="Birthdays") || ($getdata->name =="India holidays") || ($getdata->name =="United holidays") ){
               
            }else{
            $calendardata = $eventManager->all($getdata->id);
            foreach($calendardata as $caldata){
              

              
                    //   $calendars[]=array(
                    //       'id'=> $caldata->id,
                    //       'subject'=>$caldata->subject,
                    //       'starttime'=>$caldata->start->DateTime,
                    //       'endtime'=>$caldata->end->DateTime,
                    //       'content'=>$caldata->body->Content,
                    //     );

                    $fromdate=  $caldata->start->DateTime;;
                    $todate=  $caldata->end->DateTime;
     
                 $timestamp = strtotime($fromdate);
                 $fromdate = date("Y-m-d", $timestamp);
     
                 $timestamp = strtotime($todate);
                 $todate = strtotime("+1 day",$timestamp);
                 $todate = date("Y-m-d", $todate);
                 $color="#2a9df4";
     
                   $calendars[]=array(
                       'id'=> $caldata->id,
                       'title'=>$caldata->subject,
                       'start'=>$fromdate,
                       'end'=>$todate,
                       'color'=>$color,
     
                     //  'content'=>$caldata->body->Content,
                   );
                  
            }
        }
           }
          // print_r($calendardata);

         // $calendars = $eventManager->all();
        //  print_r($calendars);
        json_encode($calendars);

         
          $email=$this->session->userdata('email');
          if($email){
          if($this->input->post('submit'))
          {
          $email=$this->session->userdata('email');     
          $l_type=$this->input->post('lead_type');
          $l_source=$this->input->post('source');
          $l_dealer=$this->input->post('l_dealer');
          $sublead=$this->input->post('sublead');
          $user_id=$this->user_model->user_id($email);
          $rec=$this->user_model->add_new_lead($user_id,$l_type,$l_source,$l_dealer,$sublead);
          $this->session->set_flashdata('msglp', 'data saved');
          }
          $email=$this->session->userdata('email');     
          $u_type=$this->user_model->get_usertype($email);
          $u=$u_type[0]['user_type'];
          $get=$this->user_model->get_permissions($u);
          $user_id=$this->user_model->user_id($email);
          $data['user_permission']=unserialize($get[0]['permissions']);
          $user_id=$this->user_model->user_id($email);
          $data['flag']=0;
          // $data['lead_source']=$this->user_model->get_lead_users();
          //$data['records']=$this->user_model->get_appointment_data($user_id);
          $data['allCalendars']=$allCalendars;
          $data['calendardata']=$calendars;
          $data['layout']="public/layout";
          $data['header']="public/header";
          $data['footer']="public/footer";
          // $data['body']="static/user/new_lead_type";
          $data['body']="static/user/addoutlookdemo";
          $this->load->view('welcome_message',$data);
        }

}
}
public function check_session_outllok(){
    $logindata=0;
    $authenticator = new Outlook\Authorizer\Authenticator(
    CLIEND_ID,
    CLIEND_SECRET,
    // $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
    $redirectUri = "https://localhost/lead_management/googlecalendar/calender_event"
 // $redirectUri="https://acmesoftware.net/lead_management/googlecalendar/calender_event"

    );
    
    $sessionManager = new Outlook\Authorizer\Session();
    
    //$sessionManager->remove(); // if ne
    
    
    
    $eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);
    
    
    $token= $eventAuthorizer->isAuthenticated();
    //  $eventAuthorizer->renewToken();
    
    
    if (!$token) {
   // echo '<a href=' . $eventAuthorizer->getLoginUrl($redirectUri,$authenticator) . '>Login</a>'; 
   //$logindata= 0;
   $email=$this->session->userdata('email');
   if($email){
   if($this->input->post('submit'))
   {
   $email=$this->session->userdata('email');     
   $l_type=$this->input->post('lead_type');
   $l_source=$this->input->post('source');
   $l_dealer=$this->input->post('l_dealer');
   $sublead=$this->input->post('sublead');
   $user_id=$this->user_model->user_id($email);
   $rec=$this->user_model->add_new_lead($user_id,$l_type,$l_source,$l_dealer,$sublead);
   $this->session->set_flashdata('msglp', 'data saved');
   }
   $email=$this->session->userdata('email');     
   $u_type=$this->user_model->get_usertype($email);
   $u=$u_type[0]['user_type'];
   $get=$this->user_model->get_permissions($u);
   $user_id=$this->user_model->user_id($email);
   $data['user_permission']=unserialize($get[0]['permissions']);
   $user_id=$this->user_model->user_id($email);
   $data['flag']=1;
   $data['calendardata']="";
   
   // $data['lead_source']=$this->user_model->get_lead_users();
   //$data['records']=$this->user_model->get_appointment_data($user_id);
   $data['records1']=$this->lead_management->dealer_display_data($user_id);
   $data['layout']="public/layout";
   $data['header']="public/header";
   $data['footer']="public/footer";
  
   // $data['body']="static/user/new_lead_type";
   $data['body']="static/user/addoutlookdemo";


   
$this->load->view('welcome_message',$data);
}else{
redirect('login');
}
    } else { 

        define('APP_ID','a1252244-099c-4899-b5a7-1a663b23b164');
        define('APP_PASSWORD','_SFr7/H?G]hgWatk1gZ6eJCSReqk4?0g');

$authenticator = new Outlook\Authorizer\Authenticator(
    APP_ID,
    APP_PASSWORD,
   // $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
    $redirectUri = "https://localhost/lead_management/googlecalendar/calender_event"
  // $redirectUri="https://acmesoftware.net/lead_management/googlecalendar/calender_event"

);

$sessionManager = new Outlook\Authorizer\Session();

//$sessionManager->remove(); // if ne

    
 
$eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);


$token= $eventAuthorizer->isAuthenticated();
 //  $eventAuthorizer->renewToken();


 if (!$token) {
    echo '<a href=' . $eventAuthorizer->getLoginUrl($redirectUri,$authenticator) . '>Login</a>'; 
} else {   
   
           $eventManager = new Outlook\Calendars\CalendarManager($token);


    $allCalendars = $eventManager->getAllCalendars();
//print_r($allCalendars);
           
//              get all Calendars returns each item as Event object
         // $calendars = $eventManager->all();
         $calendars=array();
         foreach($allCalendars as $getdata){
            
            if(($getdata->name =="Birthdays") || ($getdata->name =="India holidays") || ($getdata->name =="United holidays") ){
               
            }else{
                
          $calendardata = $eventManager->all($getdata->id);
        // print_r($calendardata);
          foreach($calendardata as $caldata){
            //   $id=  $caldata->id;
            //   $subject=  $caldata->subject;
               $fromdate=  $caldata->start->DateTime;;
               $todate=  $caldata->end->DateTime;

            $timestamp = strtotime($fromdate);
            $fromdate = date("Y-m-d", $timestamp);

            $timestamp = strtotime($todate);
            $todate = strtotime("+1 day",$timestamp);
            $todate = date("Y-m-d", $todate);
            $color="#2a9df4";

              $calendars[]=array(
                  'id'=> $caldata->id,
                  'title'=>$caldata->subject,
                  'start'=>$fromdate,
                  'end'=>$todate,
                  'color'=>$color,

                //  'content'=>$caldata->body->Content,
              );
          }
        }
            }
            json_encode($calendars);
       // $calendars = $eventManager->all();
      //  print_r($calendars);

          $email=$this->session->userdata('email');
          if($email){
          if($this->input->post('submit'))
          {
          $email=$this->session->userdata('email');     
          $l_type=$this->input->post('lead_type');
          $l_source=$this->input->post('source');
          $l_dealer=$this->input->post('l_dealer');
          $sublead=$this->input->post('sublead');
          $user_id=$this->user_model->user_id($email);
          $rec=$this->user_model->add_new_lead($user_id,$l_type,$l_source,$l_dealer,$sublead);
          $this->session->set_flashdata('msglp', 'data saved');
          }
          $email=$this->session->userdata('email');     
          $u_type=$this->user_model->get_usertype($email);
          $u=$u_type[0]['user_type'];
          $get=$this->user_model->get_permissions($u);
          $user_id=$this->user_model->user_id($email);
          $data['user_permission']=unserialize($get[0]['permissions']);
          $user_id=$this->user_model->user_id($email);
          // $data['lead_source']=$this->user_model->get_lead_users();
          //$data['records']=$this->user_model->get_appointment_data($user_id);
          $data['flag']=0;
          $data['calendardata']=$calendars;
          $data['allCalendars']=$allCalendars;
          $data['layout']="public/layout";
          $data['header']="public/header";
          $data['footer']="public/footer";
          // $data['body']="static/user/new_lead_type";
          $data['body']="static/user/addoutlookdemo";
          $this->load->view('welcome_message',$data);
        }

 
    }
	
}

}
public function check_get_eventinfo(){
    $eventid=$this->input->post('eventid');

    $logindata=0;
    $authenticator = new Outlook\Authorizer\Authenticator(
    CLIEND_ID,
    CLIEND_SECRET,
    // $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
    $redirectUri = "https://localhost/lead_management/googlecalendar/calender_event"
   //$redirectUri="https://acmesoftware.net/lead_management/googlecalendar/calender_event"

    );
    
    $sessionManager = new Outlook\Authorizer\Session();
    
    //$sessionManager->remove(); // if ne
    
       
    $eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);
    
    
    $token= $eventAuthorizer->isAuthenticated();
    //  $eventAuthorizer->renewToken();
    
    
    if (!$token) {
       
    }else{
        $eventManager = new Outlook\Calendars\CalendarManager($token);
        $event = $eventManager->get($eventid);
     // print_r($event);
        $fromdate=  $event->start->DateTime;;
               $todate=  $event->end->DateTime;

   
       $calendars1[]=array(
                  'id'=> $event->id,
                  'title'=>$event->subject,
                  'start'=>$fromdate,
                  'end'=>$todate,
                   'content'=>$event->bodypreview,

                //  'content'=>$caldata->body->Content,
              );
              echo json_encode($calendars1);
 
    //       $subject=  $caldata->Subject;

        //  echo $subject;

        //        $fromdate=  $caldata->start->DateTime;;
        //        $todate=  $caldata->end->DateTime;

        //     $timestamp = strtotime($fromdate);
        //     $fromdate = date("Y-m-d", $timestamp);

        //     $timestamp = strtotime($todate);
        //     $todate = strtotime("+1 day",$timestamp);
        //     $todate = date("Y-m-d", $todate);
        //     $color="#2a9df4";

        //       $calendars[]=array(
        //           'id'=> $caldata->id,
        //           'title'=>$caldata->subject,
        //           'start'=>$fromdate,
        //           'end'=>$todate,
        //            'content'=>$caldata->body->Content,

        //         //  'content'=>$caldata->body->Content,
        //       );
        //       echo json_encode($calendars);
        //   }
    // }
       
    }

}
public function getoutcalender(){
          $authenticator = new Outlook\Authorizer\Authenticator(
        CLIEND_ID,
        CLIEND_SECRET,
        // $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
        $redirectUri = "https://localhost/lead_management/appointment"
       // $redirectUri="https://acmesoftware.net/lead_management/appointment"

        );
       
        $sessionManager = new Outlook\Authorizer\Session();
        
        //$sessionManager->remove(); // if ne
        
        
        
        $eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);
        
        
        $token= $eventAuthorizer->isAuthenticated();

    
        if (!$token) {
           $this->outlook_login1();
        }else{
            $eventManager = new Outlook\Calendars\CalendarManager($token);
            $allCalendars = $eventManager->getAllCalendars();
            $calendardata=array();

            foreach ($allCalendars as $cladata) {
                $calid=$cladata->id;
                $name=$cladata->name;
                $calendardata[]=array(
                    'id'=>$calid,
                    'name'=>$name,
                );
                
            }
            echo json_encode($calendardata);
           // $this->session->userdata('allcaldata',$calendardata);

           // print_r($this->session->userdata('allcaldata'));
        }
}
public function getoutcalenderallcalender(){
    
    $authenticator = new Outlook\Authorizer\Authenticator(
  CLIEND_ID,
   CLIEND_SECRET,
//   // $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
     $redirectUri = "https://localhost/lead_management/appointment"
//   //$redirectUri="https://acmesoftware.net/lead_management/appointment"
  );
 
  $sessionManager = new Outlook\Authorizer\Session();
  
//   //$sessionManager->remove(); // if ne
  
  
  
   $eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);
  
  
   $token= $eventAuthorizer->isAuthenticated();
  

//   $calendardata=array();
   if (!$token) {
      //$this->outlook_login1();
      $eventAuthorizer->getLoginUrl($redirectUri,$authenticator);
  }else{
     
      $eventManager = new Outlook\Calendars\CalendarManager($token);
      $allCalendars = $eventManager->getAllCalendars();
   

      foreach ($allCalendars as $cladata) {
          $calid=$cladata->id;
          $name=$cladata->name;
          $calendardata[]=array(
              'id'=>$calid,
              'name'=>$name,
          );
          
      }
     
     // $this->session->userdata('allcaldata',$calendardata);

     // print_r($this->session->userdata('allcaldata'));
    
  }
  echo json_encode($calendardata);

}
public function outlook_login1()
{

   $authenticator = new Outlook\Authorizer\Authenticator(CLIEND_ID, CLIEND_SECRET);

    $token = $authenticator->getToken();
      $redirectUri = "https://localhost/lead_management/appointment";
    //$redirectUri="https://acmesoftware.net/lead_management/appointment";

    if (!$token) {
       // echo $authenticator->getLoginUrl();
       // $scope=array("https://outlook.office.com/Calendars.ReadWrite");
    //    $Scopes=([
    //     'Calendars.Read',
    //     'Calendars.Read.Shared',
    //     'Calendars.ReadWrite',
    //     'User.Read',
    //     'offline_access',
    // ]);
    
       $url =  $authenticator->getLoginUrl($scopes = [], $redirectUri);;
     
        //echo $url;
       
       
        header('Location: '.$url);
    } else {

    }
}
public function check_session_eventinfo(){
    $eventid=$this->input->post('eventid');

    $logindata=0;
    $authenticator = new Outlook\Authorizer\Authenticator(
    CLIEND_ID,
    CLIEND_SECRET,
    // $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
    $redirectUri = "https://localhost/lead_management/googlecalendar/calender_event"
  // $redirectUri="https://acmesoftware.net/lead_management/googlecalendar/calender_event"

    );
    
    $sessionManager = new Outlook\Authorizer\Session();
    
    //$sessionManager->remove(); // if ne
    
       
    $eventAuthorizer = new Outlook\Calendars\CalendarAuthorizer($authenticator, $sessionManager);
    
    
    $token= $eventAuthorizer->isAuthenticated();
    //  $eventAuthorizer->renewToken();
    
  
    if (!$token) {
        echo json_encode(0);

    }else{
        echo json_encode(1);
}
}

}
