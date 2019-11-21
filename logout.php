<?php 
session_start(); 
session_destroy();
error_reporting(0);
ini_set('display_errors', 0); 
echo "<script>window.open('index','_self')</script>";
?>