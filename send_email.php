<?php
 
function send_email_to_user($email, $data) {
    require_once 'config.php';
    require_once 'emails.php';
    $db = new DB();
    $arr_token = (array) $db->get_access_token();
 
    try {
        $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
            ->setAuthMode('XOAUTH2')
            ->setUsername(SYSTEM_EMAIL)
            ->setPassword($arr_token['access_token']);
 
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
 
        // Create a message
        $body = $data['body'];
        $subject = $data['subject'];
 
        $message = (new Swift_Message())
            ->setSubject($subject)
            ->setFrom([SYSTEM_EMAIL => 'Macedonian Personal Ministry'])
            ->setTo([$email])
            ->setBody($body)
            ->setContentType('text/html');
 
        // Send the message
        $mailer->send($message);
 
        return true;
    } catch (Exception $e) {
        if( !$e->getCode() ) {
            ini_set('log_errors', 'On');
            ini_set('display_errors', 'Off');
            ini_set('error_reporting', E_ALL);
            try {
                $refresh_token = $db->get_refresh_token();
     
                $response = $adapter->refreshAccessToken([
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refresh_token,
                    "client_id" => GOOGLE_CLIENT_ID,
                    "client_secret" => GOOGLE_CLIENT_SECRET,
                ]);
                 
                $google = (array) json_decode($response);
                $google['refresh_token'] = $refresh_token;
     
                $db->update_access_token(json_encode($google));
     
                send_email_to_user($email, $data);
            } catch (Error $e) {
               return false;
            }
        } else {
            return false;
        }
    }
}
