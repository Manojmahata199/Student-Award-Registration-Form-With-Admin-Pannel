
<?php
// Start user session.
ob_start();

session_start();

//ob_clean();
// //header('Content-type: application/pdf');
// header('Content-Disposition: inline; filename="file"');
// header('Content-Transfer-Encoding: binary');
// header('Accept-Ranges: bytes');


ini_set('max_execution_time', 5000);
ini_set('max_input_time', 5000);
include('database.php');
require('vendor2/autoload.php');


require 'lib/mpdf/mpdf.php';
//require 'lib/mpdf/Mpdf.php';


require 'lib/PHPMailer/class.phpmailer.php';
require 'lib/PHPMailer/class.smtp.php';
require 'lib/PHPMailer/PHPMailerAutoload.php';


// Report all errors
error_reporting(0);
//testing input variables
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

 $success=0;



//  $sql_valiadtion="select * from `student_data`";
//  $result_for_validate=mysqli_query($conn,$sql_valiadtion);
//  $result_valiadtion=mysqli_fetch_assoc($result_for_validate);

//  $board_roll_no_validate=$result_valiadtion['board_roll_no'];
//  $email_validate=$result_valiadtion['student_email'];


//for registration id
function getRegistrationId($conn){ 
  $sqlGetStdList="select * from `student_data`";
  $result=mysqli_query($conn,$sqlGetStdList);
  $row=mysqli_num_rows($result);
  $row++;
  $regId=$row;
  $regId=str_pad($regId,7,"0",STR_PAD_LEFT);
  return $regId;
}


//CLIENT IP ADDRESS
function get_client_ip() {
     $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}




// define variables and set to empty values
$regId = $location = $boardexam = $stucategory = $fname = $lname = $hname = $hlname = $isHindiNameCorrect = $ankur_option = $yuva_option = "";
$stugender = $studob = $stuemail = $stumobile = $boardrollno = $schoolname = $otherschoolname = $otherschooladdress = "";
$schoolmedium = $parentname = $parentmobile = $emergencyno = $parentemail = $address= $city = $state = $pincode = $family_annual_income = "";
$facebook_handle = $twitter_handle = $ragaward_source = $ragaward_source_other = $sanmarg_reader = $hawker_name = $hawker_telephone = "";
$rag_pariksha_participated = $rag_pariksha_rollno = $rag_pariksha_marks = $rag_participated_chk = "";
$admitCardFileName= $ip = $formdatetime = $studentPhotoFileName = $ankur_activity_textwork = $ankurActivityFileName = "";
$class=$last_year_marks1=$last_year_marks2=$last_year_marks3=$current_year_marks1=$current_year_marks2=$current_year_preboards= $disorder ="";
$phy_disorder_name=$mental_disorder_name= $disorder_detail = $disorderFileName =$hindiNameFileName=$allActivityFileName="";
$display_msg=$last_id=$error_msg=$schooladdress=$duplicate_msg="";




// Current request method



// if ($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST['submit'])){

	//assigning values	
	$registrationId=getRegistrationId($conn);





	// location value to store in table 
	if(isset($_POST['location'])){   
	  
		  
		$location=test_input($_POST['location']);
		 
	 }


    //other variable 
	if(isset($_POST['boardexam'])){  
	  $boardexam=test_input($_POST['boardexam']);
	}
  $stucategory=test_input($_POST['category']);
  $disorder=test_input($_POST['disorder']);
  $phy_disorder_name=test_input($_POST['phy_disorder_name']);  
  $mental_disorder_name=test_input($_POST['mental_disorder_name']); 
  $disorder_detail=test_input($_POST['disorder_detail']);
  $fname=test_input($_POST['fname']);  
  $lname=test_input($_POST['lname']);
  $hname=test_input($_POST['hname']);
  $hlname=test_input($_POST['hlname']);


  if(isset($_POST['radHindiName'])){
  $isHindiNameCorrect =test_input($_POST['radHindiName']);
  }


  if(isset($_POST['gender'])){
  $stugender=test_input($_POST['gender']);
  }


  $studob=test_input($_POST['studob']);
  $stuemail=test_input($_POST['stuemail']);
  $stumobile=test_input($_POST['stumobile']);
  
  $boardrollno=test_input($_POST['boardrollnumber']);
  $board_roll_no_stu_validate = str_replace(' ','',$boardrollno);

  if(isset($_POST['schoolname'])){
  $schoolname=test_input($_POST['schoolname']);
  }



  if(isset($_POST['school_address'])){
  $schooladdress=test_input($_POST['school_address']);
  }


  if(isset($_POST['other_school_name'])){
  $otherschoolname=test_input($_POST['other_school_name']);
  }


  if(isset($_POST['other_school_address'])){
  $otherschooladdress=test_input($_POST['other_school_address']);
  }



  if(isset($_POST['school_medium'])){
  $schoolmedium=test_input($_POST['school_medium']);
  }



  if(isset($_POST['parent_name'])){
  $parentname=test_input($_POST['parent_name']);
  }




  $parentmobile=test_input($_POST['parentmobile']);
  $emergencyno=test_input($_POST['emergency_landline']);
  $parentemail=test_input($_POST['parent_email']);
  $address=test_input($_POST['home_address']);
  $city=test_input($_POST['city']);
  $state=test_input($_POST['state']);
  $pincode=test_input($_POST['pincode']);
  $family_annual_income=test_input($_POST['family_income']);
  $facebook_handle = test_input($_POST['facebook_handle']);
  $twitter_handle = test_input($_POST['twitter_handle']);
  $ragaward_source=test_input($_POST['ragaward_source']);
  $ragaward_source_other=test_input($_POST['ragaward_source_other']);
  $sanmarg_reader=test_input($_POST['sanmarg_reader']);
  $hawker_name=test_input($_POST['hawker_name']);
  $hawker_telephone=test_input($_POST['hawker_telephone']);
  $rag_pariksha_participated=test_input($_POST['rag_pariksha_participated']);  
  $rag_pariksha_rollno=test_input($_POST['rag_pariksha_rollno']);
  $rag_pariksha_marks=test_input($_POST['rag_pariksha_marks']);



  if(isset($_POST['rag_participated_chk'])){ 
  $rag_participated_chk=test_input($_POST['rag_participated_chk']); 
  }




  $ankur_option=test_input($_POST['ankur']);
  $yuva_option=test_input($_POST['yuva']);
  $ankur_activity_textwork=test_input($_POST['ankur_activity_textwork']);
  $class=test_input($_POST['stuclass']);
  $last_year_marks1=test_input($_POST['last_year_marks1']);
  $last_year_marks2=test_input($_POST['last_year_marks2']);
  $last_year_marks3=test_input($_POST['last_year_marks3']);
  $current_year_marks1=test_input($_POST['current_year_marks1']);
  $current_year_marks2=test_input($_POST['current_year_marks2']);
  $current_year_preboards=test_input($_POST['current_year_preboards']); 
  $disorderFileName=$_FILES["disorder_file"]["name"];
  $studentPhotoFileName=$_FILES["student_photo_file"]["name"];
  $admitCardFileName=$_FILES["admit_card_file"]["name"];
  $hindiNameFileName=$_FILES["hname_file"]["name"];
  $ankurActivityFileName=$_FILES["ankur_activity_file"]["name"]; 
  $allActivityFileName=$_FILES["all_activity_file"]["name"]; 
  // $submit_type=$_POST['submit_type'];
  // $extempore_date=$_POST['extempore_date_checkbox'];  
  $ip=get_client_ip();
  date_default_timezone_set("Asia/Calcutta");
  $formdatetime=date('Y-m-d H:i:s');
  $hnd_tech_name=$_POST['hindi_Teacher_name'];
  $hnd_tech_mob=$_POST['hindi_teacher_mobile'];
 
  
  
}//END OF FIRST IF CONDITION SERVER REQUEST=POST



