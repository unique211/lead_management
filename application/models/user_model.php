<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
	function insert_userdata($reg)
	{
		$this->db->insert('lead_info',$reg);
        return true;
	}
	function app_info_insert($reg)
	{
		$row = $this->db->where('event_id',$reg['event_id'])->from("appointment_information")->count_all_results();
		
		
		if($row==0)
		$this->db->insert('appointment_information',$reg);
		else{
			$this->db->where('event_id',$reg['event_id']);
			$this->db->update('appointment_information', $reg);
		}

	
	   return true;
	   
	  
	}
	
	function add_new_lead($user_id,$l_type,$l_source,$l_dealer,$sub_lead)
	{
		
        $s="INSERT into lead_type (user_id,lead_type,lead_source,lead_dealer,sub_lead) values ('$user_id','$l_type','$l_source','$l_dealer','$sub_lead')";
        $this->db->query($s);
	}
	function get_users_list($user_id){
		$query="SELECT * from user_creation where id!='$user_id' and status='1'";

		$fetch=$this->db->query($query);
		
		return $fetch->result_array();

	}
	function get_dealers_data($dealer){
		$query="SELECT * from user_creation where status='1' and user_type!='Admin' and first_name!='$dealer' and user_role='Dealer'";

		$fetch=$this->db->query($query);
		
		return $fetch->result_array();
	}
	function get_lead_data_appointment($lead){
		$query="SELECT * from  lead_info where status='1' and first_name='$lead'";

		$fetch=$this->db->query($query);
		
		return $fetch->result_array();
	}
	function get_relations(){
		$query="SELECT * from relationships where status='1'";

		$fetch=$this->db->query($query);
		
		return $fetch->result_array();
	}
	function insert_relations($relation){
		 $s="INSERT into relationships (relationship) values ('$relation')";
        $this->db->query($s);
	}
	
	function get_permissions($val)
	{
		$query="SELECT permissions from page_access where user_type='$val'";

		$fetch=$this->db->query($query);
		//print_r($fetch->result_array());exit();
		return $fetch->result_array();

	}

	function filter_lead_data($from,$to,$id){
		 $user_type=$this->session->userdata('user_type');
		if($user_type=="Admin")
		{
			$query="SELECT * FROM lead_info where status='1' and lead_date BETWEEN '$from' AND '$to' order by lead_date asc";

		}
		else{
			$query="SELECT * FROM lead_info where status='1' and user_id='$id' and lead_date BETWEEN '$from' AND '$to' order by lead_date asc";
		}
		
		$fetch=$this->db->query($query);
		return $fetch->result_array();
		
	}
	function get_leads_data(){
		$query="SELECT * FROM lead_info where status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_users(){
			$query="SELECT * FROM user_creation where status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_lead_data($id)
	{
		 $user_type=$this->session->userdata('user_type');
		if($user_type=="Admin")
		{
			$query="SELECT * FROM lead_info where status='1'";
		}
		else{
			$query="SELECT * FROM lead_info where status='1' and user_id='$id'";
		}
		
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_admin_appointment_data()
	{
		$query="SELECT * FROM appointment_information where status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
		function filter_appointment_data($from,$to,$id){
		 $user_type=$this->session->userdata('user_type');
		if($user_type=="Admin")
		{
			$query="SELECT * FROM appointment_information where status='1' and start_date BETWEEN '$from' AND '$to' order by start_date asc";

		}
		else{
			$query="SELECT * FROM appointment_information where status='1' and user_id='$id' and start_date BETWEEN '$from' AND '$to' order by start_date asc";
		}
		
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	/*function get_appointment_data1($user_id)
	{
		$query="SELECT * FROM appointment_information where status='1' and user_id='$user_id' and synchronize='google'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}*/
	function get_appointment_data($id)
	{
		$query="SELECT * FROM appointment_information where status='1' and user_id='$id'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_lead_record($id)
	{
		$query="SELECT * FROM lead_info where id='$id'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function set_lead_record($id,$record)
	{
		$this->db->where('id', $id);
        $this->db->update('lead_info', $record);

	}
	function delete_lead($id)
	{
		 $s="UPDATE  lead_info SET status='0' where id=$id";
    $this->db->query($s);
	}
	function check_lead($f_name,$l_name)
	{
		$query="SELECT * FROM lead_info where first_name='$f_name' and last_name='$l_name'";
		$fetch=$this->db->query($query);
		return $fetch->num_rows();
	}
	function getEvents($start)
	{
			$query="SELECT * FROM appointment_information where appointment_date='$start' and status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_cal_id($id)
	{
		$query="SELECT * FROM appointment_information where id=$id and status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function delete_appoint($id)
	{
		 $s="UPDATE  appointment_information SET status='0' where id=$id";
    $this->db->query($s);
	}

	function get_appoinments()
	{
		$query="SELECT * FROM appointment_information where status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_appointment_details($id)
	{
		$query="SELECT * FROM appointment_information where id=$id and status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function update_database_appointments($event_id,$date,$time,$attendees,$description,$sequence){
				$s="UPDATE appointment_information SET 	start_date='$date',start_time='$time',end_time='$time', attendees='$attendees',	appointment_notes='$description',sequence='$sequence' where event_id='$event_id'";
		 $this->db->query($s);
	}
	function sync_update_appointment1($key,$email,$event_id1,$users_list){
		$s="UPDATE appointment_information SET calendar_id='$email',event_id='$event_id1',synchronize='google',attendees='$users_list',sequence=0 where id=$key";
		 $this->db->query($s);
	}
	function sync_update_appointment($key,$cal,$event_id1)
	{
		$s="UPDATE appointment_information SET calendar_id='$cal',event_id='$event_id1',synchronize='google',sequence=0 where id=$key";
		 $this->db->query($s);
		
	}
	function store_refresh_token($user,$ref_token){
		  $s="INSERT into  refresh_token (user_id,refresh_token) values ('$user','$ref_token')";
        $this->db->query($s);
	}
	function get_refresh_token($user){
			$query="SELECT refresh_token FROM refresh_token where user_id='$user' and refresh_token!='' order by id desc LIMIT 1";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_page_details($utype)
	{
		$query="SELECT permissions FROM page_access where user_type='$utype'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_pages()
	{
		$query="SELECT * FROM page_names";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}

	function log($e,$p)
	{
		$q="SELECT * from user_creation where email='$e' and password='$p'";
		$ex=$this->db->query($q);
		return $ex->result_array();
	}
	function get_usertype($email)
	{
		$q="SELECT * from user_creation where email='$email' ";
		$ex=$this->db->query($q);
		return $ex->result_array();
	}
	function get_leads($user_id)
	{
		 $user_type=$this->session->userdata('user_type');
   		if($user_type=="Admin")
   		{
   			$q="SELECT * from lead_info";
   		}else{
   			$q="SELECT * from lead_info where user_id='$user_id'";
   		}
		
		$ex=$this->db->query($q);
		return $ex->result_array();
	}

	function get_leadtype_data($id)
	{
		 $user_type=$this->session->userdata('user_type');
		if($user_type=="Admin")
		{
			$query="SELECT * FROM lead_type where status='1'";
		}else{
			$query="SELECT * FROM lead_type where status='1' and user_id='$id'";
		}
		
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_relationship_record($id){
		$query="SELECT * FROM relationships where id='$id'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function delete_relationship($id)
	{
		$s="UPDATE  relationships SET status='0' where id=$id";
    $this->db->query($s);
	}
	function update_relationship($id,$relation){
		$s="UPDATE  relationships SET relationship='$relation' where id=$id";
    $this->db->query($s);
	}
	function get_leadtype_record($id)
	{
		$query="SELECT * FROM lead_type where id='$id'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function set_leadtype_record($id,$record)
	{
		$this->db->where('id', $id);
        $this->db->update('lead_type', $record);
	}
	function delete_lead_type($id)
	{
		$s="UPDATE  lead_type SET status='0' where id=$id";
    $this->db->query($s);
	}
	function get_lead_type()
	{
		$query="SELECT lead_type FROM lead_type where status='1' GROUP BY lead_type";
		$ex=$this->db->query($query);
		return $ex->result_array();
	}
	function get_lead_source($l_type)
	{
		$query="SELECT * FROM lead_type where status='1' and lead_type='$l_type'";
		$ex=$this->db->query($query);
		
		return $ex->result_array();
	}
	function get_lead_dealer($l_type,$l_source)
	{
		$query="SELECT * FROM lead_type where status='1' and lead_type='$l_type' and lead_source='$l_source'";
		$ex=$this->db->query($query);
		
		return $ex->result_array();
	}
	function get_local_appointments($user_id,$start,$end)
	{
			$query="SELECT * FROM appointment_information WHERE user_id='$user_id' and synchronize='local' and status='1' and start_date BETWEEN '$start' AND '$end' ";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_admin_local_appointments($start1,$end1)
	{
	/*	echo $start1;
		echo $end1;
		exit;*/
			$query="SELECT * FROM appointment_information WHERE synchronize='local' and status='1' and start_date BETWEEN '$start1' AND '$end1' ";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_appointments_details($user_id){
		$query="SELECT * FROM appointment_information WHERE synchronize='google' and user_id='$user_id' and status='1' ";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_user_appointments($user_id,$start1,$end1)
	{
		$query="SELECT * FROM appointment_information WHERE synchronize='google' and status='1' and user_id!='$user_id' and start_date BETWEEN '$start1' AND '$end1' ";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_admin_local_appointments_sync($start1,$end1)
	{
		$query="SELECT * FROM appointment_information WHERE status='1' and start_date BETWEEN '$start1' AND '$end1' ";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function user_id($mail)
	{
		$q="SELECT id from user_creation where email='$mail' ";
		$ex=$this->db->query($q);
		$fetch=$ex->result_array();
		$u_id=$fetch[0]['id'];
		return $u_id;
		//$query=""
	}
	 function update_appointment($app_id,$selected_cal_id,$event_id,$date,$time,$gift,$demo_dealer,$ride,$setby,$addr,$notes,$lead,$assistant,$supervisor,$status,$demo_note)
	{
		 $s="UPDATE appointment_information SET calendar_id='$selected_cal_id',event_id='$event_id',start_date='$date',start_time='$time',end_time='$time',demo_dealer='$demo_dealer',ride_along='$ride',set_by='$setby',appointment_address='$addr',appointment_notes='$notes',lead_id='$lead',assistant='$assistant' ,supervisor='$supervisor',appointment_status='$status',demo_notes='$demo_note' where id=$app_id";
		 $this->db->query($s);
		
	}
		function get_app_local_details($user_id,$start)
	{
		
		
			$query="SELECT * FROM appointment_information WHERE user_id='$user_id' and start_date='$start' and synchronize='local' and status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
		
		
	}
	function get_admin_app_local_details($google_event_date)
	{
			$query="SELECT * FROM appointment_information WHERE start_date='$google_event_date' and synchronize='local' and status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_user_app_details($user_id,$google_event_date)
	{
		$query="SELECT * FROM appointment_information WHERE start_date='$google_event_date' and synchronize='google' and user_id!='$user_id' and status='1'";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function get_app_details($user_id,$start,$id)
	{
		
			$query="SELECT * FROM appointment_information WHERE user_id='$user_id' and start_date='$start' and 	calendar_id='$id' and status='1'";
		
		$fetch=$this->db->query($query);
		return $fetch->result_array();
		
		
	}
	//arzoo - get all users email
	function getUserEmail(){
		$query = "select distinct(email) from user_creation";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	//arzoo - get subscription details 
	function getSubscriptionDetals($userid){
		$query = "select * from notification_subscription where user_id = '$userid' order by subscription_id desc limit 1";
		$fetch=$this->db->query($query);
		return $fetch->result_array();
	}
	function addSubscriptionDetails($details){
		$this->db->insert('notification_subscription',$details);
        return true;
	}
	function getNextSyncToken($userid){
		$query = "select * from sync_details where user_id = '$userid' order by sync_id desc limit 1";
		$fetch=$this->db->query($query);
		return $fetch->row_array();
	}
	function addNextSyncToken($details){
		$row = $this->db->where('next_token',$details['next_token'])->from("sync_details")->count_all_results();
		if($row==0)
		$this->db->insert('sync_details',$details);
        return true;
	}
	function getcustomername($id){
		$user_type=$this->session->userdata('user_type');
		if($user_type=="Admin" || $user_type=="Tele-caller" ){
			$this->db->select('*');    
			$this->db->from('new_account');
			$hasil=$this->db->get();
		}else{
			$this->db->select('*');    
			$this->db->from('new_account');
			$this->db->where('user_id',$id);
			$this->db->or_where('`id` IN (SELECT `customer_id` FROM `quotation_master` where salesrepresentative='.$id.')', NULL, FALSE);
			$this->db->or_where('`id` IN (SELECT `customer_id` FROM `order_master` where salesrepresentative='.$id.')', NULL, FALSE);
			 $hasil=$this->db->get();
		}
		return $hasil->result_array();
	
	 
	
	}
	function getreprentative($id){
		$user_type=$this->session->userdata('user_type');
		if($user_type=="Admin" || $user_type=="Tele-caller" ){
			$this->db->select('*');    
			$this->db->from('user_creation');
			$this->db->where('user_type','SalesRepresentative');
			$this->db->where('user_role','Sales');
			$hasil=$this->db->get();
		}else{
			$this->db->select('*');    
			$this->db->from('user_creation');
			$this->db->where('user_type','SalesRepresentative');
			$this->db->where('user_role','Sales');
			$this->db->where('id',$id);
			$hasil=$this->db->get();
		}
		return $hasil->result_array();
	}
	function set_userpermissions($data,$email)
	{
	  $p=$data['permissions'];
	  $u_type=$data['user_type'];
	   $s="UPDATE  page_access SET permissions='$p' where user_type='$u_type'";
	  $this->db->query($s);
	  
	}
}
?>