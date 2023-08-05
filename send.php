<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/class-db.php';
send_email_to_user('ajdeeguzman@gmail.com');

function send_email_to_user($email) {
    require_once 'config.php';
    
    $db = new DB();
    $arr_token = (array) $db->get_access_token();
 
    $db->get_access_token();
        $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
            ->setAuthMode('XOAUTH2')
            ->setUsername('www.ninzxky@gmail.com')
            ->setPassword($arr_token['access_token']);
 
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
 
        // Create a message
        $body = 'Hello, <p>Email sent through <span style="color:red;">Swift Mailer</span>.</p>';
 
        $message = (new Swift_Message('[Query] MPM Web site'))
            ->setFrom(['www.ninzxky@gmail.com' => 'Macedonian Personal Ministry'])
            ->setTo([$email])
            ->setBody($body)
            ->setContentType('text/html');
 
        // Send the message
        $mailer->send($message);
 
        echo 'Email has been sent.';
    
}