if(isset($_POST['submit'])){
  //check for duplicate records-(before insertion)  
  // Attempt insert query execution
// school_address

 $sql_valiadtion="select * from `student_data` WHERE `board_roll_no`='$board_roll_no_stu_validate' and `boardexam`='$boardexam'";
 $result_for_validate=mysqli_query($conn,$sql_valiadtion);
 $result_valiadtion=mysqli_fetch_assoc($result_for_validate);

 $board_roll_no_validate=$result_valiadtion['board_roll_no'];
 $email_validate=$result_valiadtion['student_email'];
 $board_valiadte=$result_valiadtion['boardexam'];

   if($board_roll_no_validate==$board_roll_no_stu_validate  && $board_valiadte==$boardexam){
  	
          $duplicate_msg="Student You Have Allready Registered With us.You Can Not Do Registration Again.Contact Us For Any Changes In Your Details"; 

    
  }else{





				  $sql = "INSERT INTO `student_data`(`form_date_time`, `reg_id`, `ip_address`, `reg_location`, `boardexam`, `category`, `disorder`, `phy_disorder_name`, `mental_disorder_name`, `disorder_detail`,
				  `disorder_file`, `fname`, `lname`, `hname`, `hlname`, `student_photo_file`, `hname_correct`, `hname_file`, `student_gender`, `student_dob`, `student_email`, `student_mobile`, `board_roll_no`,
				  `admit_card_file`,`school_name`,`school_address`, `other_school_name`, `other_school_address`, `school_medium`, `class`, `last_year_marks1`, `last_year_marks2`,`current_year_marks1`,
				  `current_year_marks2`, `current_year_preboards`, `parent_name`, `parent_mobile`, `emergency_landline`, `parent_email`, `home_address`, `city`, `state`, `pincode`, `family_income`, `facebook_handle`, `twitter_handle`,
				  `ragaward_source`, `ragaward_source_other`, `sanmarg_reader`,`rag_participated_chk`, `ankur`, `ankur_activity_textwork`, 
				  `ankur_activity_file`,`hnd_tech_name`,`hnd_tech_mob`)


				        VALUES ('$formdatetime','$registrationId','$ip', '$location', '$boardexam', '$stucategory','$disorder','$phy_disorder_name','$mental_disorder_name','$disorder_detail','$disorderFileName', '$fname',
				        '$lname','$hname','$hlname','$studentPhotoFileName','$isHindiNameCorrect','$hindiNameFileName','$stugender','$studob','$stuemail','$stumobile','$board_roll_no_stu_validate','$admitCardFileName','$schoolname',
				        '$schooladdress',
				        '$otherschoolname','$otherschooladdress','$schoolmedium','$class','$last_year_marks1','$last_year_marks2','$current_year_marks1','$current_year_marks2','$current_year_preboards','$parentname',
				        '$parentmobile','$emergencyno','$parentemail','$address','$city','$state','$pincode','$family_annual_income','$facebook_handle','$twitter_handle','$ragaward_source','$ragaward_source_other',
				        '$sanmarg_reader','$rag_participated_chk','$ankur_option',
				        '$ankur_activity_textwork','$ankurActivityFileName','$hnd_tech_name','$hnd_tech_mob')";  



				  $result=mysqli_query($conn,$sql);



				  
				  
				  
				  $last_id = mysqli_insert_id($conn);


				  if($result) {
				            $display_msg="Student You Have Already Registered.Contact Us For Any Change In Your Details"; 
				    }



				 //File upload code starts here
				    if($last_id)
				    {
					    //disorder image upload
						if($_FILES['disorder_file'] && $stucategory=="Aparajay")
						{
							if (!file_exists('$target_dir'.$last_id.'/disorder-img/')) {
				    			mkdir('uploads/'.$last_id.'/disorder-img/', 0777, true);
								}
							$target_dir = "uploads/".$last_id."/disorder-img/";
							$target_file = $target_dir.$_FILES["disorder_file"]["name"];
							$uploadOk = 1;


							
							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


							// Check if image file is a actual image or fake image
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				        	&& $imageFileType != "pdf" && $imageFileType != "jfif") {

									$error_msg="Uploaded Disorder File is an Invalid";
									$uploadOk = 0;
							}
							// Check file size
							if ($_FILES["disorder_file"]["size"] > 1000000) {
					   			$error_msg= "Sorry, your Disorder File is too large.";
					   		 	$uploadOk = 0;
							}
							if($uploadOk ==0){
							   $error_msg="Your Disorder File was not uploaded";
							}
							else
							{
								if($uploadOk ==1)
								{
								    move_uploaded_file($_FILES["disorder_file"]["tmp_name"], $target_file);
								}
							}
						}
						//student Photo upload
						// if($_FILES['student_photo_file'])
						// {
						// 	if (!file_exists('$target_dir'.$last_id.'/student-photo/'))
						// 	{
				  //   			mkdir('uploads/'.$last_id.'/student-photo/', 0777, true);
						// 	}
						// 	$target_dir = "uploads/"."/".$last_id."/student-photo/";
						// 	$target_file = $target_dir.$_FILES["student_photo_file"]["name"];
						// 	$uploadOk = 1;
						// 	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						// 	// Check if image file is a actual image or fake image
						// 	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				  //       	&& $imageFileType != "pdf" ){
						// 	$error_msg="Uploaded Photogragh File is not an image or pdf";
						// 	$uploadOk = 0;
						// 	}
						// 	// Check file size
						// 	if ($_FILES["student_photo_file"]["size"] > 1000000) {
				  //  			$error_msg= "Sorry, your Photogragh File is too large.";
				  //  		 	$uploadOk = 0;
						// 	}
						// 	if($uploadOk ==0){
						// 	$error_msg="Your Photogragh File was not uploaded";
						// 	}
						// 	else
						// 	{
						// 		if($uploadOk ==1)
						// 		{
						// 		 	move_uploaded_file($_FILES["student_photo_file"]["tmp_name"], $target_file);
						// 		}
						// 	}
						// }
						//student Photo upload
						if($_FILES['student_photo_file'])
						{
							if (!file_exists('$target_dir'.$last_id.'/student-photo/'))
							{
				    			mkdir('uploads/'.$last_id.'/student-photo/', 0777, true);
							}
							$target_dir = "uploads/".$last_id."/student-photo/";
							$target_file = $target_dir.$_FILES["student_photo_file"]["name"];
							$uploadOk = 1;


							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

							// Check if image file is a actual image or fake image
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				        	&& $imageFileType != "pdf" && $imageFileType != "jfif"){
									$error_msg="Uploaded Photogragh File is not an image or pdf";
									$uploadOk = 0;
							}


							// Check file size
							if ($_FILES["student_photo_file"]["size"] > 1000000) {
					   			$error_msg= "Sorry, your Photogragh File is too large.";
					   		 	$uploadOk = 0;
							}
							if($uploadOk ==0){
							     $error_msg="Your Photogragh File was not uploaded";
							}
							else
							{
								if($uploadOk ==1)
								{
								 	move_uploaded_file($_FILES["student_photo_file"]["tmp_name"], $target_file);
								}
							}
						}
						//admit card upload
						if($_FILES['admit_card_file'])
						{
						 	if (!file_exists('$target_dir'.$last_id.'/admit-card/'))
							{
				    			mkdir('uploads/'.$last_id.'/admit-card/', 0777, true);
							}
							$target_dir = "uploads/".$last_id."/admit-card/";
							$target_file = $target_dir.$_FILES["admit_card_file"]["name"];
							$uploadOk = 1;
							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
							// Check if image file is a actual image or fake image
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					        && $imageFileType != "pdf" && $imageFileType != "jfif") 
							{
								$error_msg="Uploaded Admit Card File is not an image type is invalid";
								$uploadOk = 0;
							}
							// Check file size
							if ($_FILES["admit_card_file"]["size"] > 1000000)
							{
				   				$error_msg= "Sorry, your Admit Card File is too large.";
				   		 		$uploadOk = 0;
							}
							if($uploadOk ==0)
							{
								$error_msg="Your Admit Card File was not uploaded";
							}
							else
							{
								if($uploadOk ==1)
								{
								 	move_uploaded_file($_FILES["admit_card_file"]["tmp_name"], $target_file);
								}
							}
						}
						//hindi name correct image upload
						if($_FILES['hname_file'] && $isHindiNameCorrect=="No" )
						{
							if (!file_exists('$target_dir'.$last_id.'/hindi-name/'))
							{
				    			mkdir('uploads/'.$last_id.'/hindi-name/', 0777, true);
							}
							$target_dir = "uploads/".$last_id."/hindi-name/";
							$target_file = $target_dir.$_FILES["hname_file"]["name"];
							$uploadOk = 1;
							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
							// Check if image file is a actual image or fake image
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				        	&& $imageFileType != "pdf" && $imageFileType != "jfif")
							{
								$error_msg="Uploaded Scanned Hindi Name File is not an image";
								$uploadOk = 0;
							}
							// Check file size
							if ($_FILES["hname_file"]["size"] > 1000000)
							{
				   				$error_msg= "Sorry, your Scanned Hindi Name File is too large.";
				   		 		$uploadOk = 0;
							}
							if($uploadOk ==0)
							{
								$error_msg="Your Scanned Hindi Name File was not uploaded";
							}
							else
							{
								if($uploadOk ==1)
								{
									move_uploaded_file($_FILES["hname_file"]["tmp_name"], $target_file);
								}
							}
						}
						//exceptional work in hindi field image upload
						if($_FILES['ankur_activity_file'] && $ankur_activity_textwork !== "")
						{
							if (!file_exists('$target_dir'.$last_id.'/ankur-activity/')) {
				    		     mkdir('uploads/'.$last_id.'/ankur-activity/', 0777, true);
						    }
							$target_dir = "uploads/".$last_id."/ankur-activity/";
							$target_file = $target_dir.$_FILES["ankur_activity_file"]["name"];
							$uploadOk = 1;
							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
							// Check if image file is a actual image or fake image
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				        	&& $imageFileType != "pdf" && $imageFileType != "jfif")
							{
								$error_msg="Uploaded First Activity File is not an image";
								$uploadOk = 0;
							}
							// Check file size
							if ($_FILES["ankur_activity_file"]["size"] > 1000000) {
				   				$error_msg= "Sorry, your First Activity File is too large.";
				   		 		$uploadOk = 0;
							}
							if($uploadOk ==0)
							{
								$error_msg="Your First Activity File was not uploaded";
							}
							else
							{
								if($uploadOk ==1){
								  move_uploaded_file($_FILES["ankur_activity_file"]["tmp_name"], $target_file);
								}
							}
						}
						//all activity scan copy file
						if($_FILES['all_activity_file'] && $ankur_activity_textwork !== ""){
							if (!file_exists('$target_dir'.$last_id.'/all-activity/')) {
					    		mkdir('uploads/'.$last_id.'/all-activity/', 0777, true);
							}
								$target_dir = "uploads/".$last_id."/all-activity/";
								$target_file = $target_dir.$_FILES["all_activity_file"]["name"];
								$uploadOk = 1;
								$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
								// Check if image file is a actual image or fake image
								if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
								&& $imageFileType != "pdf" && $imageFileType != "jfif"){
								$error_msg="Uploaded All Activity file is not an image";
								$uploadOk = 0;
								}
								// Check file size
								if ($_FILES["all_activity_file"]["size"] > 1000000) {
									$error_msg= "Sorry, your All Activity file is too large.";
								 	$uploadOk = 0;
								}
								if($uploadOk ==0){
									$error_msg="Your All Activity file was not uploaded";
								}
								else
								{
									if($uploadOk ==1)
									{
										move_uploaded_file($_FILES["all_activity_file"]["tmp_name"], $target_file);	
									}
								}
						}
						//all activity scan copy file
						
						





				        $timezone=date_default_timezone_set("Asia/Calcutta");
				        $printed_date = date('Y-m-d H:i:s');


					    // //email part 


					   $name=$fname." ".$lname;
						
					    ob_start();	
					    ob_clean();	  	  
						//$page_url =('http://rag.sanmarg.in/print-student-data.php?id='.$last_id.''); // to grab the current url
						//$html = file_get_contents($page_url);

							include('database.php');
							$sql="SELECT * FROM `student_data` WHERE `id` = ".$last_id;
							$result=mysqli_query($conn,$sql);
							$row=mysqli_fetch_assoc($result);


							if($row==""){
								exit;
							}


							//Storing values
							$boardName=$row['boardexam'];
							/*** get school name*/


							if($row['school_name'] =="others")
							{ 
								$schoolName = $row['other_school_name'];
								$schoolAddress = $row['other_school_address'];
							}
							else
							{ 
								
								$schoolName = $row['school_name'];
								$schoolAddress = $row['school_address'];
							}


							if($row["category"] == "Aparajay")
							{ 
							 $category="Yes"; 
							} else { 
							 $category="No"; 
							}
							if($row["ankur"] =="")
							{ 
								$ankur="No"; 
							} else { 
								$ankur="Yes"; 
							}
							
							if($row["disorder_file"] != "") 
					        { 
								$aparajay="Aparajay Documents"; 
							}
							 if($row["hname_file"] != "") 
							{ 
								$hname_file="Hindi Correct File Name";
							}
							if($row["student_photo_file"] != "") 
							{ 
								$stu_pic_iden="Student Photo Identity";
							}
							if($row["admit_card_file"] != "") 
							{ 
								$admit_card="Admit Card";
						    }
						    if($row["ankur_activity_file"] != "")
						    {
								$ankur_activ="Ankur Activity"; 
						    }
						    if($row["marksheet_file"] != "") 
						    { 
								$board_mark="Board Marksheet"; 
							}
							


						$html='
								<!doctype html>
								<html lang="en">
								<head>
								  <meta charset="utf-8">
								  <!-- <link rel="shortcut icon" type="image/x-icon" ng-href="favicon.ico"> -->
								  <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no" />
								  <link href="https://fonts.googleapis.com/css?family=Noto+Serif|Open+Sans|Roboto&display=swap" rel="stylesheet">
								  <link rel="stylesheet" type="text/css" href="css/email-style.css" />
								  <title>Student Registration Form 2022</title> 
								   <!-- add icon link -->
				                    <link rel = "icon" href ="images/new-sign-up.png" type = "image/x-icon">

						    <!-- Font Icon -->	  
							<link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
							<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel = "Stylesheet" type="text/css" />
							<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
							<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
							<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
							<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
						    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
								
						    <!-- Main css -->
						    <link rel="stylesheet" href="css/style.css">
						     <link rel="stylesheet" href="css/email-style.css">
						     
						      <link rel="stylesheet" type="text/css" href="css/email-style.css" />

						    
							<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type = "text/javascript"></script>
							<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type = "text/javascript"></script>
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
						    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
							<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
						         rel = "stylesheet">
						      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
						      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

						      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


							<!-- CSS only -->
						<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

						<!-- JavaScript Bundle with Popper -->
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

						<script type="text/javascript" src="js2/jquery-3.6.0.min.js"></script>
						
						
				// 		<link rel="stylesheet" href="https://amsul.ca/pickadate.js/css/main.css">
				//         <link rel="stylesheet" href="https://amsul.ca/pickadate.js/vendor/pickadate/lib/themes/default.css" id="theme_base">
				//         <link rel="stylesheet" href="https://amsul.ca/pickadate.js/vendor/pickadate/lib/themes/default.date.css" id="theme_date">
				//         <link rel="stylesheet" href="https://amsul.ca/pickadate.js/vendor/pickadate/lib/themes/default.time.css" id="theme_time">
				          
								</head>
								<body>
								  <div class="pdfsection-mail col-md-12" style="border: 4px solid black;margin-left:20px; background-color: #fee588;margin-top:10px;margin-bottom:10px;">
									<table>
									
										<tr>


											<td valign="top">
												<img id="pdf-left-logo" src="images/RAGLOGO_2022.png" width="150" height="400">
											</td>



											<td valign="top">
												<table id="pdf-reg-email" class="pdf-email">
												<thead>
												 
												
											
												<tr><th colspan="2"><h1><br> 
												
												   <span class="eng-label" style="text-align: center;align-content: center;align-items: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RAM AWATAR GUPT PROTSAHAN - 2022</span><br/>
												   <span class="hindi-label" style="text-align: center;align-content: center;align-items: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;????????? ??????????????? ??????????????? ????????????????????????????????? 2022</h1></h1></th></tr>
				                                     <br>  <br>  								  
												   
												<tr><th colspan="2"><h4>
												  <span class="eng-label" style="text-align: center;align-content: center;align-items: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration Confirmation Form</span>
												  <span class="hindi-label" style="text-align: center;align-content: center;align-items: center;">(????????????????????? ?????????????????????)</span><br/><span class="eng-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unique Roll Number:<span class="high-light">T-'.$boardName.'-'.$row["reg_id"].'</span></span><br><span class="hindi-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     (??????????????? ????????? ????????????)</span></h4></th></tr>
										        <br>  <br>  <br>  
				    						       
										        
										        </thead>
												<tbody>
												<tr><td><span class="hindi-label">????????????????????????????????? (????????????????????? ?????????????????????)</span></td><td rowspan="2"><span class="eng-label">'.$row["reg_location"].'</span></td></tr>
												<tr><td><span class="eng-label">Registering For</span></td></tr>
												<tr><td><span class="hindi-label">???????????? ????????? (????????????????????????)</span></td><td rowspan="2"><span class="eng-label">'.$row["fname"].' '.$row["lname"].'</span></td></tr>
												<tr><td><span class="eng-label">Full Name in (English)</span></td></tr>
												<tr><td><span class="hindi-label">???????????? ????????? (???????????????)</span></td><td rowspan="2"><span class="hindi-label">'.$row["hname"].' '.$row["hlname"].'</span></td></tr>
												<tr><td><span class="eng-label">Full Name in (Hindi)</span></td></tr>
												<tr><td><span class="hindi-label">????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["student_gender"].'</span></td></tr>
												<tr><td><span class="eng-label">Gender</span></td></tr>
												<tr><td><span class="hindi-label">???????????? ????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["student_dob"].'</span></td></tr>
												<tr><td><span class="eng-label">Date of Birth</span></td></tr>
												<tr><td><span class="hindi-label">???-?????????</span></td><td rowspan="2"><span class="eng-label">'.$row["student_email"].'</span></td></tr>
												<tr><td><span class="eng-label">Email ID</span></td></tr>
												<tr><td><span class="hindi-label">?????????????????? ????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["student_mobile"].'</span></td></tr>
												<tr><td><span class="eng-label">Mobile Number</span></td></tr>
												<tr><td><span class="hindi-label">??????????????? ?????????????????????</span></td><td rowspan="2"><span class="eng-label">'.$boardName.'</span></td></tr>
												<tr><td><span class="eng-label">Board exam appeared for</span></td></tr>
												<tr><td><span class="hindi-label">??????????????? ????????? ????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["board_roll_no"].'</span></td></tr>
												<tr><td><span class="eng-label">Board Roll Number</span></td></tr>


												 <tr><td><span class="hindi-label">???????????????*</span></td><td rowspan="2"><span class="eng-label">'.$row["class"].'</span></td></tr>
												<tr><td><span class="eng-label">Class</span></td></tr>
												
												 <tr><td><span class="hindi-label">???????????? ???????????????????????? ?????? ????????? ??????????????????*</span></td><td rowspan="2"><span class="eng-label">'.$row["school_medium"].'</span></td></tr>
												<tr><td><span class="eng-label">medium of instruction in your school</span></td></tr>


												<tr><td><span class="hindi-label">??????????????? ?????? ???????????? ?????????</span></td><td rowspan="2"><span class="eng-label">'.$schoolName.'</span></td></tr>
												<tr><td><span class="eng-label">School Full Name</span></td></tr>
												<tr><td><span class="hindi-label">??????????????? ?????? ?????????</span></td><td rowspan="2"><span class="eng-label">'.$schoolAddress.'</span></td></tr>
												<tr><td><span class="eng-label">School Address</span><hr></td></tr>



												 <tr><td><span class="hindi-label">??????????????? ?????????????????? ?????? ?????????*</span></td><td rowspan="2"><span class="eng-label">'.$row["hnd_tech_name"].'</span></td></tr>
												<tr><td><span class="eng-label">Hindi Teacher Name</span></td></tr>

												<tr><td><span class="hindi-label">??????????????? ?????????????????? ?????????????????? ????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["hnd_tech_mob"].'</span></td></tr>
												<tr><td><span class="eng-label">Hindi Teacher Mobile Number</span></td></tr>


												
												<tr><td><span class="hindi-label">????????????????????? ?????? ?????????</span></td><td rowspan="2"><span class="eng-label">'.$row["parent_name"].'</span></td></tr>
												<tr><td><span class="eng-label">Parent / Guardian name</span></td></tr>
												<tr><td><span class="hindi-label">????????????????????? ?????? ????????? ????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["parent_mobile"].'</span></td></tr>
												<tr><td><span class="eng-label">Parent / Guardian Mobile Number</span></td></tr>
												<tr><td><span class="hindi-label">???????????????????????? ?????????????????? ????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["emergency_landline"].'</span></td></tr>
												<tr><td><span class="eng-label">Emergency landline Number</span></td></tr>
												<tr><td><span class="hindi-label">????????????????????? ?????? ???-?????????</span></td><td rowspan="2"><span class="eng-label">'.$row["parent_email"].'</span></td></tr>
												<tr><td><span class="eng-label">Parent / Guardian Email ID</span></td></tr>
												<tr><td><span class="hindi-label">????????????????????? ?????? ?????????</span></td><td rowspan="2"><span class="eng-label">'.$row["home_address"].'</span></td></tr>
												<tr><td><span class="eng-label">Parent / Guardian Address</span></td></tr>
												<tr><td><span class="hindi-label">?????????</span></td><td rowspan="2"><span class="eng-label">'.$row["city"].'</span></td></tr>
												<tr><td><span class="eng-label">City</span></td></tr>
												<tr><td><span class="hindi-label">???????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["state"].'</span></td></tr>
												<tr><td><span class="eng-label">State</span></td></tr>
												<tr><td><span class="hindi-label">????????? ?????????</span></td><td rowspan="2"><span class="eng-label">'.$row["pincode"].'</span></td></tr>
												<tr><td><span class="eng-label">Pincode</span></td></tr>
												<tr><td><span class="hindi-label">??????????????? 10 ????????? ????????? ??????????????? ??????????????? ???????????????????????? ????????????????????? ?????????</span></td><td rowspan="2"><span class="eng-label">'.$row["rag_participated_chk"].'</span></td></tr>
												<tr><td><span class="eng-label">Received Ram Awatar Gupt Pratibha Puraskar in class 10</span></td></tr>
												<tr><td><span class="hindi-label">????????????-??????????????? / ???????????????????????? ????????????????????? ????????? ??????????????? ????????? ????????????????????? ?????????</span></td><td rowspan="2"><span class="eng-label">'.$row["current_year_preboards"].'</span></td></tr>
												<tr><td><span class="eng-label">Pre-Board / Selection Marks in Hindi Subject</span></td></tr>
												
												<tr><td><span class="hindi-label">??????????????????</span></td><td rowspan="2"><span class="eng-label">'.$category.'</span></td></tr>

												<tr><td><span class="eng-label">Aparajay</span></td></tr>
												<tr><td><span class="hindi-label">???????????????</span></td><td rowspan="2"><span class="eng-label">'.$ankur.'	</span></td></tr>
												<tr><td><span class="eng-label">Ankur</span><hr></td></tr>


												


												
												<tr><td><span class="hindi-label">?????????????????? ???????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["facebook_handle"].'</span></td></tr>
												<tr><td><span class="eng-label">Facebook Handle</span></td></tr>
												<tr><td><span class="hindi-label">????????????????????????????????? ???????????????</span></td><td rowspan="2"><span class="eng-label">'.$row["twitter_handle"].'</span></td></tr>
												<tr><td><span class="eng-label">Instagram Handle</span></td></tr>
												<tr><td><span class="hindi-label">??????????????? ????????? ?????? ????????????????????????</span></td><td rowspan="2"><span class="eng-label">

													     '.$aparajay.'<br/>
													     '.$hname_file.'<br/>
								                         '.$stu_pic_iden.'<br/>
													     '.$admit_card.'<br/>
								                         '.$ankur_activ.'<br/> 							
														 '.$board_mark.'<br/>
														 


														</span></td></tr>

												        <tr><td><span class="eng-label">Relevant Documents Uploaded</span></td></tr>	
												</tbody>		
												</table>				
											</td>



											<td valign="top">
												<img id="pdf-right-logo" src="images/RAGLOGO_2022.png" width="150" height="150">
											</td>


										</tr>
									</table>
								  </div>
								</body>
								</html>';
						

				           //  $page_url =('http://rag.sanmarg.in/print-student-data.php?id='.$last_id.''); // to grab the current url
				            
						  //  $html = file_get_contents($page_url);	

							$mpdf=new \Mpdf\Mpdf();
							$mpdf->WriteHTML($html);

							 $dir = 'uploads/'.$last_id.'/registration-data';

							 // $file='uploads/'.$last_id.'/pdf_file/file'.$last_id.'.pdf';

							 $file='uploads/file'.$last_id.'.pdf';


							$mpdf->output($file,'F');
						    $emailAttachment=$mpdf->Output($file, 'S');
							//D
							//I
							//F
							//S
						




						  $mail = new PHPMailer;

				            $mail->isSMTP();  
				            $mail->SMTPDebug =3;                                       // Set mailer to use SMTP
				            $mail->Host = 'smtp.gmail.com';   // Specify main and backup SMTP servers
				            $mail->Debugoutput = 'html';
				            $mail->SMTPAuth = true;                               // Enable SMTP authentication
				            $mail->Username = 'ragpp@sanmarg.in';                 // SMTP username
				            $mail->Password = 'SanRag@9812sx';                           // SMTP password
				            $mail->SMTPSecure = 'tls';                           // Enable encryption, 'ssl' also accepted
				            $mail->CharSet = "UTF-8";
				            $mail->Port = 587;
				// SanRag@9812sx
				            $mail->From = 'ragpp@sanmarg.in';
				            $mail->FromName = 'Ram Awatar Gupt Protsahan-2022';
				            $mail->addAddress($stuemail, 'Ragp Registered User 2022');     // Add a recipient
				            //$mail->addAddress('ellen@example.com');               // Name is optional
				            $mail->addReplyTo('ragpp@sanmarg.in', 'Information');
				            // $mail->addCC('cc@example.com');
				            // $mail->addBCC('bcc@example.com');

				            $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
				            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				            $mail->isHTML(true);                                     // Set email format to HTML

				            $mail->Subject = 'Registration Confirmation mail(1)';
				            $mail->AddEmbeddedImage('images/RAGLOGO_2022.png','LOGO');
				             

				           $Body=file_get_contents('registration-email.html');
				           //$Body=str_ireplace("EMAILLOGO", 'images/sanmarg-logo-email-sponsor.png', $Body);
				           $Body=str_ireplace("REGNAME", $name, $Body);
				           $Body=str_ireplace("REGNUMBER", 'T-'.$boardexam.'-'.$registrationId, $Body);
					        $Body=str_ireplace("RAGP_ID", $registrationId, $Body);
					         $Body=str_ireplace("USER_MAIL", $stuemail, $Body);  
					       $mail->Body=$Body;


					       // $mail->msgHTML($Body, dirname(__FILE__));
						   $mail->AddStringAttachment($emailAttachment,'ragp-form-2022.pdf','base64','application/pdf');		 

				            

				            $mail->SMTPOptions = array(
				                  'ssl' => array(
				                      'verify_peer' => false,
				                      'verify_peer_name' => false,
				                      'allow_self_signed' => true
				                  )
				              );

				            if(!$mail->send()) {
				                $display_msg= '????????????????????? ?????? ????????? ????????????????????? ???????????????<br>Thank You Student For Registration ';

				               $success=1;
				                
				            			
				            } else {
				            	$display_msg= '????????????????????????????????? ?????? ????????? ???????????? ?????????????????????, ???????????? ?????????????????? ?????? ????????? ???????????? ???????????? ????????? ???????????? ????????? ??????|<br>Thank you for registering, a confirmation Email has been sent to you.';


				               $success=1;
				           
				            	
				        	}

				            
				              ob_end_clean();

						
					

					//............. end....

					    

				        

						
						
				    }


				}

   
}

?>






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RAGP Registration Form 2022</title>
	 <!-- add icon link -->
        <link rel = "icon" href ="images/RAGLOGO_2022.png" type = "image/x-icon">

    <!-- Font Icon -->	  
	<!--<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>-->
	<!--<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel = "Stylesheet" type="text/css" />-->
	<!--<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
		
    <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" type="text/css" href="css/email-style.css">
   
     <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" type="text/css" href="css/email-style.css" />

    <!--<link rel="stylesheet" type="text/css" href="jq_ui_css/jquery-ui.min.css">-->


    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
    <!--<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'-->
          <!--rel='stylesheet'>-->


    
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type = "text/javascript"></script>-->
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type = "text/javascript"></script>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<!--<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"-->
         <!--rel = "stylesheet">-->
      <!--<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>-->
      <!--<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->

      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->


	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->

  <!--<script type="text/javascript" src="js2/jquery-3.6.0.min.js"></script>-->
  <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">-->
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <!--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>-->
  <!--<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>-->
  <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
  <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>-->
  <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>-->

  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>-->
 

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script> -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"-->
    <!--type="text/javascript"></script>-->
<!--<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"-->
    <!--rel="Stylesheet" type="text/css" />-->




<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">-->
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <!--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>-->
  <!--<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>-->



<style type="text/css">
	



 @media (min-width: 768px) {
  #nav-img{
    height:252px;
    width:  100%;
    margin-top: -20px;
  }
  #top-nav{
  	height:236px ;
  }
  #school_address{
  	height: 94px;
  	font-size: 14px;
  }
  .form-control{

	font-size: 20px;
    }
    .form-select{
    	font-size: 15px;
    }
    #alert_success{
		height: 100px;
	}
	.flex_div{
		display: flex;
	}
	#success_img{
		height: 480px;
	}
	#sss_img{
		height: 400px;
	}
}

@media (max-width: 768px) {
  #nav-img{
    height:150px;
    width:  100%;
    margin-top: -10px;
  }
  #top-nav{
  	height:145px;
  }
  #school_address{
  	height: 150px;
  	font-size: 11px;
  }
  
   .form-control{

		font-size: 11px;
	}
	.form-select{
		font-size: 11px;
	}
	#alert_success{
		height: 150px;
	}
	#success_img{
		height: 280px;
	}
	#sss_img{
		height: 200px;
	}
}




</style>


