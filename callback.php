<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 
try {
    $adapter->authenticate();
    $token = $adapter->getAccessToken();
    $db = new DB();
    $db->update_access_token(json_encode($token));
    echo "Access token inserted successfully.";
}
catch( Exception $e ){
    echo $e->getMessage() ;
}