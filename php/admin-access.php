<?php // Create Session
session_start();
include('admin-config.php');
if(!$dbconnect) // Check if database base connect established
{ header("Location: admin-config.php"); }
include("visitorSession.php"); // Record session data
?>