</head>
<body>
	<div class="main">
		<nav class="navbar" id="top-nav" style="background-color: #fee588;">
		      <img src="images/Header_Banner1.webp" class="img-responsive" id="nav-img" alt="Ram Awatar Gupt Protsahan-2022" style="background-size: cover;background-repeat: no-repeat;">		 
		</nav>
		<div class="col-md-12" id="back" style="background-image: url(images/rag_website_bg.webp);">
        <div class="container rounded-3" style="background-color: #fffae6; margin-top:20px;">
	     <!--   <div class="navbar" style="text-align:center;align-content: center;align-items: center;">-->
				 
				  <!--  <img src="images/Middle_banner2.png" class="img-responsive" alt="-2022-" style="background-size: cover;background-repeat: no-repeat;height:50px;width: 100%;">-->
				  <!--  <h3 class="text-center col-md-12 section-heading sub-heading text-center py-3 text-light" style="margin-top: -50px; color: #fff;text-align: center; align-content: center; align-items: center;font-size: 26px; font-weight:700; color:#fff;width: 100%;">-2022-</h3>-->
				  
		    <!--</div>-->
		    <div class="navbar" style="text-align:center;align-content: center;align-items: center;background-color:#ae2627 ;font-size: 25px;color: #fff;">
				 
				   <!--  <img src="images/Middle_banner2.png" class="img-responsive" alt="-2022-" style="background-size: cover;background-repeat: no-repeat;height:50px;width: 100%;">
				    <h3 class="text-center col-md-12 section-heading sub-heading text-center py-3 text-light" style="margin-top: -50px; color: #fff;text-align: center; align-content: center; align-items: center;font-size: 26px; font-weight:700; color:#fff;width: 100%;">-2022-</h3> -->
				    <h3 class="text-center my-2" style="font-size:25px; font-weight:700; color:#fff;">-2022-</h3>
				  
		    </div>
			<!-- <center style="background: #ae2627;background-image: url(images/Middle_banner.png);background-size: cover;background-repeat: no-repeat;height: 50px;
                               padding: 9px 0px;">
                    </center> -->
			<div class="signup-form">
				  

				    <!---- Form area started  action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"---->
		            <form id="rag2020-form"  method="post" autocomplete="on" enctype="multipart/form-data">           
		            <!-- SECTION 1 -->
		            <div class="form-group top-section2" id="fill_section"> 			
		                <h4 class="mandatory-heading"><b>????????????????????? ?????? ????????? ???????????????????????? (<span class="main-req-col">*</span>) ?????????????????? ???????????? ?????? ??????????????????<br /><span class="mandatory-heading">REQUESTING STUDENTS TO FILL ALL MANDATORY (<span class="main-req-col">*</span>) FIELDS.</span></b></h4>
					</div>

					<?php if($display_msg){ ?>
					<div class="alert alert-success py-3 my-2" 
					id="alert_success">			
		            	<h4 class="text-center text-dark" style="font-size:20px;"><?php echo $display_msg; ?></h4>
					    <!--<h5 class="error-msg alert alert-danger"><?php //echo $error_msg; ?></h5>-->
					</div>
					<?php }?>
					<?php if($duplicate_msg){ ?>
					<div class="alert alert-danger py-3 my-2" 
					id="alert_success">			
		            	<h4 class="text-center text-dark" style="font-size:20px;"><?php echo $duplicate_msg; ?></h4>
					    <!--<h5 class="error-msg alert alert-danger"><?php //echo $error_msg; ?></h5>-->
					</div>
					<?php }?>
					 <div class="row  justify-content-center align-items-center h-100" id="success_page" style="display:none;">
					      <div class=" col-md-12 col-lg-12 col-xl-12" id="success_img">
					      	    


					          <div class="card shadow-2-strong" style="border-radius: 1rem;background-color: #fee588;">

					    
					             <img src="images/RAGLOGO_2022.webp" id="sss_img">



					            <div class="text-center col-md-12 my-5" style="align-items:center; align-content: center;text-align: center;">
											   <a href="index.php" class="px-2 mx-1 py-2 mr-md-1 rounded btn-primary text text-light" id="btn-log" style="background-color:#ae2627; text-decoration: none; color:fff;"><span class="ion-logo-facebook mr-2" style="font-size:18px;"></span><b>Back to Home</b></a>
											   <a href="index_registration.php" class="px-2 mx-1 py-2 ml-md-1 rounded btn-primary text text-light" id="btn-log" style="background-color:#ae2627; text-decoration: none; color:fff;"><span class="ion-logo-twitter mr-2" style="font-size:18px;"></span> <b>Registration Form</b></a>
									   	</div>
					           

					           

					           </div>
					         
							       
												
										
					    
											  
					        </div>
					  </div>









					<!-- SECTION 0--->
                <section id="Step-0" class="section0">
                <hr>
				<h3 class="section-heading sub-heading text-center py-3 text-light" style="background-color:#ae2627;font-size:15px; font-weight:700; color:#fff;"><span class="heading1-hindi">??????????????? ???????????? ?????????????????? ?????? ????????? ????????????</span><br/><span class="heading1-eng">STUDENT SELECT YOUR CATEGORY</span></h3>
				<hr>
                <div class="form-row">					
		            <label for="category" class="">
		            	<span class="label-hindi">???????????? ?????? ???????????????????????? ??????????????? ????????? ?</span><span class="req-col"></span><span class="req-col text-danger">*</span><br /><span class="label-eng">Are you a specially abled student ?</span>
		            </label>


                   <p class="para-hindi"><span class="req-col"></span> ????????? ??????????????? ?????? ???????????? ?????? ????????????????????? ?????? ?????????????????? ??????????????????????????? ?????? ??????????????? ???????????? ?????? , ?????? '?????????'' ?????? ????????? ???????????? (?????????????????? ????????????????????? ?????? ??????????????? ?????? ?????? ?????? ?????? 45 ??????????????? ?????? ???????????? ?????? ???????????????  ???????????? ???????????????|)</p>
				   <p class="para-eng">Select 'Yes' for children who have experienced any physical or mental challenges (The condition should have been present for a minimum of 45 days before the date of exam.)</p>

					<div class="form-group">
						<div>
							<select name="category" id="category" class="form-select" aria-label="Default select example" required>
			                   	<option value="">?????????????????? ???????????????/Select Category</option>
								<option value="Aparajay" class="option">?????????/Yes</option>
								<option value="General" class="option">????????????/No</option>								
							</select>
	
						</div>
					</div>
				</div> 
	           
					<div class="aparajay-section" style="display:none;">
						 <p class="para-hindi"><span class="req-col"></span>?????? ?????????????????? ?????? ????????? ??????????????????????????? ???????????? ?????? ????????????????????? ?????? ?????????????????? ??????????????????????????? ?????? ??????????????? ???????????? ?????? (?????????????????? ????????????????????? ?????? ??????????????? ?????? ?????? ?????? ?????? 45 ????????? ???????????? ??????????????? ???????????? ??????????????? ???)</p>
				         <p class="para-eng">For children who have experienced any physical or mental challenges (The condition should have been present for a minimum of 45 days before the date of exam.)</p>
						<div class="flex-aparajay col-md-12 bg-light">
						    <div class="form-row col-md-4">                        
			                    	<label for=""><span class="label-hindi">?????????????????????????????? ?????? ?????????  ????????????</span><span class="req-col text-danger">*</span><br><span class="label-eng">Please Select Disorder</span></label>
			                    	<div class="form-group">
									<div>   
			                    		<select name="disorder" id="disorder" class="form-select" aria-label="Default select example">
		                                	<option value="">??????????????? ???????????? ??????????????? ???????????????/Please Select Disorder</option>
											<option value="Physically Challenged" class="option">????????????????????? ???????????????/Physical Challenge</option>
											<option value="Emotionally Challenged" class="option">?????????????????? ???????????????/Mental Challenge</option>									
										</select>
										
		                            </div>
			                    </div>
							</div>	
	                        <!--- Physical select box---->
						
	                        <div class="physical-option-section col-md-4" style="display:none;">
								<div class="form-row">
								  	<label for=""><span class="label-hindi">??????????????? ????????????????????? ?????????????????? ?????? ????????? ???????????? </span><span class="req-col text-danger">*</span><br /><span class="label-eng">Please Choose Physical Challenge Undergone</span></label>
			                    	<div class="form-group">
									<div>
			                    		<select name="phy_disorder_name" id="phy_disorder" class="form-select" aria-label="Default select example">
		                                	<option value="">????????????????????? ???????????????/Physical Disorder</option>									
		                 	                <option value="Acquired brain injury">Acquired brain injury</option>
		                  	                <option value="Auditory Processing Disorder">Auditory Processing Disorder</option>
		                                    <option value="Amputation">Amputation</option>
		                                    <option value="Burn injury">Burn injury</option>
		                                    <option value="Cancer">Cancer</option>
		                                    <option value="Cerebral palsy">Cerebral palsy</option>
		                                    <option value="Cystic fibrosis (CF)">Cystic fibrosis (CF)</option>
		                                    <option value="Down Syndrome">Down Syndrome</option>
		                                    <option value="Dwarfism">Dwarfism</option>
		                  	                <option value="Epilepsy">Epilepsy</option>
		                                    <option value="Heart diseases">Heart diseases</option>
		                                    <option value="Kidney disease">Kidney disease</option>
		                                    <option value="Muscular dystrophy">Muscular dystrophy</option>
		                                    <option value="Multiple sclerosis (MS)">Multiple sclerosis (MS)</option>
		                                    <option value="Speech and language disorders">Speech and language disorders</option>
		                                    <option value="Spina bifida">Spina bifida</option>
		                                    <option value="Spinal cord injury (SCI)">Spinal cord injury (SCI)</option>
		                                    <option value="Tourettes Syndrome">Tourettes Syndrome</option>
		                                    <option value="Visual Processing Disorders">Visual Processing Disorders</option>
		                                    <option value="Others">Others</option>								
										</select>
										
		                              </div>
			                          </div>
									</div>
								</div>	
                               <!-- mental selection option ---> 
	                            <div class="mental-option-section col-md-4" style="display:none;">
									 <div class="form-row">
										
				                    	<label for=""><span class="label-hindi">??????????????? ?????????????????? ?????????????????? ??????  ????????? ???????????? </span><span class="req-col text-danger">*</span><br /><span class="label-eng">Please Choose The Mental Challenge Undergone</span></label>
				                    	  	<div class="form-group">
											<div>
					                    		<select name="mental_disorder_name" id="mental_disorder" class="form-select" aria-label="Default select example">
					                                <option value="">?????????????????? ???????????????/Mental Disorder</option> 
					                    			<option value="Adjustment disorder">Adjustment disorder</option>
					                    			<option value="Alice in wonderland syndrome">Alice in wonderland syndrome</option>
					                                <option value="Alzheimer's disease">Alzheimer's disease</option>
					                                <option value="Amnestic disorder">Amnestic disorder</option>
					                                <option value="Anxiety disorder">Anxiety disorder</option>
					                                <option value="Asperger syndrome">Asperger syndrome</option>
					                                <option value="Autism">Autism</option>
					                                <option value="Bereavement">Bereavement</option>
					                                <option value="Bipolar disorder">Bipolar disorder</option>
					                                <option value="Borderline intellectual functioning">Borderline intellectual functioning</option>
					                                <option value="Clinical Depression">Clinical Depression</option>
					                                <option value="Cognitive disorder">Cognitive disorder</option>
					                                <option value="Communication disorder">Communication disorder</option>
					                                <option value="Developmental coordination disorder">Developmental coordination disorder</option>
					                                <option value="Dissociative identity disorder">Dissociative identity disorder</option>
					                                <option value="Dyscalculia">Dyscalculia</option>
					                                <option value="Dyslexia">Dyslexia</option>
					                                <option value="Dysgraphia">Dysgraphia</option>
					                                <option value="Depression">Depression</option>
					                                <option value="Neurodevelopmental disorder">Neurodevelopmental disorder</option>
					                                <option value="Parkinson's Disease">Parkinson's Disease</option>
					                                <option value="Schizophrenia">Schizophrenia</option>
					                                <option value="Schizotypal personality disorder">Schizotypal personality disorder</option>
					                               <option value="Stereotypic movement disorder">Stereotypic movement disorder</option>
					                               <option value="Others">Others</option>
				                                </select>
											
			                              </div>                               
										</div>
			                        </div>
							    </div>
							</div>


                        <div class="apa-section-text">
	                        <p class="para-hindi">??????????????? ?????????????????? ?????? ??????????????????????????? ?????????????????? ???????????? ?????? ???????????? ????????????????????? ???????????????????????? ???????????? ??????????????? ?????? ??????????????????????????? ?????? ???????????????????????? ???????????? ?????? ?????????????????? ???????????? <span class="req-col text-danger">*</span></p>
	                        <p class="para-eng">Please write a short note on the same and attach documents supporting the above attested by your School Principal</p>
                        </div>
                        <div class="form-row">                         	                    	
	                    	<div class="form-group form-group-txtarea">
                                <label for=""></label>
	                    		<textarea  rows="4" cols="50" maxlength="550" id="disorder_detail" class="form-control" name="disorder_detail" placeholder="Write a short note about the disorder...."></textarea>
	                    	</div>
						</div>
						<div class="form-row">						
		                    	<label for=""><span class="label-hindi">??????????????? ????????????????????? ?????? ???????????? - * .pdf, * .jpg, * .png,*.jpeg,*.jfif, ?????????????????? 1 ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Please upload relevant documents file format & size - *.pdf, *.jpg, *.png,*.jpeg,*.jfif, max. 1 MB</span></label>
		                    	<div class="my-2">
								  <input type="file" id="disorder_file" name="disorder_file" class="form-control-file custom-file" accept="image/jpeg,image/jpg,image/png,application/pdf" placeholder="">
								</div>
						</div>                              
                    </div>
                     <!-- end of aparajay section --->

                  <!--  <div class="form-row">						
                      <button id="step0_button" type="button" class="button btn btn-danger btn-lg" name="step0button" value=""><b>Select</b></button>							
                   </div> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>	 -->
                  <!--  <div class="form-row">

                   <p class="button btn btn-danger btn-lg my-3">Step-2</p><hr>
                   	
                   </div> -->
                 </section> 








                   <!-- SECTION 1 -->	               
	                <section id="Step-1" class="section1">
	                	<hr>
                         <h3 class="section-heading sub-heading text-center py-3 text-light" style="background-color:#ae2627;font-size:15px; font-weight:700; color:#fff;"><span class="heading1-hindi">??????????????? ???????????????????????? ?????????????????????</span><br><span class="heading1-eng">STUDENT BASIC INFORMATION</span></h3>	 
                        <hr>                   	                    
	                    <div class="form-row">
							<div class="form-group">
	                    	   <label for=""><span class="label-hindi">????????? (????????????????????????)</span><span class="req-col text-danger">*</span><br><span class="label-eng">Name (English)</span></label>
	                    	   <input type="text" id="fname" name="fname" class="form-control"  required >                              
							</div>
		                    <div class="form-group">
		                    	<label for=""><span class="label-hindi">??????????????? (????????????????????????)</span><span class="req-col text-danger">*</span><br><span class="label-eng">Surname (English)</span></label>
		                    	<input type="text" id="lname" name="lname" class="form-control" required>                                
							</div>
						</div>
                         <div class="form-row">
	                    	<div class="form-group">
								<label for=""><span class="label-hindi">????????? (???????????????)</span><span class="req-col text-danger">*</span><br><span class="label-eng">Name (Hindi)</span></label>
	                    		<input type="text" id="hname" name="hname" class="form-control" readonly required>			                               
	                    	</div>
							<div class="form-group">
	                    	<label for=""><span class="label-hindi">??????????????? (???????????????)</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Surname (Hindi)</span></label>
	                    	<input type="text" id="hlname" name="hlname" class="form-control" readonly required>  						                          
	                    	</div>
	                    </div>						
					<div class="form-row">
					<!--- RADIO BUTTON 1ST ------>	
                    <div class="form-radio">
                    <label for="" class="radio-label"><span class="label-hindi">???????????? ???????????? ????????? ?????? ??????????????? ?????????????????? ????????? ?????? ?</span><span class="req-col text-danger">*</span><br><span class="label-eng">The name shown above in Hindi is correct?</span></label>
                    <div class="form-row d-flex">
	                    	<div class="form-radio-item mx-4">
	                    	        <label class="">
										<input type="radio" name="radHindiName" id="rad_hindi_name_yes"  class="radhname" required value="Yes" autofocus ><span class="label-hindi">?????????</span><br /><span class="label-eng">Yes</span>										
										<span class="check"></span>
										
									</label>
							</div>
							<div class="form-radio-item mx-4">
									<label class="">
										<input type="radio" name="radHindiName" id="rad_hindi_name_no" class="radhname" value="No" ><span class="label-hindi">????????????</span><br><span class="label-eng">No</span>										
										<span class="check"></span>										
									</label>									
						    </div>
	                </div>
				
					<!--- RADIO BUTTON END 1ST ------>	
	                </div>
					
                    <div class="hindi-section-name" style="display:none">
                        <p class="para-hindi">??????????????? ?????? ???????????? ????????? ?????? ???????????? ??????????????? ?????????????????? ?????? ????????????????????? ???????????? ?????? ???????????? ???????????? ?????? ??????????????? ????????????<span class="req-col text-danger">*</span></p>
                        <p class="para-eng">Please upload a scanned copy/picture of your name written clearly in Hindi on a white paper</p>
                    </div>
                    <div class="form-row hindi-section-name" style="display:none">
	                    	<label for=""><span class="label-hindi">??????????????? ????????????????????? ?????? ???????????? - *.pdf, * .jpg, * .png,*.jpeg,*.jfif, ?????????????????? 1 ????????????</span><br /><span class="label-eng">File format & size - *.pdf, *.jpg, *.png,*.jpeg,*.jfif, max. 1 MB</span></label>
	                    	<div class="form-group">
	                    		<input type="file" id="hname_file" name="hname_file" class="form-control-file" accept="image/jpeg,image/jpg,image/png,application/pdf" placeholder="">
	                    	</div>
                    </div> 
                        <!-- <div class="form-row">
						   <div class="btn-group">
                              <button id="step1_prevbutton" class="button btn btn-danger mx-2 btn-lg" type="button"  name="step1prevbutton" value="">Previous Step</button>							
                                <button id="step1_button" class="button btn btn-danger mx-2 btn-lg" type="button"  name="step1button" value="">Next Step</button>
						</div>	
                        </div><br><br> -->
                         <!-- <div class="form-row">

		                   <p class="button btn btn-danger btn-lg my-3">Step-3</p>
		                   <hr>
		                   </div>    -->                                                                                                                             
	                </section> 







	                  <!-- SECTION 2 -->
                    <section id="Step-2" class="section2">
                    	
                   <!------ Step 2 starts--->  
                     <hr>
                       <h3 class="section-heading sub-heading text-center py-3 text-light" style="background-color:#ae2627;font-size:15px; font-weight:700; color:#fff;"><span class="heading1-hindi">?????????????????????????????? ?????? ???????????? ????????? ?????????????????????</span><br /><span class="heading1-eng">STUDENT DETAILS</span></h3>
                    <hr>  
                    <div class="form-row">
	                <label for="" class="passport-text"><span class="label-hindi passport-hindi-text">??????????????? ???????????? ????????????????????? ?????? ????????? ???????????????????????? ??????????????????????????? ??????????????? ???????????? (??????????????? ????????????????????? ?????? ???????????? - * .jpg, * .png,*.jpeg,*.jfif, ?????????????????? 1 ????????????)</span><span class="req-col text-danger">*</span><br /><span class="label-eng passport-eng-text">Please attach a scanned copy of your recent passport photograph (File format & size -  *.jpg, *.png,*.jpeg,*.jfif, max. 1 MB)</span></label>
					<div class="form-group">
						<input type="file" id="student_photo_file" name="student_photo_file" class="form-control-file" accept="image/jpeg,image/jpg,image/png,application/pdf" placeholder="" required>
                    </div> 
					</div>	
                    <div class="form-row">						
						<div class="form-group">
					   <div class="form-radio">
							<label for=""><span class="label-hindi">????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Gender</span></label>
							<div class="form-row d-flex">
	                    	    <div class="form-radio-item mx-4">
		                    		<label class="male">
											<input type="radio" name="gender" id="rad_gender_male"  class="gender" value="Male" required><span class="label-hindi">???????????????</span><br /><span class="label-eng">Male</span><br>
											<span class="check"></span>
									</label>
								</div>
								<div class="form-radio-item mx-4">
									<label class="female">
										<input type="radio" name="gender" id="rad_gender_female" class="gender" value="Female" required><span class="label-hindi">???????????????</span><br /><span class="label-eng">Female</span><br>
										<span class="check"></span>
									</label>									
								</div>
								<div class="form-radio-item mx-4">
									<label class="female">
										<input type="radio" name="gender" id="rad_gender_other" class="gender" value="Other" required><span class="label-hindi">????????????</span><br /><span class="label-eng">Others</span><br>
										<span class="check"></span>
									</label>									
								</div>
	                    	</div>				
	                    </div>
						<label for=""><span class="label-hindi">???????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Date of Birth (Day-Month-Year)</span></label>
						<div class="form-group">	    
						 <input type="text"  data-date-format='dd-mm-yy' name="studob" class="form-control" id="dp1" min="2003-01-01" max="2008-12-31" placeholder="DD-MM-YYYY" 
						 onkeydown="event.preventDefault()" required autocomplete="off">
	                   </div>
 
						</div>
                        <div class="form-row">
	                    	<label for=""><span class="label-hindi">???-?????????  (????????? ?????????????????? ????????? ?????????????????? ?????????????????? ???????????????)</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Email ID (on which all communication will be done)</span></label>
	                    	<div class="form-group">
	                    		<input type="email" name="stuemail" id="stuemail"  class="form-control" placeholder="example@gmail.com" required>
	                    	</div>
	                    </div>
						<div class="form-row">
	                    	<label for=""><span class="label-hindi">?????????????????? ???????????? (????????? ?????????????????? ????????? ?????????????????? ?????????????????? ???????????????)</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Mobile Number (on which all communication will be done)</span></label>
	                    	<div class="form-group">
	                    		<input type="number" name="stumobile" id="stumobile" pattern="[0-9]{10}" maxlength="10" class="form-control student_mobile1" required>
	                    	</div>
	                    </div>	
                         <div class="form-row">
						 <div class="btn-group my-3">
							<!-- <button id="step2_prevbutton" class="button btn btn-danger mx-2 btn-lg" type="button"  name="step2prevbutton" value="">Previous Step</button> -->
							<button id="step2_button" class="button btn btn-danger mx-4 btn-lg" type="button"  name="step2button" value="">Next Step</button> 
						 </div>	
                        </div>				
                    </section>







                       <!-- SECTION 3 --> 
                    <section id="Step-3" class="section3">

                	

                    <hr>
               	
                  
                        <h3 class="section-heading sub-heading text-center py-3 text-light" style="background-color:#ae2627;font-size:15px; font-weight:700; color:#fff;"><span class="heading1-hindi">??????????????? ??? ????????????????????? ?????? ???????????? ????????? ?????????????????????</span><br /><span class="heading1-eng">SCHOOL & EXAM DETAILS</span></h3>
                    <hr>
					<div class="form-row d-flex">						
						
					    <div class="form-group col-md-6">
					    	<label for=""><span class="label-hindi">???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Class</span></label>
							<div class="form-radio d-flex">	                    	
		                    	<div class="form-radio-item mx-4">	                    		
										<label class="">
											<input type="radio" name="stuclass" id="class-10"  class="stuclass" value="Class-10">Class 10<br />
											<span class="check"></span>
										</label>
								</div>
								<div class="form-radio-item mx-4">		
											<label class="">
											<input type="radio" name="stuclass" id="class-12" class="stuclass" value="Class-12">Class 12<br>
												<span class="check"></span>
											</label>									
								</div>
		                    </div>
	                     </div>
	                     
	                    
					     
		                					
	                </div> 
	                <div class="form-row"> 

	                	<div class="form-group">
	                    	<label for=""><span class="label-hindi">??????????????? ???????????? ??????????????? ?????????????????? ???????????? ?????? ????????????????????? ???????????? ?????? ??????????????? ??????????????? ???????????? (??????????????? ????????????????????? ?????? ???????????? - * .pdf, * .jpg, * .png,*.jpeg,*.jfif, ?????????????????? 1 ????????????)</span><span class="req-col text-danger">*</span><br><span class="label-eng">Upload a scanned copy/picture of your Board Admit Card (File format & size - *.pdf, *.jpg, *.png,*.jpeg,*.jfif,  max. 1 MB)</span></label>
	                    	<div class="form-group">
	                    		<input type="file" id="admit_card_file" name="admit_card_file" class="form-control-file" accept="image/jpeg,image/jpg,image/png,application/pdf" placeholder="" required>
	                    	</div>
                         </div>

	                </div>
							
                    <div class="form-row  flex_div">
						<div class="form-group col-md-6">
	                        <label for=""><span class="label-hindi"> ??????????????? ?????????????????????</span><span class="req-col text-danger">*</span><br><span class="label-eng">Board Exam Appeared For</span></label>
	                    	<div >
	                    		<select name="boardexam" class="form-select" id="boardexam" required>
	                            <option value="">???????????? ??????????????? ????????????????????? ?????? ????????? ????????????/Select Your Board Exam</option>
									<?php
					                  $sqlUserType="select * from `env_board_dtl` order by `board_name` asc";
					                  $resultUT=mysqli_query($conn,$sqlUserType);

					                  while($row=mysqli_fetch_assoc($resultUT)){
					                ?>
					                  <option value="<?php echo $row['board_name']; ?>"><?php echo $row['board_name']; ?></option>
					                <?php
					                  }
					                ?>
								</select> 
									<!-- <span class="select-icon"><i class="zmdi zmdi-caret-down"></i></span> -->
							</div>	
		                </div>
		                <div class="form-group col-md-6">
		                	<label for=""><span class="label-hindi">??????????????? ????????????????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Board Roll Number</span></label>
						    <input type="text" id="boardrollnumber" name="boardrollnumber" class="form-control" placeholder="" required>
						</div>
								                
					
					</div>
					<!-- Location -->
							
						<div class="form-row school-section flex_div">
		                    <div class="form-group col-md-6">
		                        
									<label for=""><span class="label-hindi">????????????????????????????????? (????????????????????? ?????????????????????)</span><span class="req-col text-danger">*</span><br><span class="label-eng">Registering For (Location)</span></label>
									<div class="">
										<select name="location" id="location" class="form-select" required>
		                                <option value="">???????????? ??????????????? ???????????????/Select Your Location</option>
											<?php
							                  $sqlUserType="select * from `env_locations` order by `id` asc";
							                  $resultUT=mysqli_query($conn,$sqlUserType);
							                  while($row2=mysqli_fetch_assoc($resultUT)){
							                ?>
												<option value="<?php echo $row2['location_name']; ?>"><?php echo $row2['location_name']; ?></option>
							                <?php
							                }
							                ?>
										</select>
										<!-- <span class="select-icon"><i class="zmdi zmdi-caret-down"></i></span> -->
									</div>	
									
		                        
		                       
		                    </div>
		                    <div class="form-row col-md-6">
			                       		
			                    					   
			                    	<label for=""><span class="label-hindi">???????????? ???????????????????????? ?????? ????????? ?????????????????? ???????????? ??????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">What is the medium of instruction in your school</span></label>
			                    	<div class="form-group">
										<div >

											<select id="school_medium" name="school_medium"  class="schoolmedium form-select" required>
			                                <option value="">??????????????? ?????????????????? ?????? ????????? ????????????/Select School Medium</option>									
			                                <option value="Hindi Medium">??????????????? ?????????????????? | Hindi Medium</option>
			                                <option value="English Medium">???????????????????????? ?????????????????? | English Medium<br></option>
			                                <option value="Bengali Medium">?????????????????? ?????????????????? | Bengali Medium</option>
			                                 <option value="Others">???????????? | Others</option>
			               		            </select>
											<!-- <span class="select-icon"><i class="zmdi zmdi-caret-down"></i></span> -->
										</div>	
								    </div>			

				                    
			                    </div>		
		                    
		                        
		                        
		                </div>
							

                     <!---school name ---->
							<div class="form-row school-section flex_div">
		                    	<div class="form-group col-md-6">
		                    	    
									<label for=""><span class="label-hindi">??????????????? ?????? ???????????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">School Full Name</span>
										<div class="popup" onclick="myFunction()"><!--Click me!-->
										    <span class="popuptext" id="myPopup">????????? ???????????? ???????????????????????? ?????? ????????? ???????????? ?????? ?????? ???????????? ????????? ???????????? ?????? , ?????? ??????????????? ???????????? ?????? ????????? ???????????? ?????? ??????????????? ?????????????????? ????????? ???????????? ????????????| /If your school name does not appear in the below list, then please select 'Others' and enter in the input field.</span>
										</div> 							
									</label>
			                    	<div class="">



			                    		<!--<label for=""><span class="label-hindi">??????????????? ?????? ???????????? ?????????</span><span class="req-col">*</span><br><span class="label-eng">Other School Name</span></label>-->
		                    	        <!-- <input type="text" id="schoolname" name="schoolname" class="form-control" required>	 -->


				                            <select id="schoolname"  name="schoolname" class="form-control form-select" required="">							
				                            <!-- <option value="">???????????? ??????????????? ?????? ????????? ???????????????/Select Your School Name</option> -->
												<?php
					                  				// $sqlUserType="select * from `school_list` order by `school_name` asc";
					                  				// $resultUT=mysqli_query($conn,$sqlUserType);
					                  				// while($row=mysqli_fetch_assoc($resultUT)){
					               				?>
					               				 <!-- <option value="<?php //echo $row['school_name']; ?>"><?php //echo $row['school_name']; ?></option> -->
					               				
					              			  <?php
					               			// } ?> 
					               			 <!-- <option value="others">OTHERS</option> -->
					               			                     
				               			 </select>
    								  
								   </div>
								   
		                       </div>
		                       <div class="form-group col-md-6">
		                        
		                        
		                        
								<label for=""><span class="label-hindi">??????????????? ?????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">School Address</span></label>
	                            <!--<input type="text" id="school_address" class="form-control" name="school_address" required>-->
							     <textarea maxlength="200" id="school_address" class="form-control" name="school_address"  required="" readonly></textarea>
		                  
		                        
		                        
		                        
		                       </div>

                                				
						</div>
							
					 
                       <div class="other-school-section" style="display:none">
						    <div class="form-row col-md-12 flex_div"> 
						        <div class="form-group col-md-6">
									<label for=""><span class="label-hindi">????????? ??????????????? ?????? ???????????? ?????????</span><span class="req-col text-danger">*</span><br><span class="label-eng">New School Name</span></label>
			                    	<input type="text" id="other_school_name" name="other_school_name" class="form-control" required="">							
		                    	</div>
								<div class="form-group col-md-6">
		                    	    <label for=""><span class="label-hindi">????????? ??????????????? ?????? ?????????</span><span class="req-col text-danger">*</span><br><span class="label-eng">New School Address</span></label>
		                    	    <textarea id="other_school_address" class="form-control" name="other_school_address" maxlength="300" style="height: 18px;" required=""></textarea>
		                    	</div>
		                    </div>
						</div>                       
                       
                        <!---- MARKS BLOCK ----->  
                        <div>
                        	
                        </div> 


                        <!-- Marks section for previous and current year --->
                        <div class="marks-block-1" style="display:none">
                       							
                        <div class="form-group row">
                        	 <p id="mark-text-para-1" class="para-hindi"></p>
                        	<div class="form-row col-md-12 d-flex">
								<div class="col-md-6">
		                    	   <label for=""><span class="label-hindi">?????????????????? ???????????? </span><span class="req-col text-danger">*</span><br /><span class="label-eng">1st Term</span></label>
		                    	   <input type="number" id="last_year_marks1" name="last_year_marks1" onkeypress="return isNumberThree(this,event)"  maxlength="3" min="0" max="100" class="form-control" required="">
		                        </div>
								<div class="col-md-6">
		                    	   <label for=""><span class="label-hindi">??????????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">2nd Term</span></label>
		                    	   <input type="number" id="last_year_marks2" name="last_year_marks2" onkeypress="return isNumberThree(this,event)"  maxlength="3" min="0" max="100" class="form-control" required="">
		                        </div>
								<!-- <div class="col-xs-2 col-md-4">
		                   	       <label for=""><span class="label-hindi">??????????????? ????????????</span><span class="req-col">*</span><br /><span class="label-eng">3rd Term</span></label>
		                    	   <input type="text" id="last_year_marks3" name="last_year_marks3" onkeypress="return isNumberThree(this,event)"  maxlength="3" min="0" max="100" class="form-control" required="">
		                        </div> -->
		                    </div>
		                    <!--  <div class="col-xs-2 popup" onclick="myFunction2()"><br><br>Click me!-->
							<!--    <span class="popuptext" id="myPopup2">????????? ???????????? ???????????????????????? ????????? ???????????? 2 ?????? ???????????? ???????????? ????????? ?????? ??????????????? ???????????? ?????? ?????????  ?????? ????????????????????? ??????????????? (0) ??????????????? / Fill in your marks or percentage as 0 in case you don't have 3rd term examinations in your school.</span>-->
							<!--</div>-->
							
	                   </div>
                       </div>  
                        <div class="marks-block-2" style="display:none">
                        <p id="mark-text-para-2" class="para-hindi"></p> 
	                        <div class="form-group row">
	                        	<div class="form-row col-md-12 d-flex">
									<div class="col-md-4">
			                    	   <label for=""><span class="label-hindi">?????????????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">1st Term</span></label>
			                    	   <input type="number" id="current_year_marks1" name="current_year_marks1" onkeypress="return isNumberThree(this,event)" maxlength="3" min="0" max="100" class="form-control" required="">
			                        </div>
									<div class="col-md-4">
			                    	   <label for=""><span class="label-hindi">??????????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">2nd Term</span></label>
			                    	   <input type="number" id="current_year_marks2" name="current_year_marks2" onkeypress="return isNumberThree(this,event)" maxlength="3" min="0" max="100" class="form-control" required="">
			                        </div>
									<div class="col-md-4">
			               	              <label for=""><span class="label-hindi">???????????? ???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Pre-Board</span></label>
			               	              <input type="number" id="current_year_preboards" name="current_year_preboards" onkeypress="return isNumberThree(this,event)" maxlength="3" min="0" max="100" class="form-control" required="">
			                      </div> 
			                    </div>
		                   </div>
                       </div>                      
                        <!---- END ----->		 
                        <!-- <div class="form-row">
						    <div class="btn-group">
                              <button id="step3_prevbutton" class="button btn btn-danger mx-2 btn-lg" type="button"  name="step3prevbutton" value="">Previous Step</button>
                              <button id="step3_button" class="button btn btn-danger mx-2 btn-lg" type="button"  name="step3button" value="">Next Step</button> 
						    </div>
                         </div> 	<br>   -->     
                         <!-- <div class="form-row">

		                   <p class="button btn btn-danger btn-lg my-3">Step-5</p><hr>
		                   	
		                   </div>    -->  
		                    <div class="School_teacher_details" >
							    <div class="form-row col-md-12 flex_div"> 
							        <div class="form-group col-md-6">
										<label for=""><span class="label-hindi">??????????????? ?????????????????? ?????? ?????????</span><span class="req-col text-danger">*</span><br><span class="label-eng">Hindi Teacher Name</span></label>
				                    	<input type="text" id="hindi_Teacher_name" name="hindi_Teacher_name" class="form-control" required>							
			                    	</div>
									<div class="form-group col-md-6">
			                    	    <label for=""><span class="label-hindi">??????????????? ?????????????????? ?????????????????? ????????????</span><span class="req-col"></span><br><span class="label-eng">Hindi Teacher Mobile Number</span></label>
			                    	    <input id="hindi_teacher_mobile" type="number" class="form-control student_mobile2" pattern="[0-9]{10}" maxlength="10" name="hindi_teacher_mobile">
			                    	</div>
			                    </div>
						    </div>  
						    <div>
	                     		<hr>
	                     	</div> <br><br><br>                                         	
                     </section>
















                     <!--- Section 4 ----->
                     <section id="Step-4" class="section4">
                     	<div>
                     		<hr>
                     	</div>
                     	<hr>
		                   <h3 class="section-heading sub-heading text-center py-3 text-light" style="background-color:#ae2627;font-size:15px; font-weight:700; color:#fff;"><span class="heading1-hindi">????????????????????? ?????????????????????</span><br/><span class="heading1-eng">GUARDIAN DETAILS</span></h3> 
		                <hr>
		                <div class="form-row col-md-12  flex_div">
								<div class="form-group col-md-4">
		                    	    <label for=""><span class="label-hindi">????????????????????? ?????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Parent / Guardian Name</span></label>
		                    	    <input type="text" id="parent_name" name="parent_name" class="form-control" required>
		                    	</div>
								<div class="form-group col-md-4">
								   <label for=""><span class="label-hindi">????????????????????? ?????? ????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Parent / Guardian Mobile Number</span></label>
		                    	   <input type="number" name="parentmobile" id="parentmobile" pattern="[0-9]{10}" maxlength="10" class="form-control student_mobile3" required>
		                    	</div>
		                    	<div class="form-group col-md-4">
			                         <label for=""><span class="label-hindi">??????????????????????????? ?????????????????? ????????????</span><br /><span class="label-eng">Emergency Mobile Number</span></label>
			                         <input type="number" name="emergency_landline" pattern="[0-9]{10}" maxlength="10" id="emergency_landline"  class="form-control student_mobile4" placeholder="Emergency Phone Number">
		                         </div>
		                </div>
		                
                        <div class="form-row col-md-12  flex_div">
                        	<div class="form-group col-md-4">
							     <label for=""><span class="label-hindi">????????????????????? ?????? ???-?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Parent / Guardian Email ID</span></label>
		                         <input type="email" name="parent_email" id="parentemail" class="form-control" placeholder="example@gmail.com" required>
		                    </div>
							<div class="form-group col-md-4">
		                    	<label for=""><span class="label-hindi">?????????????????? ?????? ????????????????????? ??????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Annual Family Income</span></label>
		                    	<div class="">
		                    		<select name="family_income" id="family_income" class="familyincome form-select" required>
	                                <option value="">?????????????????? ?????? ????????????????????? ??????/Family Annual Income</option>									
	                                <option value="below 2.5 lakhs">2,50,000 ?????? ?????? | BELOW 2,50,000</option>
	                                <option value="between 2.5lakhs-5lakhs">2,50,000 ??? 5,00,000 ?????? ????????? | BETWEEN 2,50,000 ??? 5,00,000</option>
	                                <option value="above 5lakhs">5,00,000 ?????? ???????????? | ABOVE 5,00,000</option>
	               		            </select>                                
									<!-- <span class="select-icon"><i class="zmdi zmdi-caret-down"></i></span> -->
		                    	</div>
		                    </div>
							<div class="form-group col-md-4">
		                    	<label for="">
		                    	<span class="label-hindi">????????????????????? ?????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Parent / Guardian Address</span>
		                    	</label>	                    	
		                    	<textarea  rows="2" cols="50" maxlength="200" id="home_address" class="form-control" name="home_address" placeholder="Enter Your Address" required></textarea>
		                    </div>
						</div>
							
	                    
                        <div class="form-row col-md-12  flex_div">
						    <div class="form-group col-md-4">
	                    	  <label for=""><span class="label-hindi">?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">City</span></label>
	                    	  <input type="text" id="city" name="city" class="form-control" required>
	                    	</div>
							<div class="form-group col-md-4">
	                    	    <label for=""><span class="label-hindi">????????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Pincode</span></label>
	                    	   <input type="number" id="pincode" name="pincode" class="form-control" maxlength="6" required>
	                        </div>						
						    <div class="form-group col-md-4">
	                    	    <label for=""><span class="label-hindi">???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">State</span></label>
	                    	    <div class="">
	                    		<select name="state" id="state" class="state form-select" required="required">
	                                <option value="">???????????? ??????????????? ???????????????/Select Your State</option>									
	                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
	                                <option value="Andhra Pradesh">Andhra Pradesh</option>
	                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
	                                <option value="Assam">Assam</option>
	                  				<option value="Bihar">Bihar</option>
	                  				<option value="Chandigarh">Chandigarh</option>
	                  				<option value="Chhattisgarh">Chhattisgarh</option>
	                 				<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
	                  				<option value="Daman and Diu">Daman and Diu</option>
	                  				<option value="Delhi">Delhi</option>
	                  				<option value="Goa">Goa</option>
	                 				<option value="Gujarat">Gujarat</option>
	                 				<option value="Haryana">Haryana</option>
	                 				<option value="Himachal Pradesh">Himachal Pradesh</option>
	                 				<option value="Jammu and Kashmir">Jammu and Kashmir</option>
	                 				<option value="Jharkhand">Jharkhand</option>
	                 				<option value="Karnataka">Karnataka</option>
	                 				<option value="Kerala">Kerala</option>
	                 				<option value="Lakshadweep">Lakshadweep</option>
	                 				<option value="Madhya Pradesh">Madhya Pradesh</option>
	                				<option value="Maharashtra">Maharashtra</option>
	                  				<option value="Manipur">Manipur</option>
	                 				<option value="Meghalaya">Meghalaya</option>
	                  				<option value="Mizoram">Mizoram</option>
	                  				<option value="Nagaland">Nagaland</option>
	                  				<option value="Odisha">Odisha</option>
	                  				<option value="Pondicherry">Pondicherry</option>
	                 			    <option value="Punjab">Punjab</option>
	                 		        <option value="Rajasthan">Rajasthan</option>
	                  				<option value="Sikkim">Sikkim</option>
	                 				<option value="Tamil Nadu">Tamil Nadu</option>
	                  				<option value="Telangana">Telangana</option>
	                 				<option value="Tripura">Tripura</option>
	                 				<option value="Uttar Pradesh">Uttar Pradesh</option>
	                  				<option value="Uttarakhand">Uttarakhand</option>
	                  				<option value="West Bengal">West Bengal</option>
               		            </select>                                
								<!-- <span class="select-icon"><i class="zmdi zmdi-caret-down"></i></span> -->
	                    	    </div>
	                        </div>                        
	                    </div>                        
                        <div class="form-row col-md-12  flex_div">
						    <div class="form-group col-md-6">
	                    	   <label for=""><span class="label-hindi">?????????????????? ???????????????</span><br /><span class="label-eng">Facebook Handle</span></label>
	                    	   <input type="text" id="facebook_handle" name="facebook_handle" class="form-control">
	                    	</div>
							<div class="form-group col-md-6">
	                    	    <label for=""><span class="label-hindi">????????????????????????????????? ???????????????</span><br /><span class="label-eng">Instagram Handle</span></label>
	                    	    <input type="text" id="twitter_handle" name="twitter_handle" class="form-control">
	                    	</div>
	                    </div>
	                    <hr>
                        <!-- <div class="form-row">
						    <div class="btn-group">
		                        <button id="step4_prevbutton" class="button btn btn-danger  mx-2 btn-lg" type="button"  name="step4prevbutton" value="">Previous Step</button>
		                        <button id="step4_button" class="button btn btn-danger  mx-2 btn-lg" type="button"  name="step4button" value="">Next Step</button>
						    </div>	
                        </div><br><br><br><br><br><br> -->
                      
                     </section> 






                      <!--- Section 5 ----->
                    <section id="Step-5" class="section5">
                    	
						<!-- <div class="form-row hawker-text-hindi">
						<span class="label-hindi">??????????????? ???????????? ???????????? ???????????????????????? ?????????????????? ???????????? ???????????????????????? ???????????? ?????? ???????????? ?????? ???????????? ?????? ????????? ?????? ?????????????????? ???????????? ???????????????</span>
						</div>
						<div class="form-row hawker-text-eng">
						<span class="label-eng">Please only where sanmarg newspaper get circulated fill hawker name and contact number below</span>
						</div>		 -->				
       <!--                 <div class="form-row col-md-12 d-flex">-->
							<!--<div class="form-group col-md-6">-->
	      <!--              	   <label for=""><span class="label-hindi">???????????? ?????? ?????????</span><span class="req-col">*</span><br /><span class="label-eng">Hawker Name</span></label>-->
	      <!--              	   <input type="text" id="hawker_name" name="hawker_name" class="form-control">-->
	      <!--              	</div>-->
							<!--<div class="form-group col-md-6">-->
	      <!--              	   <label for=""><span class="label-hindi">???????????? ?????? ?????????????????? ????????????</span><span class="req-col">*</span><br /><span class="label-eng">Hawker mobile number</span></label>-->
	      <!--              	   <input type="tel" name="hawker_telephone" id="hawker_telephone" pattern="[0-9]{10}" maxlength="10" class="form-control">-->
	      <!--              	</div>-->
	      <!--              </div> -->
                        <div class="form-row">
							<div class="btn-group">
		                        <button id="step5_prevbutton" class="button btn btn-danger mx-2 btn-lg my-3" type="button" name="step5prevbutton" value="">Previous Step</button>
		                        <button id="step5_button" class="button btn btn-danger mx-2 btn-lg my-3" type="button" name="step5button" value="">Next Step</button>
							</div>	
                        </div>             
                    </section>





                       <!--- Section-5 end --->
                    <section id="Step-6" class="section6">
                    	<hr>
                    	
	                        <h3 class="section-heading sub-heading text-center py-3 text-light" style="background-color:#ae2627;font-size:15px; font-weight:700; color:#fff;"><span class="heading1-hindi">???????????? ?????????????????????</span><br /><span class="heading1-eng">OTHER DETAILS</span></h3>
	                    <hr>
	                    
                        <div class="form-row">							
	                    	<label for=""><span class="label-hindi">???????????? ????????? ??????????????? ??????????????? ?????????????????????????????? 2022 ?????? ???????????? ????????? ???????????? ????????? ??????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">How did you get to know about Ram Awatar Gupt Protsahan 2022?</span></label>
	                    	<div class="form-group">
								<div class="">
		                    		<select name="ragaward_source" id="ragaward_source" class="ragawardsource form-select" required>
	                                <option value="">??????????????? ???????????????/Select Source</option>									
	                                <option value="Sanmarg Newspaper">????????????????????????/Sanmarg Newspaper</option>
									<option value="Sanmarg Epaper">???????????????????????? ???- ????????????/Sanmarg E-paper</option>
	                                <option value="School">????????????????????????/School</option>
	                                <option value="Social Media">???????????? ??????????????????/Social Media</option>
	                                <option value="Others">????????????/Others</option>
	               		            </select>                                
									<!-- <span class="select-icon"><i class="zmdi zmdi-caret-down"></i></span> -->
		                    	</div>                           
	                        </div>
						</div>	
                        <div class="form-row ragaward_source_other" style="display:none">
	                    	<label for=""><span class="label-hindi">????????? ???????????? ???????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">If Others Selected</span></label>
	                    	<div class="form-group">
	                    		<input type="text" id="ragaward_source_other" name="ragaward_source_other" class="form-control" required="">
	                    	</div>
	                    </div>
						
						<div class="form-row">
	                    	<label for=""><span class="label-hindi">???????????? ?????? ???????????????????????? ??????????????? ??????????????? ?????? ?????????????????? ???????????? ??????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Are you a regular reader of Sanmarg Hindi Daily?</span></label>
	                    	<div class="form-radio d-flex">
	                    		<div class="form-radio-item mx-4">
									<label class="">
										<input type="radio" name="sanmarg_reader" id="sanmarg_reader_yes"  class="sanmarg_reader" value="Yes" required>????????? <br />Yes<br>
										<span class="check"></span>
									</label>
								</div>	
								<div class="form-radio-item mx-4">	
									<label class="">
										<input type="radio" name="sanmarg_reader" id="sanmarg_reader_no" class="sanmarg_reader" value="No">????????????<br />No<br>
										<span class="check"></span>
									</label>									
								</div>
	                    	</div>
	                    </div>
                    	
                   <!--- Section 6 ----->
                    <hr>
                       <h3 class="section-heading sub-heading text-center py-3 text-light" style="background-color:#ae2627;font-size:15px; font-weight:700; color:#fff;"><span class="heading1-hindi">???????????????????????? ?????? ???????????? ????????? ?????????????????????</span><br /><span class="heading1-eng">AWARD DETAILS</span></h3>
                    <hr>

                     <div class="form-row  ragparticipated" style="display:none" style="margin-bottom: 50px;">
						<div class="form-radio">
	                    	<label for="" class="radio-label"><span class="label-hindi">???????????? ???????????? ????????? ??????????????? ??????????????? ????????????????????? ???????????????????????? ?????? ????????? ??????????????? 10 ????????? ?????????  ???????????? ???????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Did you participate in Ram Awatar Gupt Pratibha Puraskar in class 10?</span></label>
	                    	<div class="form-row d-flex">
		                    	<div class="form-radio-item mx-4">
										<label class="">
											<input type="radio" name="rag_participated_chk" id="rag_participated_yes"  class="rag-participated" value="Yes">????????? <br>Yes<br>
											<span class="check"></span>
										</label>
								</div>
								<div class="form-radio-item mx-4">		
									<label class="">
										<input type="radio" name="rag_participated_chk" id="rag_participated_no" class="rag-participated" value="No">????????????<br>No<br>
										<span class="check"></span>
									</label>									
								</div>
							</div>
	                    </div>
	               </div>
                    
				   <!--- ANKUR BLOCK ---->
				   <div class="form-row">							
	                    	<label for=""><span class="label-hindi">    ??????????????? ???????????????????????? - ???????????? ???????????? ???????????? ?????????????????????????????????????????? (extra-curricular) ??????????????? ?????????????????????????????? ????????? ????????? ???????????? ?????? ?
                            </span><span class="req-col text-danger">*</span><br /><span class="label-eng">Ankur Award-Have you done any exceptional work or participated in any competition (interschool or others) related to Hindi?</span></label>
	                    	<div class="form-group">
							<div class="">
	                    		<select name="ankur" id="ankur_option" class="ankur_option form-select" required>
                                <option value="" selected >?????????????????? ???????????????/Select Your Option</option>									
                                <option value="Yes">?????????/Yes</option>
                                <option value="No">????????????/No</option>                                
               		            </select>                                
								<!-- <span class="select-icon"><i class="zmdi zmdi-caret-down"></i></span> -->
	                    	</div>                           
							</div> 
					</div>
				   <div class="ankur-option-section" style="display:none" style="margin-bottom: 50px;">
	                   <div class="ankur-activity-block"> <!-- block started--->                    
		                    <p class="para-hindi">??????????????? ??????????????? 2018 ?????? ??????????????? 2022 ?????? ????????? ??????????????? ?????? ????????????????????? ????????? ???????????? ?????????????????? ????????? ?????? ????????????????????????  ????????????????????? ?????? 200 ???????????? ???????????????<span class="req-col text-danger">*</span></p>                  
		                    <p class="para-eng">Please write 200 words on extracurricular work done in the field of Hindi between March 2018 - 2022</p>               
	                    </div>
	                    <div class="ankur-activity-block">                      
		                    <div class="form-row">	                    	
			                    	<div class="form-group form-group-txtarea">
			                    		<textarea  rows="4" cols="50" maxlength="550" id="ankur_activity_textwork" class="form-control" name="ankur_activity_textwork" placeholder="Enter Your Work in 200 words.."></textarea>
			                    	</div>
			                </div>                    
		                    <p class="para-hindi">??????????????? ?????????????????? ???????????? ???????????????????????? ????????????????????? ?????? ????????????????????? ???????????????????????? ?????? ????????????????????? ???????????? ?????? ??????????????? ??????????????? ???????????? <span class="req-col text-danger">*</span></p>                  
		                    <p class="para-eng">Please attach a scanned copy or picture
		                     of documents supporting the above mentioned extracurricular activities</p>
		                     <div class="form-row">
			                    	<label for=""><span class="label-hindi">??????????????? ????????????????????? ?????? ???????????? <span class="req-col text-danger">*</span> - * .pdf, * .jpg, * .png,*.jpeg,*.jfif, ?????????????????? 1 ????????????</span><br /><span class="label-eng">Upload relevant documents file format & size - *.pdf, *.jpg, *.png,*.jpeg,*.jfif, max. 1 MB</span></label>
			                    	<div class="form-group">
			                    		<input type="file" id="ankur_activity_file" name="ankur_activity_file" class="form-control-file" accept="image/jpeg,image/jpg,image/png,application/pdf" placeholder="">
			                    	</div>
		                    </div>
		                    
                        </div><!--- block ends ---->
					</div><!--- ankur section --->

                  <!--  <section class="student_skill" style="display:none;">
					<div class="form-row">
					<hr>
					  <h3 class="section-heading sub-heading text-center"><span class="heading1-hindi">???????????????????????? ???????????????????????????</span><br /><span class="heading1-eng">Additional Details</span></h3>
					  <hr>
					
						
					    <p class="para-eng"><span class="label-eng">We have changed the application process to make it more holistic. Students need to select only one of the three options namely ???<b>Academic skills</b>,<b>Oratory skills</b> and <b>Written skills</b> on the basis of which their performance will be reviewed.</span></p>
					    <p class="para-hindi"><span class="label-hindi">???????????? ????????????????????? ?????? ???????????????????????? ????????????????????? ?????????????????? ?????? ??????????????????????????? ??????,  ??????????????? ?????? ??????????????????????????? ?????? ????????? ???????????? ?????? ??? ??????????????? ?????????????????? ???????????? ?????? 3 ???????????????????????? ????????? ?????? ????????????????????? ?????? ???????????? 1 ?????????????????? ?????? ??????????????? ???????????? ??? ?????? ?????????????????? ??????????????? - <b>????????????????????? ?????????????????????</b>, <b>??????????????? ?????????????????????</b> ????????? <b>???????????? ?????????????????????</b> ??? ?????????????????? 3 ??????????????????????????? ?????? ???????????????????????? ?????? ????????????????????? ?????? ???????????????-???????????? ?????????????????? ??? </span></p>

					    
					    <p class="para-eng"><span class="label-eng"><b>Academic Skills:</b> Selection will be done based on Hindi board marks cut-off set by the Jury for each board. Students with marks above the cut-off will be awarded a certificate of merit. Top 2 from each board will be awarded on stage at the finale.</span></p>
					    <p class="para-hindi"><span class="label-hindi"><b>????????????????????? ????????????????????? :</b> ???????????????????????? ??????????????? ?????? ?????????, ???????????????????????? ?????? ??????????????????, ??????????????? ????????? ????????????????????? ?????????????????? ?????? ??????????????? ?????? ???????????? ??????????????????????????? ??????-?????? ?????? ???????????? ?????? ?????? ????????????????????? ?????? ????????? ???????????? ?????????????????? ??? ??????-?????? ?????? ???????????? ????????? ????????????????????? ???????????? ???????????? ????????????????????? ?????? '????????????????????? ?????????????????? ????????????' ?????? ???????????????????????? ???????????? ?????????????????? ??? ???????????????????????? ??????????????? ?????? 2 ????????????????????? ????????????????????? ?????? ?????????????????? ?????? ??????????????? ????????? (???????????????) ????????? ????????? ?????? ???????????????????????? ?????? ???????????? ?????????????????? ???   </span></p>


					    <p class="para-eng"><span class="label-eng"><b>Oratory Skills:</b> Pass mark required in Hindi board examination. Students will be given a topic on which they will need to speak for 1 minute. This will be held physically before the finale at 3 venues amongst which student will have to select his preferred venue for the competition. A 3-member special committee comprising of Hindi teachers will judge the competition and select 3 winners from each venue.  They will be awarded on stage at the finale.</span></p>
					    <p class="para-hindi"><span class="label-hindi"><b>??????????????? ????????????????????? :</b> ?????? ????????????????????? ?????? ?????????, ??????????????? ?????? ????????????????????? ????????? ?????????????????? ????????? ???????????????????????? ????????????????????? ?????? ?????? ???????????????????????? ?????????????????? ??? ????????????????????? ????????????????????? ?????? ?????? ???????????? ???????????? ?????????????????? ??????????????? ?????????????????? 1 ???????????? ?????? ???????????? ????????? ??????????????? ???????????? ??? ????????????????????? ?????? ??????????????? ????????? ?????? ????????????, ????????????????????????????????? ????????? ?????????, ????????????????????? ?????? ????????????????????? ?????? ???????????????????????? ?????? ????????????, ????????????????????? ?????? 3 ?????????????????? ????????????????????? ?????? ?????????????????? ???????????? ????????????????????? ?????????????????? ?????? 1 ?????????????????? ?????? ????????? ??????, ?????? ???????????? ????????? ??????????????? ?????? ???????????????????????? ???????????? ?????????????????? ???????????? ??????????????????????????? ???????????? ???????????? ??? ?????? ????????????????????? ?????? ???????????????, 3 ???????????????????????? ?????? ??????????????? ?????? ???????????? ???????????? ?????????????????? ?????? ???????????????????????????????????? ?????? ?????????????????? ?????? ???????????????????????? ?????????????????? ??????????????? ?????? 3 ???????????????????????? ?????? ??????????????????, ????????????????????? ?????????????????? ?????? ??????????????? ????????? (???????????????) ????????? ????????? ?????? ???????????????????????? ?????? ???????????? ?????????????????? ???  </span></p>



					    <p class="para-eng"><span class="label-eng"><b>Written Skills:</b> Pass mark required in Hindi board examination. A topic will be provided on the basis of which students need to write a 200-word essay. The essay will need to be submitted online when the student submits their board marks. 1 Student will be chosen from each class and board and will be awarded on stage at the finale.</span></p>
					    <p class="para-hindi"><span class="label-hindi"><b>???????????? ????????????????????? :</b>  ?????? ????????????????????? ?????? ????????? ??????, ??????????????? ?????? ????????????????????? ????????? ?????????????????? ????????? ???????????????????????? ????????????????????? ?????? ?????? ???????????????????????? ?????????????????? ??? ????????????????????? ????????????????????? ?????? ?????? ???????????? ???????????? ?????????????????? ??????????????? ?????????????????? 200 ?????????????????? ?????? ???????????? ?????????????????? ????????? ?????? ????????????????????? ??????????????? ???????????? ??? ?????? ????????????????????? ?????????????????? ???????????? ??????????????? ?????? ??????????????????????????? ????????? ???????????? ???????????? ?????????????????? ??????????????? ???????????? ???????????? ??? ???????????????????????? ??????????????? ?????? 10????????? ??????????????? ?????? 1 ????????? 12????????? ??????????????? ?????? 1 ??????????????? ?????? ???????????? ?????????????????? ?????? ?????????????????? ?????? ??????????????? ????????? (???????????????) ????????? ????????? ?????? ?????????????????? ???????????????????????? ?????? ???????????? ?????????????????? ???  </span></p>

					    <p class="para-eng"><span class="label-eng">At the finale the Top 3 from each category will compete for the title of <b>'Hindi ki Shaan'</b> and win a <b>scholarship of Rs 1,00,000*</b></span></p>
				        <p class="para-hindi"><span class="label-hindi">?????????????????? ?????? ??????????????? ????????? (???????????????) ?????????, ???????????????????????? ?????????????????? ?????? ??????????????? 3 ????????????????????? ??????????????? <b>'?????????????????? ?????? ?????????'</b> ?????? ?????????????????? ????????????????????? ???????????? ?????? ???????????? ????????????????????????????????? ?????????????????? ?????? ?????? ?????????????????? ????????? ????????????????????? ???????????? <b>'?????? ????????? ??????????????? ?????? ?????????????????????????????????'</b>???</span></p>

					  
					</div>
					
					<div class="form-row">
                       <hr>
						<div class="form-row">							
	                    	<label for=""><span class="label-hindi">?????????????????????????????? ??????????????? ???????????? ?????????????????? ???????????????!</span><span class="req-col">*</span><br /><span class="label-eng">Student please chose your category</span></label>
	                    	<div class="form-group">
								<div class="">
		                    		<select name="submit_type" id="submit_type" name="submit_type" class="submit_type form-select">
		                                <option value="">?????????????????? ???????????????/Select Type</option>									
		                                <option value="Academic">???????????????????????? ????????????/Academic Skill</option>
										<option value="Oratory">????????????????????? ????????????/Oratory Skill</option>
		                                <option value="Written">??????????????? ????????????/Written Skill</option>
	                              
	               		            </select>                                
								<span class="select-icon"><i class="zmdi zmdi-caret-down"></i></span>
		                     </div>                           
	                        </div>
						</div>	



						<div class="form-row date_extempore_date" style="display:none">
	                    	<label for=""><span class="label-hindi">??????????????? ?????? ???????????? ?????? ????????? ???????????? ????????? ?????? ?????????????????????????????? ???????????? ???????????? ?????????????????????</span><span class="req-col">*</span><br /><span class="label-eng">Please Select a Venue on Which Would Like To Give The Oratory!</span></label>
	                    	<div class="form-radio form-group">
	                    		<div class="form-check">
								  <input class="form-check-input" type="radio" value="10 th July,2022/Bhawanipore College MCKV Asian International School/11am-4pm" name="extempore_date_checkbox" id="extempore_date_checkbox">
								  <label class="form-check-label" for="flexCheckDefault">
								  10 ??????????????? 2022/ ???????????????????????? ??????????????? /11 am - 4 pm<br>
								  10 th July,2022/Bhawanipore College/11 am-4 pm
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input" type="radio" value="10 th July,2022/Bhawanipore College MCKV Asian International School/11am-4pm" name="extempore_date_checkbox" id="extempore_date_checkbox">
								  <label class="form-check-label" for="flexCheckChecked">
								    10 ??????????????? 2022 /??????.??????.??????.??????. ????????????????????????????????? ???????????????????????? /11 am - 4 pm<br>10 th July,2022/MCKV Engineering Institute/11 am-4 pm
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input" type="radio" value="10 th July,2022/Bhawanipore College MCKV Asian International School/11am-4pm" name="extempore_date_checkbox" id="extempore_date_checkbox">
								  <label class="form-check-label" for="flexCheckChecked">
								   10 ??????????????? 2022 /??????????????? ??????????????????????????? ???????????????/11 am-4 pm<br> 10 th July,2022/Asian International School/11 am-4 pm
								  </label>
								</div>
			                </div>
	                    </div>
                    </div>
                   </section> --> 
                    <!-- <hr>
                    <div class="form-row my-3">
                    	<div class="d-flex">
                    	 <p class="para-hindi"><span class="label-hindi">????????????????????????</span></p>
					        <p class="para-eng"><span class="label-eng">Note!</span></p> 
					        <h3 class="text-dark">Note/????????????????????????</h3>
                    	</div>
                    	
						
                    		
				        <p class="para-eng"><span class="label-eng">After submitting the form you will receive a unique <b>RAGP ID</b> and <b>password</b>. Please log in again to upload your <b>Hindi board marks</b>, <b>mark sheet</b>, and <b>written test paper</b> (where applicable). The form will be considered complete only post completion of the above.!</span></p>
				        <p class="para-hindi"><span class="label-hindi">??????????????? ????????? ???????????? ?????? ?????????, ???????????? ?????? ????????????????????? ??????.???.??????. ???????????? ?????? ????????????????????? ????????????????????? ??? ???????????? ????????? ???????????? ?????????????????? ????????? ?????? ???????????? ???????????? ?????? ??????????????? ????????? ????????????????????? ?????????????????? ?????? ?????????, ???????????? ??????????????????????????? ????????? ??????????????? ????????????????????? ???????????? (???????????? ???????????? ??????) ??????????????? ???????????? ??????????????? ??? ????????????????????? ??????????????????????????? ?????? ???????????? ???????????? ?????? ????????? ?????? ??????????????? ????????????????????? ???????????????????????? ???????????? ?????????????????? ??? </span></p>

				         
                    	
						
                   
                    	
					
                    	
                    </div> -->




					



					
					<!-- Trigger the modal with a button -->					
                    <!-- below Submit button section -->						
                     <div class="form-row"> 
							<div class="btn-group">
							    <button id="step6_prevbutton" class="button btn btn-danger mx-2 btn-lg" type="button"  name="step6prevbutton" value="">Previous Step</button>
							    <button id="step6_button" class="button btn btn-danger mx-2 btn-lg" type="button" name="step6button" value="">Last Step</button>
							</div>
					</div>
					                
                   <!--  <div class="form-row">

                             <p class="button btn btn-danger btn-lg my-3">Final-Step</p><hr>
                   	
                    </div> -->
					</section>





					<!--- Section-6 end --->
					<section id="Step-7" class="section7">
					<!--- Last step in form submission ---->
					<hr>
					   <h3 class="section-heading sub-heading text-center py-3 text-light" style="background-color:#ae2627;font-size:15px; font-weight:700; color:#fff;"><span class="heading1-hindi">??????????????? ?????????????????? ?????? ?????????</span><br /><span class="heading1-eng">FOR FINAL SUBMISSION</span></h3>
					<hr>
					<p class="para-hindi"><span class="label-hindi">??????????????? ???????????? ??????????????? ???????????? ?????? ????????? ????????????????????????????????? ???????????? ?????? ???????????? ??????, ???????????? ?????????????????? ?????? ?????? ???????????? ??????????????? ????????????????????? ?????? ????????? <b>[???????????????????????? ?????????]</b> ?????? ??????????????? ???????????? ????????? ???????????????????????? ????????????????????? ?????? ???????????? ????????????, ????????? ??????????????? ????????? ????????? ??????????????? ?????????????????? ?????? ?????? <b>[???????????????????????? ?????????]</b> ??????????????? ?????? ???????????????????????? ??????????????? ?????? ????????? <b>[??????????????? ?????????]</b> ?????? ??????????????? ???????????? ?????? ????????? ?????? ???????????? ??????????????? ????????????????????? ???????????? ?????? ???????????????</span></p><p class="para-hindi"><span class="label-hindi"> ??????????????? ?????? ?????? ??????????????? ????????? ?????? ????????????????????? ??????????????????????????? ?????? ??????????????? ???????????? ?????? ????????? ????????????????????? ?????? ??????????????? ??????????????? ?????? ????????????????????????????????? ?????? ???????????? ?????? ????????? ???????????? ?????????????????? ????????? ????????? ?????????????????? ???????????? ?????? ??????????????????????????? ???????????? ??????????????? ?????????????????? ??????????????? ?????? ?????? ?????? ?????? ????????? ?????????????????? ??????????????? ?????? ???????????? ??????????????????</span></p>
					<p class="para-eng"><span class="label-eng">You have successfully filled the form, requesting you to check all the inserted details by clicking the <b>[Preview Button]</b> for your final review, if any change in the details is required press <b>[Previous Button]</b> and complete the required changes. Once the <b>[Submit Button]</b> is clicked, the details cannot be modified.</span></p>
					<p class="para-eng"><span class="label-eng">Kindly note that all the details entered during the registration process will be used for checking student's authenticity. If any invalid data or inappropriate files are uploaded by the student then he/she will be disqualified.</span></p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<!--<div class="form-row final-submit">-->
					<div class="form-row">
					<button id="step7_prevbutton" class="button btn btn-danger mx-2 btn-lg my-3" type="button" name="step7prevbutton" value="">Previous Step</button>
					<button class="button btn btn-danger mx-2 btn-lg my-3" id="final_button" type="button" onclick="myPreview()" data-toggle="modal" data-target="#myModal">Preview</button>




					<div class="modal bg-dark" id="myModal" role="dialog">
					<div class="modal-dialog">    
					<!-- Modal content-->
					<div class="modal-content">
					<div class="modal-header">
					<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
					<h4 class="modal-title">Preview Of Complete Form <span class="bg-warning text-danger">(Scroll down for [Submit Button])</span></h4>
					</div>
					<div class="modal-body">
					<!--- PREVIEW FORM DETAILS --->
					<hr>
					<h2>??????????????? ???????????? ?????????????????? ?????? ????????? ????????????/Your Selected Category</h2>
					<hr>	
					<div class="form-row">
					<label><span class="label-hindi">???????????? ?????? ???????????????????????? ??????????????? ????????? ?</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Are You a Specially Abled Student ?</span></label>
					<span id="regcat" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;">  </span>
					</div>
					<div class="form-row stutdisop1">
					<label><span class="label-hindi">?????????????????????????????? ?????? ?????????  ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Please Select Your Disorder</span></label>
					<span id="regdisorder" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;">  </span>
					</div>
					<div class="form-row stutdisop1">
					<label><span class="label-hindi">??????????????? ????????????????????? ?????????????????? ?????? ????????? ???????????? </span><span class="req-col text-danger">*</span><br /><span class="label-eng">Physical Challenge Undergone</span></label>
					<span id="regphydisorder" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;">  </span>
					</div>
					<div class="form-row stutdisop1">
					<label><span class="label-hindi">??????????????? ?????????????????? ?????????????????? ??????  ????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Mental Challenge Undergone</span></label>
					<span id="regmendisorder" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;">  </span>
					</div>
					<div class="form-row stutdisop1">
					<label><span class="label-hindi">???????????????  ?????????????????? ?????? ??????????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Disorder Details</span></label>
					<span id="regdisorderdetail" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;">  </span>
					</div>
					<div class="form-row stutdisop1">
					<label><span class="label-hindi">??????????????????????????? ???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Relevant File</span></label>
					<span id="regdisorderfile" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;">  </span>
					</div>
					<hr>
					<h2>??????????????? ???????????????????????? ?????????????????????/Student Basic Information</h2>
					<hr>
					<div class="form-row">
					<label><span class="label-hindi">???????????? ????????? (????????????????????????)</span><span class="req-col  text-danger">*</span><br /><span class="label-eng">Full Name (English)</span></label>
					<span id="regfengname" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">???????????? ????????? (???????????????)</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Full Name (Hindi)</span></label>
					<span id="regfhname" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">???????????? ????????? ?????? ??????????????? ?????????????????? ????????? ??????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Name Shown in Hindi is Correct?</span></label>
					<span id="regfhnameCorrect" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>					
					<div class="form-row stuthncfop1">
					<label><span class="label-hindi">??????????????? ?????? ?????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Uploaded File for Hindi Name</span></label>
					<span id="regfhnameFilename" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<hr>
					<h2>?????????????????????????????? ?????? ???????????? ????????? ?????????????????????/Student Details</h2>
					<hr>
					<div class="form-row">
					<label><span class="label-hindi">??????????????????????????????  ???????????????????????? ???????????????????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Student Passport Photograph</span></label>
					<span id="regfstupassFilename" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Gender</span></label>
					<span id="regstugender" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">???????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Date of Birth</span></label>
					<span id="regstudob" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">???-?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Email ID</span></label>
					<span id="regstuemail" class="stu-pre-value stu-email-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">?????????????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Mobile Number</span></label>
					<span id="regstumobile" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<hr>
					<h2>??????????????? ??? ????????????????????? ?????? ???????????? ????????? ?????????????????????/School & Exam Details</h2>
					<hr>
					<div class="form-row">
					<label><span class="label-hindi">???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Class</span></label>
					<span id="regstuclass" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">??????????????? ????????????????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Board Roll Number</span></label>
					<span id="regstuboardroll" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">?????????????????? ???????????? ?????? ????????? ??????????????? ?????? ?????? ???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Uploaded File for Admit Card</span></label>
					<span id="regstuadmitc" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">??????????????? ?????????????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Board Exam Appeared For</span></label>
					<span id="regstuboardexam" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>					
					<div class="form-row">
					<label><span class="label-hindi">??????????????? ?????? ???????????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">School Full Name</span></label>
					<span id="regstuschname" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">??????????????? ?????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">School Address</span></label>
					<span id="regstuschaddress" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">???????????????????????? ?????? ????????? ??????????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Medium of Instruction in Your School</span></label>
					<span id="regstuschmedium" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">??????????????? ??????????????? ????????? ??????????????? ?????? ??????????????? ????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Last Year Hindi Marks</span></label>
					<span id="regstuhinlast" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">??????????????? ?????? ????????? ??????????????? ?????? ??????????????? ????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">This Year Hindi Marks</span></label>
					<span id="regstuhinthis" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>

					<div class="form-row">
					<label><span class="label-hindi">??????????????? ?????????????????? ?????? ?????????*</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Hindi Teacher Name</span></label>
					<span id="regstu_tech_name" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">??????????????? ?????????????????? ?????????????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Hindi Teacher Mobile Number</span></label>
					<span id="regstu_tech_mob" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"></span>
					</div>

					<hr>
					<h2>????????????????????? ?????????????????????/Guardian Details</h2>
					<hr>
					<div class="form-row">
					<label><span class="label-hindi">????????????????????? ?????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Parent / Guardian Name</span></label>
					<span id="regstuparentname" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">????????????????????? ?????? ????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Parent / Guardian Mobile Number</span></label>
					<span id="regstuparentmob" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">???????????????????????? ?????????????????? ????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Emergency Mobile Number</span></label>
					<span id="regstuparemgno" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">????????????????????? ?????? ???-?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Parent / Guardian Email ID</span></label>
					<span id="regstuparemail" class="stu-pre-value stu-email-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">?????????????????? ?????? ?????????????????? ??????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Annual Family Income</span></label>
					<span id="regstuparincome" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">????????????????????? ?????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Address</span></label>
					<span id="regstuparaddress" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">City</span></label>
					<span id="regstuparcity" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">????????? ?????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Pincode</span></label>
					<span id="regstuparpincode" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">State</span></label>
					<span id="regstuparstate" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">?????????????????? ???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Facebook Handle</span></label>
					<span id="regstufbk" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">????????????????????????????????? ???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-">Instagram Handle</span></label>
					<span id="regstutwitter" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<hr>
					<h2>???????????? ?????????????????????/Other Details</h2>	
					<hr>
					<div class="form-row">
					<label><span class="label-hindi">???????????? ????????? ??????????????? ??????????????? ?????????????????????????????? ?????? ????????????????????? ???????????? ?????? ?????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">How did you get to know about Ram Awatar Gupt Protsahan-2022?</span></label>
					<span id="regrafinfo" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">???????????? ?????? ???????????????????????? ??????????????? ??????????????? ?????? ?????????????????? ???????????? ??????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Are you a regular reader of Sanmarg Hindi Daily?</span></label>
					<span id="regsanreader" class="stu-pre-value" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<!--<div class="form-row">-->
					<!--<label><span class="label-hindi">???????????? ?????? ?????????</span><span class="req-col">*</span><br /><span class="label-eng">Hawker Name</span></label>-->
					<!--<span id="regsanhaw" class="stu-pre-value text-success bg-warning"> </span>-->
					<!--</div>-->
					<!--<div class="form-row">-->
					<!--<label><span class="label-hindi">???????????? ?????? ?????????????????? ????????????</span><span class="req-col">*</span><br /><span class="label-eng">Hawker telephone number</span></label>-->
					<!--<span id="regsanhawno" class="stu-pre-value text-success bg-warning"> </span>-->
					<!--</div>-->
					<h2>???????????????????????? ?????? ???????????? ????????? ?????????????????????/Award Details</h2>
					<!-- <div class="form-row">
					<label><span class="label-hindi">???????????? ???????????? ????????? ??????????????? ??????????????? ??????????????? ????????????????????? 2020 ?????? ?????? ?</span><span class="req-col">*</span><br /><span class="label-eng">Did you participate in Ram Awatar Gupt Hindi Pariksha 2020?</span></label>
					<span id="regragparik" class="stu-pre-value text-success bg-warning"> </span>
					</div>
					<div class="form-row sturappopt1">
					<label><span class="label-hindi">??????????????? ????????????????????? ????????????????????? ????????????</span><span class="req-col">*</span><br /><span class="label-eng">Hindi Pariksha Roll Number</span></label>
					<span id="regparikroll" class="stu-pre-value text-success bg-warning"> </span>
					</div>
					<div class="form-row sturappopt1">
					<label><span class="label-hindi">??????????????? ????????????????????? ????????????</span><span class="req-col">*</span><br /><span class="label-eng">Hindi Pariksha Marks</span></label>
					<span id="regparikmark" class="stu-pre-value text-success bg-warning"> </span>
					</div>				 -->	
					<div class="form-row stu10opt1">
					<label><span class="label-hindi">???????????? ???????????? ????????? ??????????????? ??????????????? ????????????????????? ???????????????????????? ?????? ????????? ??????????????? 10 ????????? ????????? ???????????? ???????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Have you participated in Ram Awatar Gupt Pratibha Puraskar in class 10?</span></label>
					<span id="regragpp10" class="stu-pre-value text-success" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">??????????????? ????????????????????????-</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Ankur Award-</span></label>
					<span id="regankuroption" class="stu-pre-value text-success" style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>					
					<div class="form-row">
					<label><span class="label-hindi">??????????????? (2018 - 2022) ?????? ????????? ??????????????? ?????? ????????????????????? ????????? ???????????? ?????????????????? ????????? ?????? ???????????????????????? ????????????????????? ?????? 200 ???????????? ???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Extracurricular work done in the field of Hindi between March (2018 - 2022)</span></label>
					<span id="regankurdetail" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row">
					<label><span class="label-hindi">??????????????????????????? ???????????????</span><span class="req-col text-danger">*</span><br /><span class="label-eng">Extracurricular Work Relevant File</span></label>
					<span id="regankurfile1" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<!-- <div class="form-row">
					<label><span class="label-hindi">?????????????????? ??????????????????</span><span class="req-col">*</span><br /><span class="label-eng">Submission Type</span></label>
					<span id="submit_type_modal" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div>
					<div class="form-row extmpr_date">
					<label><span class="label-hindi">???????????????????????? ????????????</span><span class="req-col">*</span><br /><span class="label-eng">Oratory Date</span></label>
					<span id="extempore_date_modal" class="stu-pre-value " style="background-color: #ffeda9; color: #0b891b;"> </span>
					</div> -->
					<!-- <div class="form-row">
					<label><span class="label-hindi">????????? ?????????????????????????????? ??????????????????????????? ???????????????</span><span class="req-col">*</span><br /><span class="label-eng">All Activities File</span></label>
					<span id="regankurfile2" class="stu-pre-value text-success bg-warning"> </span>
					</div> -->
					<!-- <div class="form-row">
					<label><span class="label-hindi">??????????????? ???????????? ?????? ???????????? ?????? ?????????????????? ???????????? ??????????????????????</span><span class="req-col">*</span><br /><span class="label-eng">Student would you be a part of Yuva?</span></label>
					<span id="regyuvaoption" class="stu-pre-value text-success bg-warning"> </span>
					</div> -->
					<!--- PREVIEW FORM DETAILS ENDS HERE --->
					</div><!--- modal body end --->
					<div class="modal-footer">					
					<input type="submit" class="button btn btn-danger btn-lg" name="submit"  value="Final Form Submit">
					<input type="button" class="button btn btn-danger btn-lg close-btn" data-dismiss="modal" value="Close Preview">					
					<!--<button type="button" class="button btn btn-danger btn-sm" data-dismiss="modal">Close</button>-->
					</div>
					</div>                    
                    </div> 
					</div>



					</div>
                    </section>
                    <!-- End -->


                   </form>


		    </div>
	    </div>
    </div>
    <nav class="navbar" id="footer_main">
    	
       <footer id="footer" style="background-color:#ae2627;color: #fff;" class="navbar bottom-0">Powered By Sanmarg Pvt. Ltd.</footer>

    </nav>


	 
	  
	
        



       
    </div>




  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <!--<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>-->


 <script>
  $( function() {
    $( "#dp1" ).datepicker({

        changeMonth: true,
          changeYear: true,
         dateFormat: 'dd-mm-yy',
         defaultDate: '01-01-2005',
         yearRange:'-20:-14'

    });
  });
 </script>


 


