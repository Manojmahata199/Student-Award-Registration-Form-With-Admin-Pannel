<?php

session_start();



include('database.php');


$_SESSION['id']="";
$_SESSION['reg_id']="";
$_SESSION['student_email']="";
$_SESSION['fname']="";
$_SESSION['lname']="";

header("location:index.php");




?>