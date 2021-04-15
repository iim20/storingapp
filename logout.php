<?php
require_once 'backend/config.php';
if(!isset($_SESSION['user_id']))
{
    session_start();
    $msg = "Je bent uitgelogd!";
    header("Location: $base_url/login.php?msg=$msg");    
    session_destroy();
    exit;
}