<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery.steps.js"></script>
<!--<script src="vendor/jquery/jquery.min.js"></script>-->
<script src="js/main.js"></script>

<!-- jquery ui js -->
<script src="jq_ui_js/jquery-ui.min.js"></script>
<script  src="jq_ui_js/jquery-ui.js"></script>


 <!-- JavaScript Bundle with Popper -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" -->
<!--integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"-->
 <!--crossorigin="anonymous"></script>-->

 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
 -->


 <script>

 	if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
     }
 

  

 </script>


<script> 
function goBack() {
  window.history.back();
}
////only 2digit number
function isNumber(source,evt) {
    //Grab the event
    evt = (evt) ? evt : window.event;
    //Determine the character that was pressed
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    //Ensure the character was valid and that the length doesn't exceed 2 characters (1-99)
    if (charCode > 31 && (charCode < 48 || charCode > 57) || source.value.length >= 2) {
        return false;
    }
    return true;
}
function isNumberThree(source,evt) {
    //Grab the event
    evt = (evt) ? evt : window.event;
    //Determine the character that was pressed
    var charCode = (evt.which) ? evt.which : evt.keyCode;
		
    //Ensure the character was valid and that the length doesn't exceed 3 characters (1-99)
    if (charCode > 31 && (charCode < 48 || charCode > 57) || source.value.length >= 3) {
		
        return false;
    }	
	
    return true;
}

