<?php
ob_start();
require_once "config.php";

require('vendor2/autoload.php');


require 'lib/mpdf/mpdf.php';
//require 'lib/mpdf/Mpdf.php';


require 'lib/PHPMailer/class.phpmailer.php';
require 'lib/PHPMailer/class.smtp.php';
require 'lib/PHPMailer/PHPMailerAutoload.php';
//send email to verified 
//if student record delete button is submitted
if(isset($_POST['bulk_delete_submit'])){
//if id arrray is not empty
if(!empty($_POST['checked_id'])){
//Get all the selected ids and convert it to a string
$idStr=implode(',',$_POST['checked_id']);
//Delete records from the database
$delete="DELETE FROM `student_data` WHERE `id` IN ($idStr)";
//If delete is successful
if($result = mysqli_query($conn, $delete)){
	$statusMsg='Selected students have been deleted successfully';
}
else{
	$statusMsg='Some problem occured please try again';
}

}
else{
	
	$statusMsg='Select atleast one record';
	
}	
}
//if school record delete button is submitted
if(isset($_POST['bulk_schdelete_submit'])){
//if id arrray is not empty
if(!empty($_POST['checked_id'])){
//Get all the selected ids and convert it to a string
$idStr=implode(',',$_POST['checked_id']);
//Delete records from the database
$delete="DELETE FROM `school_list` WHERE `id` IN ($idStr)";
//If delete is successful
if($result = mysqli_query($conn, $delete)){
	$statusMsg='Selected school have been deleted successfully';
}
else{
	$statusMsg='Some problem occured please try again';
}

}
else{
	
	$statusMsg='Select atleast one record';
	
}	
}
//Insert New School name and School Address
if(isset($_POST['add-school-submit'])){
//if id arrray is not empty
if(!empty($_POST['school-name'])&& !empty($_POST['school-address']) ){
$schoolname=$_POST['school-name'];
$school_address=$_POST['school-address'];	
//Insert School record to the database
$insert="insert into `school_list`(`id`,`school_name`,`school_address`) values 
(default,'$schoolname', '$school_address');";
//If insert is successful
if($result = mysqli_query($conn, $insert)){
	$statusMsg='School Record is inserted successfully';
}
else{
	$statusMsg='Some problem occured please try again';
}

}
else{
	
	$statusMsg='Select atleast one record';
	
}		
	
}	

