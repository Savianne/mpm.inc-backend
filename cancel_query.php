<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/class-db.php';

if(!isset($_GET['thread_id'])) {
    http_response_code(404);
    exit();
}

$thread_id = $_GET['thread_id'];

$db = new Db();

$delete_verified_query_sql = $db->db->query("DELETE FROM queries WHERE thread_id = '$thread_id'");

$loc = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
header("Location: ".$loc);