</script>



<script type="text/javascript">
// When the user clicks on <div>, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
function myFunction2() {
  var popup = document.getElementById("myPopup2");
  popup.classList.toggle("show");
}
 function myPreview() {
  $('#regcat').html($("#category option:selected").text());
   if($("#category").val()== "Aparajay"){
       $('#regdisorder').html($("#disorder option:selected").text());
       $('#regphydisorder').html($("#phy_disorder option:selected").text());
       $('#regmendisorder').html($("#mental_disorder option:selected").text());
       $('#regdisorderdetail').html($("#disorder_detail").val());
       $('#regdisorderfile').html($("#disorder_file").val());
   }else if($("#category").val()== "General"){
	    $('.stutdisop1').hide();		  
   }	
  $('#regfengname').html($('#fname').val().trim() + ' ' + $('#lname').val().trim());
  $('#regfhname').html($('#hname').val().trim() + ' ' + $('#hlname').val().trim());


  $('#regfhnameCorrect').html($("input[type=radio][name=radHindiName]:checked").val());
     if($("input[type=radio][name=radHindiName]:checked").val()=="No"){
         $('#regfhnameFilename').html($("#hname_file").val());
     }else if($("input[type=radio][name=radHindiName]:checked").val()=="Yes"){
	        $('.stuthncfop1').hide();  
     }	  
	  $('#regfstupassFilename').html($("#student_photo_file").val());  
	  $('#regstugender').html($("input[name='gender']:checked").val());
	  $('#regstudob').html($("input[name='studob']").val());
	  $('#regstuemail').html($("#stuemail").val());
	  $('#regstumobile').html($("#stumobile").val());
	  $('#regstuclass').html($("input[type=radio][name=stuclass]:checked").val());
	  $('#regstuboardexam').html($("#boardexam option:selected").text());
	  $('#regstuboardroll').html($("#boardrollnumber").val());
      if($("#schoolname").val()!="others"){
	     $('#regstuschname').html($("#schoolname").val());
	     $('#regstuschaddress').html($("#school_address").val());
       }else if($("#schoolname").val()=="others"){
			$('#regstuschname').html($("#other_school_name").val());
			$('#regstuschaddress').html($("#other_school_address").val());  
		  }


		  $('#regstuschmedium').html($("#school_medium option:selected").text());
		  $('#regstuhinlast').html('1st Term - ' + $("#last_year_marks1").val()+'<br>'+ '2nd Term - ' + $("#last_year_marks2").val()+'<br>');
		  $('#regstuhinthis').html('1st Term - ' + $("#current_year_marks1").val()+'<br>'+ '2nd Term - ' + $("#current_year_marks2").val()+'<br>'+ 'Pre Board - ' + $("#current_year_preboards").val()+'<br>');	
		  $('#regstuparentname').html($("#parent_name").val());
		  $('#regstuparentmob').html($("#parentmobile").val());
		  $('#regstuparemgno').html($("#emergency_landline").val());
		  $('#regstuparemail').html($("#parentemail").val());
		  $('#regstuparincome').html($("#family_income option:selected").text());
		  $('#regstuparaddress').html($("#home_address").val());
		  $('#regstuparcity').html($("#city").val());
		  $('#regstuparpincode').html($("#pincode").val());
		  $('#regstuparstate').html($("#state").val());
		  $('#regstufbk').html($("#facebook_handle").val());
		  $('#regstutwitter').html($("#twitter_handle").val());
		  $('#regstuadmitc').html($("#admit_card_file").val());
		  $('#regstupreboardm').html($("#current_year_preboards").val());
		  $('#regrafinfo').html($("#ragaward_source option:selected").text());

		  $('#regsanreader').html($("input[type=radio][name=sanmarg_reader]:checked").val());


		   $('#regstu_tech_name').html($("#hindi_Teacher_name").val());
		  $('#regstu_tech_mob').html($("#hindi_teacher_mobile").val());


		  $('#regsanhaw').html($("#hawker_name").val());
		  $('#regsanhawno').html($("#hawker_telephone").val());  
		  $('#regragparik').html($("#rag_pariksha_participated option:selected").text()); 
		  if($("#rag_pariksha_participated").val()== "Yes"){	 
			  $('#regparikroll').html($("#rag_pariksha_rollno").val());
			  $('#regparikmark').html($("#rag_pariksha_marks").val()); 
		   }else if($("#rag_pariksha_participated").val()== "No"){
			  $('.sturappopt1').hide(); 
		   }	   
         if($("input[name='stuclass']:checked").val() == "Class-12"){
              $('#regragpp10').html($("input[type=radio][name=rag_participated_chk]:checked").val());
         }else if($("input[name='stuclass']:checked").val() == "Class-10"){
	          $('.stu10opt1').hide();	  
           }	
		  $('#regankuroption').html($("#ankur_option").val());  
		  $('#regankurdetail').html($("#ankur_activity_textwork").val());
		  $('#regankurfile1').html($("#ankur_activity_file").val());
		  $('#regankurfile2').html($("#all_activity_file").val());
		  $('#regyuvaoption').html($("#yuva").val());


		  $('#submit_type_modal').html($("#submit_type").val());
		  if($("#submit_type").val()== "Oratory"){ 

		     $('#extempore_date_modal').html($("input[type=radio][name=extempore_date_checkbox]:checked").val()); 
		   }else{
		   	   $('.extmpr_date').hide();
		   }
  
  
 }
