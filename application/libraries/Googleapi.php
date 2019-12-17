<?php
/**
 * @package Google API :  Google Client API
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Contact Controller
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Googleapi 
{
    /**
     * Googleapi constructor.
     */
    public function __construct() {        
    	// load google client api 
        require APPPATH."third_party/google-api-php/src/Google/autoload.php";
        $this->client = new Google_Client();
        $this->client->setApplicationName('Calendar Api');
        $this->ci =& get_instance();
        $this->ci->config->load('calendar');
		       
			      
        $this->client->setClientId($this->ci->config->item('client_id'));
        $this->client->setClientSecret($this->ci->config->item('client_secret'));
		 $this->client->setAccessType('offline');
        $this->client->setRedirectUri($this->ci->config->base_url().'googlecalendar/oauth');
        $this->client->addScope('https://www.googleapis.com/auth/calendar');
     /*    $this->client->addScope(Google_Service_Calendar::CALENDAR_EVENT);*/
        $this->client->addScope('https://www.googleapis.com/auth/calendar.events');
		$this->client->addScope('profile');
       
		 $this->client->setApprovalPrompt('force');

/*        require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
session_start();

$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");

// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
 $client->setClientId('836366606167-uj1a53mip4s6ckvtp95p437n7b3uu8ha.apps.googleusercontent.com');
 $client->setClientSecret('pzHYcE2idsDsK1SXwvGA-oZN');
 $client->setRedirectUri('http://localhost/user_form/google-plus-api-client-master/examples/calendar/simple.php');
// $client->setDeveloperKey('insert_your_developer_key');
$cal = new Google_CalendarService($client);*/
    }
 public function sethint($cal_id)
  {
    $this->client->setLoginHint($cal_id);
  }
    public function loginUrl() {
        return $this->client->createAuthUrl();
    }

    public function getAuthenticate() {
        return $this->client->authenticate();
    }

    public function getAccessToken() {
        return $this->client->getAccessToken();
    }

    public function setAccessToken() {
        return $this->client->setAccessToken();
    }

    public function revokeToken() {
        return $this->client->revokeToken();
    }

    public function client() {
        return $this->client;
    }

    public function getUser() {
        $google_ouath = new Google_Service_Oauth2($this->client);
        return (object)$google_ouath->userinfo->get();
    }
     public function getRefreshToken()
  {
    return $this->client->getRefreshToken();
  }
    public function isAccessTokenExpired() {
        return $this->client->isAccessTokenExpired();
    }
}
?>