// bulk verify
if(isset($_POST['bulk_verify_submit'])){
//if id arrray is not empty
if(!empty($_POST['checked_id'])){
//Get all the selected ids and convert it to a string
$idStr=implode(',',$_POST['checked_id']);
//Udate records from the database
$verify="UPDATE `student_data` SET `verified` ='yes' WHERE `id` IN ($idStr)";
//If update is successful
if($result = mysqli_query($conn, $verify)){
	$statusMsg='Selected students documents have been verified successfully';
}
else{
	$statusMsg='Some problem occured please try again';
}

}
else{
	
	$statusMsg='Select atleast one record';
	
}	
	
	
	
}
// bulk not verify
if(isset($_POST['bulk_notverify_submit'])){
	//if id arrray is not empty
if(!empty($_POST['checked_id'])){
//Get all the selected ids and convert it to a string
$idStr=implode(',',$_POST['checked_id']);
//Udate records from the database
$verify="UPDATE `student_data` SET `verified` ='no' WHERE `id` IN ($idStr)";
// If update is successful
if($result = mysqli_query($conn, $verify)){
	$statusMsg='Selected students marked not verified successfully';
}
else{
	$statusMsg='Some problem occured please try again';
}

}
else{
	
	$statusMsg='Select atleast one record';
	
}	
}
// email to verified student
if(isset($_POST['bulk_email_submit'])){
//if id arrray is not empty
    if(!empty($_POST['checked_id'])){
    //Get all the selected ids and convert it to a string
    $idStr=implode(',',$_POST['checked_id']);
    //Email student from the database
    $sql="SELECT * from `student_data` WHERE `id` IN ($idStr)";
    //If selected successful
	if($result = mysqli_query($conn, $sql)){
    	if (mysqli_num_rows($result) > 0){
    		while($row = mysqli_fetch_assoc($result)){
    		    
    		      $stu_id=$row['id'];
    		      $namefor_pdf="".$row['fname']." ".$row['lname']."";
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    // 		            $timezone=date_default_timezone_set("Asia/Calcutta");
				//         $printed_date = date('Y-m-d H:i:s');


				// 	    // //email part 


				// 	      $name=$fname." ".$lname;
						
				// 	    
						//$page_url =('http://rag.sanmarg.in/print-student-data.php?id='.$last_id.''); // to grab the current url
						//$html = file_get_contents($page_url);

				// 			include('database.php');
							$sql="SELECT * FROM `student_data` WHERE `id` ='$stu_id'";
							$result=mysqli_query($conn,$sql);
							$row2=mysqli_fetch_assoc($result);


							if($row2==""){
								exit;
							}


				// 			//Storing values
							$boardName=$row2['boardexam'];
				// 			/*** get school name*/


							if($row2['school_name'] =="others")
							{ 
								$schoolName = $row2['other_school_name'];
								$schoolAddress = $row2['other_school_address'];
							}
							else
							{ 
								
								$schoolName = $row2['school_name'];
								$schoolAddress = $row2['school_address'];
							}


							if($row2["category"] == "Aparajay")
							{ 
							 $category="Yes"; 
							} else { 
							 $category="No"; 
							}
							if($row2["ankur"] =="")
							{ 
								$ankur="No"; 
							} else { 
								$ankur="Yes"; 
							}
							
							if($row2["disorder_file"] != "") 
					        { 
								$aparajay="Aparajay Documents"; 
							}
							 if($row2["hname_file"] != "") 
							{ 
								$hname_file="Hindi Correct File Name";
							}
							if($row2["student_photo_file"] != "") 
							{ 
								$stu_pic_iden="Student Photo Identity";
							}
							if($row2["admit_card_file"] != "") 
							{ 
								$admit_card="Admit Card";
						    }
						    if($row2["ankur_activity_file"] != "")
						    {
								$ankur_activ="Ankur Activity"; 
						    }
						    if($row2["marksheet_file"] != "") 
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
												   <span class="hindi-label" style="text-align: center;align-content: center;align-items: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;राम अवतार गुप्त प्रोत्साहन– 2022</h1></h1></th></tr>
				                                     <br>  <br>  								  
												   
												<tr><th colspan="2"><h4>
												  <span class="eng-label" style="text-align: center;align-content: center;align-items: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration Confirmation Form</span>
												  <span class="hindi-label" style="text-align: center;align-content: center;align-items: center;">(स्वीकृत प्रपत्र)</span><br/><span class="eng-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unique Roll Number:<span class="high-light">T-'.$boardName.'-'.$row2["reg_id"].'</span></span><br><span class="hindi-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     (यूनिक रोल नंबर)</span></h4></th></tr>
										        <br>  <br>  <br>  
				    						       
										        
										        </thead>
												<tbody>
												<tr><td><span class="hindi-label">रजिस्ट्रेशन (परीक्षा क्षेत्र)</span></td><td rowspan="2"><span class="eng-label">'.$row2["reg_location"].'</span></td></tr>
												<tr><td><span class="eng-label">Registering For</span></td></tr>
												<tr><td><span class="hindi-label">पूरा नाम (अंग्रेजी)</span></td><td rowspan="2"><span class="eng-label">'.$row2["fname"].' '.$row2["lname"].'</span></td></tr>
												<tr><td><span class="eng-label">Full Name in (English)</span></td></tr>
												<tr><td><span class="hindi-label">पूरा नाम (हिंदी)</span></td><td rowspan="2"><span class="hindi-label">'.$row2["hname"].' '.$row2["hlname"].'</span></td></tr>
												<tr><td><span class="eng-label">Full Name in (Hindi)</span></td></tr>
												<tr><td><span class="hindi-label">लिंग</span></td><td rowspan="2"><span class="eng-label">'.$row2["student_gender"].'</span></td></tr>
												<tr><td><span class="eng-label">Gender</span></td></tr>
												<tr><td><span class="hindi-label">जन्म तिथि</span></td><td rowspan="2"><span class="eng-label">'.$row2["student_dob"].'</span></td></tr>
												<tr><td><span class="eng-label">Date of Birth</span></td></tr>
												<tr><td><span class="hindi-label">ई-मेल</span></td><td rowspan="2"><span class="eng-label">'.$row2["student_email"].'</span></td></tr>
												<tr><td><span class="eng-label">Email ID</span></td></tr>
												<tr><td><span class="hindi-label">मोबाइल नंबर</span></td><td rowspan="2"><span class="eng-label">'.$row2["student_mobile"].'</span></td></tr>
												<tr><td><span class="eng-label">Mobile Number</span></td></tr>
												<tr><td><span class="hindi-label">बोर्ड परीक्षा</span></td><td rowspan="2"><span class="eng-label">'.$boardName.'</span></td></tr>
												<tr><td><span class="eng-label">Board exam appeared for</span></td></tr>
												<tr><td><span class="hindi-label">बोर्ड रोल नंबर</span></td><td rowspan="2"><span class="eng-label">'.$row2["board_roll_no"].'</span></td></tr>
												<tr><td><span class="eng-label">Board Roll Number</span></td></tr>


												 <tr><td><span class="hindi-label">कक्षा*</span></td><td rowspan="2"><span class="eng-label">'.$row["class"].'</span></td></tr>
												<tr><td><span class="eng-label">Class</span></td></tr>
												
												 <tr><td><span class="hindi-label">आपके विद्यालय का पठन माध्यम*</span></td><td rowspan="2"><span class="eng-label">'.$row2["school_medium"].'</span></td></tr>
												<tr><td><span class="eng-label">medium of instruction in your school</span></td></tr>


												<tr><td><span class="hindi-label">स्कूल का पूरा नाम</span></td><td rowspan="2"><span class="eng-label">'.$schoolName.'</span></td></tr>
												<tr><td><span class="eng-label">School Full Name</span></td></tr>
												<tr><td><span class="hindi-label">स्कूल का पता</span></td><td rowspan="2"><span class="eng-label">'.$schoolAddress.'</span></td></tr>
												<tr><td><span class="eng-label">School Address</span><hr></td></tr>



												 <tr><td><span class="hindi-label">हिंदी शिक्षक का नाम*</span></td><td rowspan="2"><span class="eng-label">'.$row2["hnd_tech_name"].'</span></td></tr>
												<tr><td><span class="eng-label">Hindi Teacher Name</span></td></tr>

												<tr><td><span class="hindi-label">हिंदी शिक्षक मोबाइल नंबर</span></td><td rowspan="2"><span class="eng-label">'.$row2["hnd_tech_mob"].'</span></td></tr>
												<tr><td><span class="eng-label">Hindi Teacher Mobile Number</span></td></tr>


												
												<tr><td><span class="hindi-label">अभिभावक का नाम</span></td><td rowspan="2"><span class="eng-label">'.$row2["parent_name"].'</span></td></tr>
												<tr><td><span class="eng-label">Parent / Guardian name</span></td></tr>
												<tr><td><span class="hindi-label">अभिभावक का फोन नंबर</span></td><td rowspan="2"><span class="eng-label">'.$row2["parent_mobile"].'</span></td></tr>
												<tr><td><span class="eng-label">Parent / Guardian Mobile Number</span></td></tr>
												<tr><td><span class="hindi-label">इमरजेंसी दूरभाष नंबर</span></td><td rowspan="2"><span class="eng-label">'.$row2["emergency_landline"].'</span></td></tr>
												<tr><td><span class="eng-label">Emergency landline Number</span></td></tr>
												<tr><td><span class="hindi-label">अभिभावक का ई-मेल</span></td><td rowspan="2"><span class="eng-label">'.$row2["parent_email"].'</span></td></tr>
												<tr><td><span class="eng-label">Parent / Guardian Email ID</span></td></tr>
												<tr><td><span class="hindi-label">अभिभावक का पता</span></td><td rowspan="2"><span class="eng-label">'.$row2["home_address"].'</span></td></tr>
												<tr><td><span class="eng-label">Parent / Guardian Address</span></td></tr>
												<tr><td><span class="hindi-label">शहर</span></td><td rowspan="2"><span class="eng-label">'.$row2["city"].'</span></td></tr>
												<tr><td><span class="eng-label">City</span></td></tr>
												<tr><td><span class="hindi-label">राज्य</span></td><td rowspan="2"><span class="eng-label">'.$row2["state"].'</span></td></tr>
												<tr><td><span class="eng-label">State</span></td></tr>
												<tr><td><span class="hindi-label">पिन कोड</span></td><td rowspan="2"><span class="eng-label">'.$row2["pincode"].'</span></td></tr>
												<tr><td><span class="eng-label">Pincode</span></td></tr>
												<tr><td><span class="hindi-label">कक्षा 10 में राम अवतार गुप्त पुरस्कार प्राप्त हुआ</span></td><td rowspan="2"><span class="eng-label">'.$row2["rag_participated_chk"].'</span></td></tr>
												<tr><td><span class="eng-label">Received Ram Awatar Gupt Pratibha Puraskar in class 10</span></td></tr>
												<tr><td><span class="hindi-label">प्री-बोर्ड / सिलेक्शन परीक्षा में हिंदी में प्राप्त अंक</span></td><td rowspan="2"><span class="eng-label">'.$row2["current_year_preboards"].'</span></td></tr>
												<tr><td><span class="eng-label">Pre-Board / Selection Marks in Hindi Subject</span></td></tr>
												
												<tr><td><span class="hindi-label">अपराजय</span></td><td rowspan="2"><span class="eng-label">'.$category.'</span></td></tr>

												<tr><td><span class="eng-label">Aparajay</span></td></tr>
												<tr><td><span class="hindi-label">अंकुर</span></td><td rowspan="2"><span class="eng-label">'.$ankur.'	</span></td></tr>
												<tr><td><span class="eng-label">Ankur</span><hr></td></tr>


												


												
												<tr><td><span class="hindi-label">फेसबुक हैंडल</span></td><td rowspan="2"><span class="eng-label">'.$row2["facebook_handle"].'</span></td></tr>
												<tr><td><span class="eng-label">Facebook Handle</span></td></tr>
												<tr><td><span class="hindi-label">इंस्टाग्राम हैंडल</span></td><td rowspan="2"><span class="eng-label">'.$row2["twitter_handle"].'</span></td></tr>
												<tr><td><span class="eng-label">Instagram Handle</span></td></tr>
												<tr><td><span class="hindi-label">अपलोड किए गए दस्तावेज</span></td><td rowspan="2"><span class="eng-label">

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

							 //$dir = 'uploads/'.$last_id.'/registration-data';

							 // $file='uploads/'.$last_id.'/pdf_file/file'.$last_id.'.pdf';

							 $file='uploads/file'.$row['id'].'.pdf';


							$mpdf->output($file,'F');
						    $emailAttachment=$mpdf->Output($file, 'S');
							//D
							//I
							//F
							//S
						


    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		    
    		//email part 
		  

         $name=$row['fname']." ".$row['lname'];
		  $stuemail=$row['student_email'];
		  $boardexam=$row['boardexam'];
		  $registrationId="T-".$row['boardexam']."-".$row['reg_id']."";
		  //$emailAttachment="../uploads/file".$row['id'].".pdf";
		  //$class=substr($row['class'], -2);
		 

		  $mail = new PHPMailer(true);
		   $mail->isSMTP(); 
		  //  $mail->SMTPDebug =3; 


		   $mail->Host = 'smtp.gmail.com';   // Specify main and backup SMTP servers
            $mail->Debugoutput = 'html';
            $mail->SMTPAuth = true;  


		 $mail->Username = 'ragpp@sanmarg.in';                 // SMTP username
         $mail->Password = 'SanRag@9812sx';                           // SMTP password
         $mail->SMTPSecure = 'tls';                           // Enable encryption, 'ssl' also accepted
         $mail->CharSet = "UTF-8";
         $mail->Port = 587;

          $mail->From = 'ragpp@sanmarg.in';
          $mail->FromName = 'Ram Awatar Gupt Protsahan-2022';



		  // $mail->SMTPDebug =0;                   
		  // $mail->isSMTP();
		  // $mail->Host = 'smtp.gmail.com';
		  // $mail->SMTPAuth = true;                               
          //$mail->Username = 'rag14.sanmargfoundation@gmail.com';                
          //$mail->Password = 'Sanrag@1234';
		  // $mail->Username = 'priya.sanmarg@gmail.com';                
		  // $mail->Password = 'san#prinm(*77'; 		
    //       $mail->SMTPSecure = 'ssl';                           
    //       $mail->Port = 465;	


          // $mail->setFrom('manojmahata.mid@gmail.com', 'RamAvtar Gupt Pratibha Purskar 2020');
          $mail->addAddress($stuemail, 'Ragp Welcome User 2022');                     
          $mail->addReplyTo('ragpp@sanmarg.in', 'RAGP 2022 Information');  


          $mail->isHTML(true); 
          $mail->WordWrap = 50;  


          $mail->Subject = 'Welcome Student to Ragp 2022 Mail';
		  // Convert HTML into a basic plain-text alternative body
          $msgBody=file_get_contents('welcome-email.html');
          $msgBody=str_ireplace("EMAILLOGO", 'images/RAGLOGO_2022.png', $msgBody);
          $msgBody=str_ireplace("REGNAME", $name, $msgBody);
          $msgBody=str_ireplace("REGNUMBER",$registrationId,$msgBody);
           $msgBody=str_ireplace("STUEMAIL",$stuemail,$msgBody);
           $mail->AddEmbeddedImage('images/RAGLOGO_2022.png','LOGO');
           
           
           
            $mail->AddStringAttachment($emailAttachment,'ragp-form-2022.pdf','base64','application/pdf');	


          // $mail->msgHTML($msgBody, dirname(__FILE__));

           $mail->Body=$msgBody;

           $mail->SMTPOptions = array(
                  'ssl' => array(
                      'verify_peer' => false,
                      'verify_peer_name' => false,
                      'allow_self_signed' => true
                  )
              );
              
              
              
              
    		 if(!$mail->send()) {
        			$statusMsg= 'Message could not be sent.';
        			
    		} else {
       				  $statusMsg= 'Email has been sent successfully';
    		}
    		
    		
    		 
		
		
		}	
	
	  }
	}
    else{
    	
    	$statusMsg='Some problem occured please try again';
    }

}
else{
	
	$statusMsg='Select atleast one record';
	
}		

	
}			
// bulk qualify
if(isset($_POST['bulk_qualify_submit'])){
	//if id arrray is not empty
if(!empty($_POST['checked_id'])){
//Get all the selected ids and convert it to a string
$idStr=implode(',',$_POST['checked_id']);
//Udate records from the database
$verify="UPDATE `student_data` SET `qualified` ='yes' WHERE `id` IN ($idStr)";
//If update is successful
if($result = mysqli_query($conn, $verify)){
	$statusMsg='Selected students documents have been qualified successfully';
}
else{
	$statusMsg='Some problem occured please try again';
}

}
else{
	
	$statusMsg='Select atleast one record';
	
}	
	
	
	
}
// bulk disqualify
if(isset($_POST['bulk_disqualify_submit'])){
	//if id arrray is not empty
if(!empty($_POST['checked_id'])){
//Get all the selected ids and convert it to a string
$idStr=implode(',',$_POST['checked_id']);
//Udate records from the database
$verify="UPDATE `student_data` SET `qualified` ='no' WHERE `id` IN ($idStr)";
//If update is successful
if($result = mysqli_query($conn, $verify)){
	$statusMsg='Selected students documents have been qualified successfully';
}
else{
	$statusMsg='Some problem occured please try again';
}

}
else{
	
	$statusMsg='Select atleast one record';
	
}	
}

?>