</script>


<?php 

if( $success==1){ ?>
	<script type="text/javascript">
		

		$(".section0").hide();	
		$(".section1").hide();
		$(".section2").hide();
		$(".section3").hide();
		$(".section4").hide();
		$(".section5").hide();
		$(".section6").hide();
		$(".section7").hide();
		$('#fill_section').hide();
		$('#success_page').show();
		 window.scrollTo({
		    top: 0,
		    left: 0,
		    behavior: 'smooth'
		  });	
	</script>

<?php } ?>




<script type="text/javascript">
	

$(document).ready(function(){
 	
	
 $(this).scrollTop(0);




<?php if($success==0){ ?>

	$(".section0").show();	
	$(".section1").show();
	$(".section2").show();
	$(".section3").hide();
	$(".section4").hide();
	$(".section5").hide();
	$(".section6").hide();
	$(".section7").hide();
	$('#fill_section').show();
	$('#success_page').hide();

	 window.scrollTo({
		    top: 0,
		    left: 0,
		    behavior: 'smooth'
	});

<?php }else{ ?>


	$(".section0").hide();	
	$(".section1").hide();
	$(".section2").hide();
	$(".section3").hide();
	$(".section4").hide();
	$(".section5").hide();
	$(".section6").hide();
	$(".section7").hide();
	$('#fill_section').hide();
	$('#success_page').show();

	 window.scrollTo({
		    top: 0,
		    left: 0,
		    behavior: 'smooth'
	});
<?php } ?>



// on change of submit type


$("#submit_type").change(function(){

	if($("#submit_type").val()== "Oratory"){
	  $(".date_extempore_date").show();
	  $("#extempore_date_checkbox").attr("required", true);
	  
	}
	else{
	  $(".date_extempore_date").hide(); 
	  $("#extempore_date_checkbox").attr("required", false);
	  
	}
});




//onchange selection of aparajay 


$("#category").change(function(){

	if($("#category").val()== "Aparajay"){
	  $(".aparajay-section").show();
	  $("#disorder").attr("required", true);
	  $("#disorder_detail").attr("required", true);	 
	  $("#disorder_file").attr("required", true); 
	}
	else{
	  $(".aparajay-section").hide(); 
	  $("#disorder").attr("required", false);
	  $("#disorder_detail").attr("required", false);
	  $("#disorder_file").attr("required", false);
	}
});




//next button function
var step0Validation = function() {
	

      if(!($("#category").val()== "") && !($("#category").val()== "Aparajay") )
      {
        $(".section0").hide();  
		$(".section1").show();		
		
     } 
	 else if($("#category").val()== "Aparajay"){
		 if(!($("#disorder").val()=="") && !($("#disorder_detail").val()== "") && !($("#disorder_file").val()== "") ){
		    $(".section0").hide();  
		    $(".section1").show();
				
		 }
		 else{
			$(".section0").show();
			$(".section1").hide();
			
		 }
	 }
	 else{
		 $(".section0").show(); 		 
		 $(".section1").hide();
		
	 }
    
        
}










var step1Validation = function() {
	 
      if($("#fname").val() !== "" && $("#lname").val() !== "" && $("#hname").val() !== "" && $("#hlname").val() !== "" && $("input[type=radio][name=radHindiName]:checked").val() && 
	  $("input[type=radio][name=radHindiName]:checked").val()=="Yes")
      { 
	    $(".section0").hide();
        $(".section1").hide();  
		$(".section2").show();
		
     }
	 else if($("input[type=radio][name=radHindiName]:checked").val()=="No" && !($("#hname_file").val()== "") ){
		$(".section0").hide();
        $(".section1").hide();  
		$(".section2").show();		 
	 }
	 else if(!($('[name=radHindiName]').is(':checked'))){
		alert("Please Select Your Hindi Name Is Correct");
		$(".section0").hide();
        $(".section1").show();
		$(".section2").hide();		 
	 } 
	  else{
		$(".section0").hide();
        $(".section1").show();
		$(".section2").hide();

	  }		
        
}


 var step2Validation = function() {


$(this).scrollTop(0);

if($("#category").val()== "")
  {
  	alert("Please enter all the fields in 'Select Your Category'");
    $(".section0").show();  
	$(".section1").show();
	$(".section2").show();		
	
 }

else if($("#category").val()== "Aparajay"){
	 if($("#disorder").val()=="" || $("#disorder_detail").val()== "" || $("#disorder_file").val()==""){
		 	alert("Please enter your 'Disorder Details'");
		    $(".section0").show();  
		    $(".section1").show();
		    $(".section2").show();	
	   }

	  else if($("#disorder").val()=="Physically Challenged"){
		    	if($("#phy_disorder").val()==""){
	              alert("Please select your 'Physical Challenge'");
				    $(".section0").show();  
				    $(".section1").show();
				    $(".section2").show();	

		    	}
		    	else{


		    		if($("#fname").val() == "" || $("#lname").val() == "" || $("#hname").val() == "" || $("#hlname").val() == "" || !($("input[type=radio][name=radHindiName]:checked").val()) ||
						  $("input[type=radio][name=radHindiName]:checked").val()=="" )
					      { 
						    alert("Please enter your 'Basic Information'");
							    $(".section0").show();  
							    $(".section1").show();
							    $(".section2").show();	
							
					     }
					     else if($("#stuemail").val()== "" || $("#stumobile").val()== "" || !($('[name="gender"]').is(':checked')) || $("#student_photo_file").val()== "" || $("#dp1").val()== "")
					     {
					       alert("Please enter your 'Student Details'");
							    $(".section0").show();  
							    $(".section1").show();
							    $(".section2").show();
							
					     }else if(!($('[name=gender]').is(':checked'))){
							alert("Please select your gender");
							$(".section0").show();  
							$(".section1").show();
							$(".section2").show();			 
						 }
						 else if($('.student_mobile1').val().toString().length!=10){


							 	alert("Please enter a valid Mobile Number");
							 }

						else if($("input[type=radio][name=radHindiName]:checked").val()=="No"){
						 	if($("#hname_file").val() == ""){
							 	alert("Please upload a file with your name written in Hindi");
							 	$(".section0").show();  
								$(".section1").show();
								$(".section2").show();
							}
							else{
								$(".section0").hide();  
								$(".section1").hide();
								$(".section2").hide();
								$(".section3").show();
								$(".section4").show();
								$(".section5").show();	
								window.scrollTo({
								    top: 0,
								    left: 0,
								    behavior: 'smooth'
								  });			 	 
						    }	

						 }
						
						 else{
							$(".section0").hide();  
							$(".section1").hide();
							$(".section2").hide();
							$(".section3").show();
							$(".section4").show();
							$(".section5").show();	
							window.scrollTo({
							    top: 0,
							    left: 0,
							    behavior: 'smooth'
							  });			 	 
						 }


		    	}

		    }
		    else if($("#disorder").val()=="Emotionally Challenged"){
		    	if($("#mental_disorder").val()==""){
	              alert("Please select your 'Mental Challenge'");
				    $(".section0").show();  
				    $(".section1").show();
				    $(".section2").show();	

		    	}
		    	else{


		    		if($("#fname").val() == "" || $("#lname").val() == "" || $("#hname").val() == "" || $("#hlname").val() == "" || !($("input[type=radio][name=radHindiName]:checked").val()) ||
						  $("input[type=radio][name=radHindiName]:checked").val()=="" )
					      { 
						    alert("Please enter your 'Basic Information'");
							    $(".section0").show();  
							    $(".section1").show();
							    $(".section2").show();	
							
					     }
					     else if($("#stuemail").val()== "" || $("#stumobile").val()== "" || !($('[name="gender"]').is(':checked')) || $("#student_photo_file").val()== "" || $("#dp1").val()== "")
					     {
					       alert("Please enter your 'Student Details'");
							    $(".section0").show();  
							    $(".section1").show();
							    $(".section2").show();
							
					     }else if(!($('[name=gender]').is(':checked'))){
							alert("Please select your gender");
							$(".section0").show();  
							$(".section1").show();
							$(".section2").show();			 
						 }
						 else if($('.student_mobile1').val().toString().length!=10){


							 	alert("Please enter a valid Mobile Number");
							 }

						else if($("input[type=radio][name=radHindiName]:checked").val()=="No"){
						 	if($("#hname_file").val() == ""){
							 	alert("Please upload a file with your name written in Hindi");
							 	$(".section0").show();  
								$(".section1").show();
								$(".section2").show();
							}
							else{
								$(".section0").hide();  
								$(".section1").hide();
								$(".section2").hide();
								$(".section3").show();
								$(".section4").show();
								$(".section5").show();	
								window.scrollTo({
								    top: 0,
								    left: 0,
								    behavior: 'smooth'
								  });			 	 
						    }	

						 }
						
						 else{
							$(".section0").hide();  
							$(".section1").hide();
							$(".section2").hide();
							$(".section3").show();
							$(".section4").show();
							$(".section5").show();	
							window.scrollTo({
							    top: 0,
							    left: 0,
							    behavior: 'smooth'
							  });			 	 
						 }
		    	}
		    
		
	       
		}

		 else{
		 	 
		    if($("#fname").val() == "" || $("#lname").val() == "" || $("#hname").val() == "" || $("#hlname").val() == "" || !($("input[type=radio][name=radHindiName]:checked").val()) ||
			  $("input[type=radio][name=radHindiName]:checked").val()=="" )
		      { 
			    alert("Please enter your 'Basic Information'");
				    $(".section0").show();  
				    $(".section1").show();
				    $(".section2").show();	
				
		     }
		     else if($("#stuemail").val()== "" || $("#stumobile").val()== "" || !($('[name="gender"]').is(':checked')) || $("#student_photo_file").val()== "" || $("#dp1").val()== "")
		     {
		       alert("Please enter your 'Student Details'");
				    $(".section0").show();  
				    $(".section1").show();
				    $(".section2").show();
				
		     }else if(!($('[name=gender]').is(':checked'))){
				alert("Please select your gender");
				$(".section0").show();  
				$(".section1").show();
				$(".section2").show();			 
			 }
			 else if($('.student_mobile1').val().toString().length!=10){


				 	alert("Please enter a valid Mobile Number");
				 }

			else if($("input[type=radio][name=radHindiName]:checked").val()=="No"){
			 	if($("#hname_file").val() == ""){
				 	alert("Please upload a file with your name written in Hindi");
				 	$(".section0").show();  
					$(".section1").show();
					$(".section2").show();
				}
				else{
					$(".section0").hide();  
					$(".section1").hide();
					$(".section2").hide();
					$(".section3").show();
					$(".section4").show();
					$(".section5").show();	
					window.scrollTo({
					    top: 0,
					    left: 0,
					    behavior: 'smooth'
					  });			 	 
			    }	

			 }
			
			 else{
				$(".section0").hide();  
				$(".section1").hide();
				$(".section2").hide();
				$(".section3").show();
				$(".section4").show();
				$(".section5").show();	
				window.scrollTo({
				    top: 0,
				    left: 0,
				    behavior: 'smooth'
				  });			 	 
			 }


		 }
		}

else if($("#fname").val() == "" || $("#lname").val() == "" || $("#hname").val() == "" || $("#hlname").val() == "" || !($("input[type=radio][name=radHindiName]:checked").val()) ||
  $("input[type=radio][name=radHindiName]:checked").val()=="" )
  { 
    alert("Please enter your 'Basic Information'");
	    $(".section0").show();  
	    $(".section1").show();
	    $(".section2").show();	
	
 }

else if($("#stuemail").val()== "" || $("#stumobile").val()== "" || !($('[name="gender"]').is(':checked')) || $("#student_photo_file").val()== "" || $("#dp1").val()== "")
  {
   alert("Please enter your 'Student Details'");
	    $(".section0").show();  
	    $(".section1").show();
	    $(".section2").show();
	
  }
else if(!($('[name=gender]').is(':checked'))){
	alert("Please select your gender");
	$(".section0").show();  
	$(".section1").show();
	$(".section2").show();			 
 }

 else if($("input[type=radio][name=radHindiName]:checked").val()=="No"){
	 	if($("#hname_file").val() == ""){
		 	alert("Please upload a file with your name written in Hindi");
		 	$(".section0").show();  
			$(".section1").show();
			$(".section2").show();
		}
		else if($('.student_mobile1').val()!=""){

	    var mob=$('.student_mobile1').val();
	    var mob_len=mob.toString().length;
		    if(mob_len!=10){
		 	    alert("Please enter a valid Mobile Number");
		 	}
		 	
		 	else{
		 		$(".section0").hide();  
				$(".section1").hide();
				$(".section2").hide();
				$(".section3").show();
				$(".section4").show();
				$(".section5").show();
			    window.scrollTo({
				    top: 0,
				    left: 0,
				    behavior: 'smooth'
				  });	
		 	}
        }
		else{
			$(".section0").hide();  
			$(".section1").hide();
			$(".section2").hide();
			$(".section3").show();
			$(".section4").show();
			$(".section5").show();
				window.scrollTo({
		    top: 0,
		    left: 0,
		    behavior: 'smooth'
		  });				 	 
	    }	

}

else{
	$(".section0").hide();  
	$(".section1").hide();
	$(".section2").hide();
	$(".section3").show();
	$(".section4").show();
	$(".section5").show();	
	 window.scrollTo({
	    top: 0,
	    left: 0,
	    behavior: 'smooth'
	  });		 	 
 }
     
        
}



var step3Validation = function() {
if(!($("#boardrollnumber").val()== "") && !($(".schoolmedium").val()== "") && 
$('[name="stuclass"]').is(':checked') && !($("#last_year_marks1").val()== "") && !($("#last_year_marks2").val()== "")
&& !($("#last_year_marks3").val()== "") && !($("#current_year_marks3").val()== "") && !($("#current_year_marks2").val()== "") && !($("#current_year_preboards").val()== ""))
      {
        $(".section0").hide();  
		$(".section1").hide();
		$(".section2").hide();
		$(".section3").hide();
		$(".section4").show();
		
     }
	  else if(!($('[name=stuclass]').is(':checked')) && $("#last_year_marks1").val()== "" && $("#last_year_marks2").val()== "" && $("#last_year_marks3").val()== "" && $("#current_year_marks3").val()== "" && $("#current_year_marks2").val()== "" && $("#current_year_preboards").val()== ""){
		alert("Please Select Your Class");
		 $(".section0").hide();  
		 $(".section1").hide();
		 $(".section2").hide();
		 $(".section3").show();
		 $(".section4").hide();			 
	 } 
	 else{
		 $(".section0").hide();  
		 $(".section1").hide();
		 $(".section2").hide();
		 $(".section3").show();
		 $(".section4").hide();			  
	 }
     
        
}





var step4Validation = function() {
if(!($("#parent_name").val()== "") && !($("#parentmobile").val()== "") && !($("#parentemail").val()== "") && !($(".familyincome").val()== "") && !($("#home_address").val()== "") && 
!($("#city").val()== "") && !($("#pincode").val()== "") && !($("#state").val()== ""))
      {
        $(".section0").hide();  
		$(".section1").hide();
		$(".section2").hide();
		$(".section3").hide();
		$(".section4").hide();
		$(".section5").show();		
     }
	 else if($('#state').val()== ""){
		 $(".section0").hide();  
		 $(".section1").hide();
		 $(".section2").hide();
		 $(".section3").hide();
		 $(".section4").show();
		 $(".section5").hide();

	 }		
	 else{
		 $(".section0").hide();  
		 $(".section1").hide();
		 $(".section2").hide();
		 $(".section3").hide();
		 $(".section4").show();
		 $(".section5").hide();			  
	 }    
        
}




var step5Validation = function() {
	$(this).scrollTop(0);

if(!($('[name=stuclass]').is(':checked'))){
	alert("please Select your Class Student");
        $(".section0").hide();  
		$(".section1").hide();
		$(".section2").hide();
		$(".section3").show();
		$(".section4").show();
		$(".section5").show();
		


}
else if($("#boardrollnumber").val()== "" || $("#school_medium").val()== "" || 
!($('[name="stuclass"]').is(':checked')) || $("#last_year_marks1").val()== "" || $("#last_year_marks2").val()== ""
|| $("#last_year_marks3").val()== "" || $("#current_year_marks3").val()== "" || $("#current_year_marks2").val()== "" || $("#current_year_preboards").val()== ""  
|| $("#admit_card_file").val()== "" || $("#boardexam").val()== ""  || $("#location").val()== "" || $("#schoolname").val()== "" || $("#school_address").val()== "" || $("#hindi_Teacher_name").val()== "")
      {
      	alert("Please enter all the fields in 'School & Exam Details'");
        $(".section0").hide();  
		$(".section1").hide();
		$(".section2").hide();
		 $(".section3").show();
		 $(".section4").show();
		 $(".section5").show();
		
     }

else if($("#schoolname").val()== "others"){



		 if($('#other_school_name').val()=="" || $('#other_school_address').val()==""){
			alert("Please enter your 'New School Details'");
			    $(".section0").hide();  
				$(".section1").hide();
				$(".section2").hide();
				$(".section3").show();
				$(".section4").show();
				$(".section5").show();	

		 }
		 else if($("#parent_name").val()== "" || $("#parentmobile").val()== "" || $("#parentemail").val()== "" || $(".familyincome").val()== "" ||
		 $("#home_address").val()== "" || $("#city").val()== "" || $("#pincode").val()== "" || $("#state").val()== "")
		   {
			      	alert("Please enter your 'Guardians Details'");
			        $(".section0").hide();  
					$(".section1").hide();
					$(".section2").hide();
					$(".section3").show();
					$(".section4").show();
					$(".section5").show();		
			}
			
			else{
					 $(".section0").hide();  
					 $(".section1").hide();
					 $(".section2").hide();
					 $(".section3").hide();
					 $(".section4").hide();	
					 $(".section5").hide();
					 $(".section6").show();	
					 window.scrollTo({
					    top: 0,
					    left: 0,
					    behavior: 'smooth'
					  });	
				     	  
				 }
			     
			        
			

}
else if($("#parent_name").val()== "" || $("#parentmobile").val()== "" || $("#parentemail").val()== "" || $(".familyincome").val()== "" || $("#home_address").val()== "" || 
$("#city").val()== "" || $("#pincode").val()== "" || $("#state").val()== "")
      {
      	alert("Please enter your 'Guardians Details'");
        $(".section0").hide();  
		$(".section1").hide();
		$(".section2").hide();
		$(".section3").show();
		$(".section4").show();
		$(".section5").show();		
}
 	
  
else{
		 $(".section0").hide();  
		 $(".section1").hide();
		 $(".section2").hide();
		 $(".section3").hide();
		 $(".section4").hide();	
		 $(".section5").hide();
		 $(".section6").show();
		 window.scrollTo({
		    top: 0,
		    left: 0,
		    behavior: 'smooth'
		  });		
	     	  
	 }
     
        
}

// var finalValidation=function() {




// }







// if($("#rag_pariksha_participated").val()!= "" && $("#rag_pariksha_participated").val()!= "Yes" 
// 		&& $("input[name='stuclass']:checked").val() == "Class-10" && $("#ankur_option option:selected").val() != "" 
// 		&& $("#ankur_option option:selected").val() != "Yes" && $("#yuva").val() != "" ){
// 			 $(".section0").hide();  
// 			 $(".section1").hide();
// 			 $(".section2").hide();
// 			 $(".section3").hide();
// 			 $(".section4").hide();	
// 			 $(".section5").hide();
// 			 $(".section6").hide();
// 			 $(".section7").show();  	
		
		
// 	}
// 	else if($("#rag_pariksha_participated").val()!= "" && $("#rag_pariksha_participated").val()!= "Yes" 
// 		&& $("input[name='stuclass']:checked").val() == "Class-12" && $('[name=rag_participated_chk]').is(':checked') 
// 		&& $("#ankur_option option:selected").val() != "" && $("#ankur_option option:selected").val() != "Yes" && $("#yuva").val() != "" ){
// 			 $(".section0").hide();  
// 			 $(".section1").hide();
// 			 $(".section2").hide();
// 			 $(".section3").hide();
// 			 $(".section4").hide();	
// 			 $(".section5").hide();
// 			 $(".section6").hide();
// 			 $(".section7").show();
		
// 	}
// 	else if($("#rag_pariksha_participated").val()!= "" && $("#rag_pariksha_participated").val()== "Yes" 
// 		&& $("#rag_pariksha_rollno").val()!= "" && $("#rag_pariksha_marks").val()!= "" && $("input[name='stuclass']:checked").val() == "Class-12" 
// 		&& $('[name=rag_participated_chk]').is(':checked') && $("#ankur_option option:selected").val() != "" && $("#ankur_option option:selected").val() != "Yes" && $("#yuva").val() != ""){
// 		     $(".section0").hide();  
// 			 $(".section1").hide();
// 			 $(".section2").hide();
// 			 $(".section3").hide();
// 			 $(".section4").hide();	
// 			 $(".section5").hide();
// 			 $(".section6").hide();
// 			 $(".section7").show();
		
// 	}
// 	else if($("#rag_pariksha_participated").val()!= "" && $("#rag_pariksha_participated").val()== "Yes" 
// 		&& $("#rag_pariksha_rollno").val()!= "" && $("#rag_pariksha_marks").val()!= "" && $("input[name='stuclass']:checked").val() == "Class-12" 
// 		&& $('[name=rag_participated_chk]').is(':checked') && $("#ankur_option option:selected").val() != "" 
// 		&& $("#ankur_option option:selected").val() == "Yes" && $("#ankur_activity_textwork").val() != "" && $("#ankur_activity_file").val() != "" 
// 		&& $("#all_activity_file").val() != "" && $("#yuva").val() != "" ){
// 		     $(".section0").hide();  
// 			 $(".section1").hide();
// 			 $(".section2").hide();
// 			 $(".section3").hide();
// 			 $(".section4").hide();	
// 			 $(".section5").hide();
// 			 $(".section6").hide();
// 			 $(".section7").show();

// 	}
// 	else if($("#rag_pariksha_participated").val()!= "" && $("#rag_pariksha_participated").val()== "Yes" 
// 		&& $("#rag_pariksha_rollno").val()!= "" && $("#rag_pariksha_marks").val()!= "" 
// 		&& $("input[name='stuclass']:checked").val() == "Class-10" && $("#ankur_option option:selected").val() != "" 
// 		&& $("#ankur_option option:selected").val() != "Yes" && $("#yuva").val() != ""){

// 	         $(".section0").hide();  
// 			 $(".section1").hide();
// 			 $(".section2").hide();
// 			 $(".section3").hide();
// 			 $(".section4").hide();	
// 			 $(".section5").hide();
// 			 $(".section6").hide();
// 			 $(".section7").show();
// 	}
// 	else if($("#rag_pariksha_participated").val()!= "" && $("#rag_pariksha_participated").val()== "Yes" 
// 		&& $("#rag_pariksha_rollno").val()!= "" && $("#rag_pariksha_marks").val()!= "" 
// 		&& $("input[name='stuclass']:checked").val() == "Class-10" && $("#ankur_option option:selected").val() != "" 
// 		&& $("#ankur_option option:selected").val() == "Yes" && $("#ankur_activity_textwork").val() != "" 
// 		&& $("#ankur_activity_file").val() != "" && $("#all_activity_file").val() != "" && $("#yuva").val() != "" ){
// 		     $(".section0").hide();  
// 			 $(".section1").hide();
// 			 $(".section2").hide();
// 			 $(".section3").hide();
// 			 $(".section4").hide();	
// 			 $(".section5").hide();
// 			 $(".section6").hide();
// 			 $(".section7").show();

// 	}
// 	else{
		
// 			$(".section0").hide();  
// 			 $(".section1").hide();
// 			 $(".section2").hide();
// 			 $(".section3").hide();
// 			 $(".section4").hide();	
// 			 $(".section5").hide();
// 			 $(".section6").show();
// 			 $(".section7").hide();	
// 	}





var step6Validation = function() {
	$(this).scrollTop(0);

if($("#ragaward_source").val()== "")
{
	alert("Please select a source in 'How did you get to know about Ram Avatar Gupt Protsahan'");
        $(".section0").hide();  
		$(".section1").hide();
		$(".section2").hide();
		$(".section3").hide();
		$(".section4").hide();
		$(".section5").hide();
		$(".section6").show();	
		
  }
 else if($("#ragaward_source").val()== "Others" && $("#ragaward_source_other").val()==""){
  	alert("Please enter 'Other Source Name'");
  	$(".section0").hide();  
	 $(".section1").hide();
	 $(".section2").hide();
	 $(".section3").hide();
	 $(".section4").hide();	
	 $(".section5").hide();
	 $(".section6").show();	 

  }
else if(!($('[name=sanmarg_reader]').is(':checked'))){
	alert("Please select an option in 'Are you a regular reader of Sanmarg Hindi Daily?'");
	 $(".section0").hide();  
	 $(".section1").hide();
	 $(".section2").hide();
	 $(".section3").hide();
	 $(".section4").hide();	
	 $(".section5").hide();
	 $(".section6").show();	 
 }

else if($("#ankur_option").val() == ""){

	alert("Please select 'Have you done any exceptional work or participated in any competition?'");
	$(".section0").hide();  
	 $(".section1").hide();
	 $(".section2").hide();
	 $(".section3").hide();
	 $(".section4").hide();	
	 $(".section5").hide();
	 $(".section6").show();	
	 
}
else if($("#ankur_option").val() == "Yes"){
		if($("#ankur_activity_textwork").val() == ""  || $("#ankur_activity_file").val() == ""){
			alert("Please enter all the fields In 'Award Details'");
			 $(".section0").hide();  
			 $(".section1").hide();
			 $(".section2").hide();
			 $(".section3").hide();
			 $(".section4").hide();	
			 $(".section5").hide();
			 $(".section6").show();	

		}
		else if($("input[name='stuclass']:checked").val() == "Class-12"){
			if(!($('[name=rag_participated_chk]').is(':checked'))){
		       alert("Please select 'Did you participate in Ram Awatar Gupt Pratibha Puraskar in class 10?'");
					 $(".section0").hide();  
					 $(".section1").hide();
					 $(".section2").hide();
					 $(".section3").hide();
					 $(".section4").hide();	
					 $(".section5").hide();
					 $(".section6").show();	



			}
			else{
				 $('#fill_section').hide();
			     $(".section0").hide();  
				 $(".section1").hide();
				 $(".section2").hide();
				 $(".section3").hide();
				 $(".section4").hide();	
				 $(".section5").hide();
				 $(".section6").hide();	
				 $(".section7").show();
				 window.scrollTo({
				    top: 0,
				    left: 0,
				    behavior: 'smooth'
				  });	

				}
		}
		
		else{
			$('#fill_section').hide();

		     $(".section0").hide();  
			 $(".section1").hide();
			 $(".section2").hide();
			 $(".section3").hide();
			 $(".section4").hide();	
			 $(".section5").hide();
			 $(".section6").hide();	
			 $(".section7").show();
			 window.scrollTo({
			    top: 0,
			    left: 0,
			    behavior: 'smooth'
			  });	


		  }
								

}
else if($("input[name='stuclass']:checked").val() == "Class-12"){

	if(!($('[name=rag_participated_chk]').is(':checked'))){
       alert("Please select 'Did you participate in Ram Awatar Gupt Pratibha Puraskar in class 10?'");
			 $(".section0").hide();  
			 $(".section1").hide();
			 $(".section2").hide();
			 $(".section3").hide();
			 $(".section4").hide();	
			 $(".section5").hide();
			 $(".section6").show();	



	}
	else{
		 $('#fill_section').hide();
	     $(".section0").hide();  
		 $(".section1").hide();
		 $(".section2").hide();
		 $(".section3").hide();
		 $(".section4").hide();	
		 $(".section5").hide();
		 $(".section6").hide();	
		 $(".section7").show();
		 window.scrollTo({
		    top: 0,
		    left: 0,
		    behavior: 'smooth'
		  });	

		}
}
else{
      $('#fill_section').hide();
     $(".section0").hide();  
	 $(".section1").hide();
	 $(".section2").hide();
	 $(".section3").hide();
	 $(".section4").hide();	
	 $(".section5").hide();
	 $(".section6").hide();	
	 $(".section7").show();
	 window.scrollTo({
	    top: 0,
	    left: 0,
	    behavior: 'smooth'
	  });	


  }


}





// previous button validation 
var step1prevValidation = function(){
	$(".section0").show();
	$(".section1").hide();
	
}
var step2prevValidation = function(){
	$(".section0").hide();
	$(".section1").show();
	$(".section2").hide();
	
}
var step3prevValidation = function(){
	$(".section0").hide();
	$(".section1").hide();
	$(".section2").show();
	$(".section3").hide();
	
}
var step4prevValidation = function(){
	$(".section0").hide();
	$(".section1").hide();
	$(".section2").hide();
	$(".section3").show();
	$(".section4").hide();
	
}
var step5prevValidation = function(){
	

	$(".section0").show();
	$(".section1").show();
	$(".section2").show();
	$(".section3").hide();
	$(".section4").hide();
	$(".section5").hide();
	window.scrollTo({
	    top: 0,
	    left: 0,
	    behavior: 'smooth'
	  });	
	
}
var step6prevValidation = function(){
 	$(".section0").hide();
 	$(".section1").hide();
 	$(".section2").hide();
	$(".section3").show();
 	$(".section4").show();
 	$(".section5").show();
  	$(".section6").hide();
  	window.scrollTo({
	    top: 0,
	    left: 0,
	    behavior: 'smooth'
	  });	
	
}
var step7prevValidation = function(){

	$(".section0").hide();
	$(".section1").hide();
	$(".section2").hide();
	$(".section3").hide();
	$(".section4").hide();
	$(".section5").hide();
	$(".section6").show();
	$(".section7").hide();
	window.scrollTo({
	    top: 0,
	    left: 0,
	    behavior: 'smooth'
	  });	
	
}



// Next Button validation starts
 $('#step0_button').click(step0Validation);

  $('#step1_button').click(step1Validation);
  $('#step2_button').click(step2Validation);
  $('#step3_button').click(step3Validation);
  $('#step4_button').click(step4Validation);
  $('#step5_button').click(step5Validation);
 $('#step6_button').click(step6Validation);
  // $('#step6_button').click(finalValidation);

// /*Next Button validation ends*/
// /*Previous Button validation starts*/
 $('#step1_prevbutton').click(step1prevValidation);
 $('#step2_prevbutton').click(step2prevValidation);
 $('#step3_prevbutton').click(step3prevValidation);
 $('#step4_prevbutton').click(step4prevValidation);
 $('#step5_prevbutton').click(step5prevValidation);
 $('#step6_prevbutton').click(step6prevValidation);
 $('#step7_prevbutton').click(step7prevValidation);
/*Previous Button validation end*/



// //ON CHANGE EVENTS 

$("#disorder").change(function(){
	if($("#disorder").val()== "Physically Challenged"){
	  $(".mental-option-section").hide();
	  $("#mental_disorder").attr("required",false);	
	  $(".physical-option-section").show();
	  $("#phy_disorder").attr("required", true);
	}
	else{
	  $(".physical-option-section").hide(); 	  
	  $("#phy_disorder").attr("required", false);
	  $(".mental-option-section").show();
	  $("#mental_disorder").attr("required", true);
	}
});




// //other source(rag on selection of others)



$("#ragaward_source").change(function(){
	if($("#ragaward_source").val()== "Others"){
		$(".ragaward_source_other").show();		
		$("#ragaward_source_other").attr("required", true);
	}
	else{
		$(".ragaward_source_other").hide();
		$("#ragaward_source_other").attr("required",false);
		
	}
    
});
// //other source(rag hindi pariksha participated)
$("#rag_pariksha_participated").change(function(){
	if($("#rag_pariksha_participated").val()== "Yes"){
	  $(".hindipariksha").show();
	  $("#rag_pariksha_rollno").attr("required",true);
	  $("#rag_pariksha_marks").attr("required",true);	  
	  
	}
	else if($("#rag_pariksha_participated").val()== "No"){	  	 
	  $(".hindipariksha").hide();
	  $("#rag_pariksha_rollno").attr("required",false);
	  $("#rag_pariksha_marks").attr("required",false);	  	  
	}    
});
// ANKUR Option
$("#ankur_option").change(function(){
	if($("#ankur_option").val()== "Yes"){
	  $(".ankur-option-section").show();
	  $("#ankur_activity_textwork").attr("required",true);
	  $("#ankur_activity_file").attr("required",true);
	  $("#all_activity_file").attr("required",true); 	
	  
	}
	else if($("#ankur_option").val()== "No"){	  	 
	  $(".ankur-option-section").hide();
	  $("#ankur_activity_textwork").attr("required",false);
	  $("#ankur_activity_file").attr("required",false);
	  $("#all_activity_file").attr("required",false); 	
	}    
});
//CLASS 10 AND 12 CHANGES MARKS ENTRY AND RAG PARTICIPATED FOR CLASS 12
$('input[type=radio][name=stuclass]').change(function(){
           if ($("input[name='stuclass']:checked").val() == "Class-12") {
                 $(".ragparticipated").show();
				 // $('input[type=radio][name=rag_participated_chk]').attr("required",true);
            }
			else{
				$(".ragparticipated").hide();
				// $('input[type=radio][name=rag_participated_chk]').attr("required",false);
			}
});


// // MARKS BLOCK DISPLAY ON
$('input[type=radio][name=stuclass]').change(function(){
           if ($("input[name='stuclass']:checked").val() == "Class-10") {
			   $("#mark-text-para-1").text("??????????????? ??????????????? 9 ?????? ??????????????? ?????????  ?????? ????????????????????? ????????????/Please fill in your class 9 Hindi marks or percentage");
			   $(".marks-block-1").show();
			   $("#mark-text-para-2").text("??????????????? ??????????????? 10 ?????? ??????????????? ????????? ????????????/Please fill in your class 10 Hindi marks or percentage");
			   $(".marks-block-2").show();
		   }
		   else if($("input[name='stuclass']:checked").val() == "Class-12"){
			   $("#mark-text-para-1").text("??????????????? ??????????????? 11 ?????? ??????????????? ?????????  ?????? ????????????????????? ????????????/Please fill in your class 11 Hindi marks or percentage");
			   $(".marks-block-1").show();
			   $("#mark-text-para-2").text("??????????????? ??????????????? 12 ?????? ??????????????? ?????????  ?????? ????????????????????? ????????????/Please fill in your class 12 Hindi marks or percentage");
			   $(".marks-block-2").show();			   
		   }
});





// //MARKS RANGE 0 TO 100
// To allow value within range between 50 to 100
$("#last_year_marks1").on("change", function() {
    var val = parseInt(this.value);
    if(val > 100 || val < 0)
    {
        alert('Please enter valid Hindi marks');
        this.value ='';        
    }
});
$("#last_year_marks2").on("change", function() {
    var val = parseInt(this.value);
    if(val > 100 || val < 0)
    {
        alert('Please enter valid Hindi marks');
        this.value ='';        
    }
});
$("#last_year_marks3").on("change", function() {
    var val = parseInt(this.value);
    if(val > 100 || val < 0)
    {
        alert('Please enter valid Hindi marks');
        this.value ='';        
    }
});

$("#current_year_marks1").on("change", function() {
    var val = parseInt(this.value);
    if(val > 100 || val < 0)
    {
        alert('Please enter valid Hindi marks');
        this.value ='';        
    }
});
$("#current_year_marks2").on("change", function() {
    var val = parseInt(this.value);
    if(val > 100 || val < 0)
    {
        alert('Please enter valid Hindi marks');
        this.value ='';        
    }
});
$("#current_year_preboards").on("change", function() {
    var val = parseInt(this.value);
    if(val > 100 || val < 0)
    {
        alert('Please enter valid Hindi marks');
        this.value ='';        
    }
});
// // rag pariksha marks
$("#rag_pariksha_marks").on("change", function() {
    var val = parseInt(this.value);
    if(val > 100 || val < 0)
    {
        alert('Please enter valid Hindi marks');
        this.value ='';        
    }
});
// for mobile no
$("#stumobile").on("change", function() {
    var val = parseInt(this.value);
    if(val.toString().length!= 10)
    {
        alert('Please enter a valid Mobile Number');
        this.value ='';        
    }
});


$("#hindi_teacher_mobile").on("change", function() {
    var val = parseInt(this.value);
    if(val!=""){
	    if(val.toString().length!= 10)
	    {
	        alert('Please enter a valid Hindi Teacher Mobile Number');
	        this.value='';        
	    }
	}
});


$("#parentmobile").on("change", function() {
    var val = parseInt(this.value);
    if(val.toString().length!= 10)
    {
        alert('Please enter a valid Parent Mobile Number');
        this.value ='';        
    }
});

$("#emergency_landline").on("change", function() {
    var val = parseInt(this.value);
    if(val!=""){
	    if(val.toString().length!= 10)
	    {
	        alert('Please enter a valid Emergency Mobile Number');
	        this.value ='';        
	    }
	}
});


$("#pincode").on("change", function() {
    var val = parseInt(this.value);
    if(val.toString().length!= 6)
    {
        alert('Please enter a valid pincode');
        this.value ='';        
    }
});







// student email
$("#stuemail").on("change", function() {
	var email=$("#stuemail").val();
     

var first_dot=email.indexOf(".");
var atposition=email.indexOf("@");  
var dotposition=email.lastIndexOf(".");  
var len=email.toString().length;
// alert("@ atom position "+atposition+"& dot position "+dotposition+" and length "+len+"");
if(atposition==""  || atposition<1 || dotposition+2>=len || first_dot<1 || dotposition==""){

  alert("Please enter a valid Email Address");

  this.value ='';  



}
      
});




// file validation


$("#student_photo_file").on("change", function() {
	var file=$('#student_photo_file').val();
    var ext = $('#student_photo_file').val().split('.').pop().toLowerCase();

    var fileSize = $("#student_photo_file")[0].files[0].size;//size in MB

    if($.inArray(ext, ['png','jpg','jpeg','jfif']) == -1) {
       alert('Please upload an acceptable File type and size');
       this.value ='';
    }
    else if(fileSize>1000000){

    	alert('Do not exceed the File size limit (1MB)');
       this.value ='';
    }
    
});



$("#disorder_file").on("change", function() {
	var file=$('#disorder_file').val();
	
    var ext = $('#disorder_file').val().split('.').pop().toLowerCase();

    var fileSize = $("#disorder_file")[0].files[0].size;//size in MB

    if($.inArray(ext, ['pdf','png','jpg','jpeg','jfif']) == -1) {
       alert('Please upload an acceptable File type and size');
       this.value ='';
    }
    else if(fileSize>1000000){

    	alert('Do not exceed the File size limit (1MB)');
       this.value ='';
    }
    
});


$("#hname_file").on("change", function() {
	var file=$('#hname_file').val();
    var ext = $('#hname_file').val().split('.').pop().toLowerCase();

    var fileSize = $("#hname_file")[0].files[0].size;//size in MB

    if($.inArray(ext, ['pdf','png','jpg','jpeg','jfif']) == -1) {
       alert('Please upload an acceptable File type and size');
       this.value ='';
    }
    else if(fileSize>1000000){

    	alert('Do not exceed the File size limit (1MB)');
       this.value ='';
    }
    
});



$("#admit_card_file").on("change", function() {
	var file=$('#admit_card_file').val();
    var ext = $('#admit_card_file').val().split('.').pop().toLowerCase();

    var fileSize = $("#admit_card_file")[0].files[0].size;//size in MB

    if($.inArray(ext, ['pdf','png','jpg','jpeg','jfif']) == -1) {
       alert('Please upload an acceptable File type and size');
       this.value ='';
    }
    else if(fileSize>1000000){

    	alert('Do not exceed the File size limit (1MB)');
       this.value ='';
    }
    
});


$("#ankur_activity_file").on("change", function() {
	var file=$('#ankur_activity_file').val();
    var ext = $('#ankur_activity_file').val().split('.').pop().toLowerCase();

    var fileSize = $("#ankur_activity_file")[0].files[0].size;//size in MB

    if($.inArray(ext, ['pdf','png','jpg','jpeg','jfif']) == -1) {
       alert('Please upload an acceptable File type and size');
       this.value ='';
    }
    else if(fileSize>1000000){

    	alert('Do not exceed the File size limit (1MB)');
       this.value ='';
    }
    
});






// parent email


$("#parentemail").on("change", function() {
	var par_email=$("#parentemail").val();
     

var first_dot=par_email.indexOf(".");
var atposition=par_email.indexOf("@");  
var dotposition=par_email.lastIndexOf(".");  
var len=par_email.toString().length;
// alert("@ atom position "+atposition+"& dot position "+dotposition+" and length "+len+"");
if(atposition==""  || atposition<1 || dotposition+2>=len || first_dot<1 || dotposition==""){

  alert("Please enter a valid Guardian Email Address");

  this.value ='';  



}
      
});





// //pincode is only number
// // To allow only numbers
$('#pincode').keydown(function (e) {
	if (e.shiftKey || e.ctrlKey || e.altKey) {
		e.preventDefault();
	} else {
	var key = e.keyCode;
		if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 48 && key <= 57)      || (key >= 96 && key <= 105))) {
			e.preventDefault();
		}
	}
});









