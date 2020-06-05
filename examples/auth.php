<?php
/**
 * Author: sagar <sam.coolone70@gmail.com>
 *
 */


require_once '../vendor/autoload.php';

// define('CLIEND_ID', '07cdaba2-7865-4cec-8c82-b6d69679c88c');
// define('CLIEND_SECRET', 'qR7tHeUpDhLXiZhPdXaT5aU');
define('CLIEND_ID', 'a1252244-099c-4899-b5a7-1a663b23b164');
define('CLIEND_SECRET', '_SFr7/H?G]hgWatk1gZ6eJCSReqk4?0g');

$authenticator = new Outlook\Authorizer\Authenticator(CLIEND_ID, CLIEND_SECRET);

$token = $authenticator->getToken();

if (!$token) {
    //echo $authenticator->getLoginUrl();
    $url = $authenticator->getLoginUrl();
    header('Location: '.$url);
} else {
    var_dump($token);
}
