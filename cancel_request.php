<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/class-db.php';

if(!isset($_GET['request_id'])) {
    http_response_code(404);
    exit();
}

$request_id = $_GET['request_id'];

$db = new Db();

$delete_request_sql = $db->db->query("DELETE FROM membership_request WHERE request_id = '$request_id'");

$loc = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
header("Location: ".$loc);