//OTHER SCHOOL NAME OPTION CHANGE
$("#schoolname").change(function(){
	if($("#schoolname").val()=="others"){
		$(".other-school-section").show();
		$("#other_school_name").attr("required",true);
	    $("#other_school_address").attr("required",true);
		// $(".school-section").hide();
		$("#schoolname").attr("required",false);
	    $("#school_address").attr("required",false);
				
	}
	else{
		$(".other-school-section").hide();
		$("#other_school_name").attr("required",false);
	    $("#other_school_address").attr("required",false);
		$(".school-section").show();
		$("#schoolname").attr("required",true);
	    $("#school_address").attr("required",true);
	}
			
});



// //OTHER hindi incorrect NAME OPTION CHANGE
$('input[type=radio][name=radHindiName]').change(function(){
	if($('input[name="radHindiName"]:checked').val()== "No"){
		$(".hindi-section-name").show();
		$("#hname_file").attr("required",true);		
	}
	else{
		$(".hindi-section-name").hide();
		$("#hname_file").attr("required",false);
	}
	
});




$('#location').on("change",function(){

   var location=$('#location').val();
    var board_name=$('#boardexam').val();
   
   // alert(board);
   $.ajax({
            type: "POST",         
            url: "ajax/get_board.php",
            // async: true,
            // datatype: "JSON",
            data: {

	          location: location,
	          board_name:board_name
	          
	          
	        },
	   
            success: function(data)
           {
                    // var html = '<option value="">Select School</option>';

                    // for(var i = 0; i <data.length; i++)
                    // {

                    //     html += '<option value="'+data[i]+'">'+data[i]+'</option>';

                    // }
                    // html+='<option value="Others">OTHERS</option>'

                    $('#schoolname').html(data);
                    console.log(data);
           }
       });




})


