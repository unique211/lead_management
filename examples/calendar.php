<?php
/**
 * Author: sagar <sam.coolone70@gmail.com>
 *
 */

use Outlook\Authorizer\Session;
use Outlook\Calendars\Calendar;
use Outlook\Calendars\CalendarAuthorizer;
use Outlook\Calendars\CalendarManager;

require_once '../vendor/autoload.php';

define('APP_ID', 'a1252244-099c-4899-b5a7-1a663b23b164');
define('APP_PASSWORD', '_SFr7/H?G]hgWatk1gZ6eJCSReqk4?0g');

$authenticator = new third_party\src\Outlook\Authorizer\Authenticator(
    APP_ID,
    APP_PASSWORD,
   // $redirectUri = "http://localhost/playground/outlook-api/examples/calendar.php"
    $redirectUri = "https://localhost/outlook-php/examples/calendar.php"
);

$sessionManager = new Session();
//$sessionManager->remove(); // if need to remove token manually from session

$eventAuthorizer = new CalendarAuthorizer($authenticator, $sessionManager);

$token = $eventAuthorizer->isAuthenticated();

if (!$token) {
    echo '<a href=' . $eventAuthorizer->getLoginUrl() . '>Login</a>';
} else {
    $eventManager = new CalendarManager($token);

    // get all Calendars returns each item as Event object
   // $calendars = $eventManager->all();

    //$allCalendars = $eventManager->getAllCalendars();
   //print_r($allCalendars);

  /* foreach ($calendars as $event) {
        echo $event->id . " -> " . $event;
        echo '<br />';
    } */
 
    // get single event with id
 /*   $event = $eventManager->get($eventId = 'AQMkADAwATM0MDAAMS1mYWJlLTc2ZDMtMDACLTAwCgBGAAADxtSZX36Ug0qmRAm-Pups1QcAebOFJWlMG0Oc5CRjAVwMrgAAAgENAAAAebOFJWlMG0Oc5CRjAVwMrgAAAiDBAAAA');
*/
    //create event
    // nested key name must be case sensitive correctly according to their docs.
    // only outer properties will be converted to Study case automatically
    $event = new Calendar(['subject' => 'Yoar data']);
    $event->body = ['ContentType' => 'HTML', 'Content' => 'Hello this is test Event'];
    $event->start = ["DateTime" => "2017-01-01T18:00:00", "TimeZone" => "Pacific Standard Time"];
    $event->end = ["DateTime" => "2017-01-01T19:00:00", "TimeZone" => "Pacific Standard Time"];
    $event = $eventManager->create($event);
//    var_dump($event);

    // make sure the properties are in exact same case as defiend in the docs.
//    $event = $eventManager->get('AQMkADAwATM0MDAAMS1mYWJlLTc2ZDMtMDACLTAwCgBGAAADxtSZX36Ug0qmRAm-Pups1QcAebOFJWlMG0Oc5CRjAVwMrgAAAgENAAAAebOFJWlMG0Oc5CRjAVwMrgAAAAJckAEAAAA=');
    $event->Body->Content = "new Updated Content";
    $updateEvent = $eventManager->update($event);
    var_dump($updateEvent); // event instance with updated values

//    $event = $eventManager->get('AQMkADAwATM0MDAAMS1mYWJlLTc2ZDMtMDACLTAwCgBGAAADxtSZX36Ug0qmRAm-Pups1QcAebOFJWlMG0Oc5CRjAVwMrgAAAgENAAAAebOFJWlMG0Oc5CRjAVwMrgAAAAJckAIAAAA=');
    $response = $eventManager->delete($event);
    var_dump($response); // response true or raised exception */
}
