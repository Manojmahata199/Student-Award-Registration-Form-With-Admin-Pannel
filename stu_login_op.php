<?php

ob_start();
session_start();


include('database.php');




if(isset($_POST['submit'])){

	 $stu_email=$_POST['stu_email'];
     $stu_reg_id=$_POST['stu_reg_id'];



    if($stu_email=="" || $stu_reg_id==""){

        $_SESSION['msg']="Please enter valid data";
    	header('location:student_login.php');
    }
    else{

        $stu_email=$_POST['stu_email'];
	    $stu_reg_id=$_POST['stu_reg_id'];


	    $sql="SELECT * FROM `student_data` WHERE `student_email`='$stu_email' and `reg_id`='$stu_reg_id'";

	    $query=mysqli_query($conn,$sql);
	    $row=mysqli_num_rows($query);
	    $res=mysqli_fetch_assoc($query);

	    if($row>0){


	    	$_SESSION['id']=$res['id'];
	    	$_SESSION['reg_id']=$res['reg_id'];
	    	$_SESSION['student_email']=$res['student_email'];
	    	$_SESSION['fname']=$res['fname'];
	    	$_SESSION['lname']=$res['lname'];

	    	$_SESSION['msg']="Please check your data, if it is not correct? Then login with right Email ID & Unique Roll Number or contact Sanmarg Pvt. Ltd.";
    	    header('location:upload_marksheet.php');

	    }else{

            $_SESSION['msg']="Please enter valid data";
    	    header('location:student_login.php');



	    }






    }
}






 ?>