$('#boardexam').on("change",function(){

   var location=$('#location').val();
    var board_name=$('#boardexam').val();
   
   // alert(board);
   $.ajax({
            type: "POST",         
            url: "ajax/get_board.php",
            // async: true,
            // datatype: "JSON",
            data: {

	          location: location,
	          board_name:board_name
	          
	          
	        },
	   
            success: function(data)
           {
                    // var html = '<option value="">Select School</option>';

                    // for(var i = 0; i <data.length; i++)
                    // {

                    //     html += '<option value="'+data[i]+'">'+data[i]+'</option>';

                    // }
                    // html+='<option value="Others">OTHERS</option>'

                    $('#schoolname').html(data);
                    console.log(data);
           }
       });




})




// //hindi first name translation
$('#fname').on('input', function(){
 $.ajax({
            type: "GET",
            url: "ajax/bingtranslation.php?word="+$("#fname").val(),
            success: function(data){
               $("#hname").val(data);
           }
       });

});


// //hindi surname  translation
$('#lname').on('input', function(){
 $.ajax({
            type: "GET",
            url: "ajax/bingtranslation.php?word="+$("#lname").val(),
            success: function(data){
               $("#hlname").val(data);
           }
       });

});

// School address automatic in the field
$("#schoolname").change(function(){
	var school=$("#schoolname").val();
	if(school!="others"){
            $.ajax({
              type: "GET",
              url: "ajax/ajaxGetSchoolAddressInfo.php?school="+school,
              success: function(data){
                 $("#school_address").val(data);
             }
			}); //end of $.ajax

        }else{
        	$("#school_address").val("OTHERS");
        }
	
	
});

// for only kolkataa
$("#location").change(function(){
	if($("#location").val()=="1"){
		$(".student_skill").show();
		$("#submit_type").attr("required",true);
	    $("#extempore_date_checkbox").attr("required",true);
		
				
	}
	else{
		$(".student_skill").hide();
		$("#submit_type").attr("required",false);
	    $("#extempore_date_checkbox").attr("required",false);
		
	}
			
});







});// end of document ready




</script>


 </body>
</html>