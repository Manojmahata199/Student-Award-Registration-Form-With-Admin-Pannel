<?php
error_reporting(0);
/**********************************************************************************************
	For Localhost
**********************************************************************************************/
	/*$host="localhost";
	$username="root";
	$password="";
	$dbname="infevent_db";*/

//----------------------------------------------------------------------------------------------
    // FOR HOST
//-----------------------------------------sss-----------------------------------------------------
	$host="localhost";
	$username="sanmatob";
	$password="Jcoe#@49319d";
	$dbname="sanmatob_rag";
$char_set = 'utf8';
  $char_collation = 'utf8_general_ci';

  header('Content-type: text/plain'); 
mysql_connect($host,$username,$password) or die("Could not connect to database");
mysql_select_db($dbname) or die("Could not select database");
error_reporting('E_ERROR|E_WARNING');
?>
