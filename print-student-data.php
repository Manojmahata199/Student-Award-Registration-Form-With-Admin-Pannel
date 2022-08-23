<?php
$id = $_GET['id'];
include('database.php');
$sql="SELECT * FROM `student_data` WHERE `id` = '$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);


if($row==""){
	exit;
}


//Storing values
$boardName=$row['boardexam'];
/*** get school name*/


if($row['school_name'] =="")
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
if($row["yuva"] =="")
{ 
$yuva="No"; 
} else { 
$yuva="Yes"; 
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

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- <link rel="shortcut icon" type="image/x-icon" ng-href="favicon.ico"> -->
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no" />
  <link href="https://fonts.googleapis.com/css?family=Noto+Serif|Open+Sans|Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/email-style.css" />
  <title>Student Registration Form 2020</title>   
</head>
<body>
  <div class="pdfsection-mail">
	<table>
		<tr>


			<td valign="top">
				<img id="pdf-left-logo" src="images/pdf-email-left.png">
			</td>



			<td valign="top">
				<table id="pdf-reg-email" class="pdf-email">
				<thead>
				<tr><th colspan="2"><h2><span class="eng-label">Ram Awatar Gupt Pratibha Puraskar - 2020</span><br/><span class="hindi-label">राम अवतार गुप्त प्रतिभा पुरस्कार – 2020</span></h2></th></tr>
				<tr><th colspan="2"><h4><span class="eng-label">Registration Confirmation Form</span><span class="hindi-label">(स्वीकृत प्रपत्र)</span><br/><span class="eng-label">Temporary Registration Number:<span class="high-light"><?php echo 'T-'.$boardName.'-'.$row['reg_id'];?></span></span><br><span class="hindi-label">(रजिस्ट्रीकरण क्रमांक नंबर)</span></h4></th></tr>
				</thead>
				<tbody>
				<tr><td><span class="hindi-label">रजिस्ट्रेशन (परीक्षा क्षेत्र)</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['reg_location'];?></span></td></tr>
				<tr><td><span class="eng-label">Registering For</span></td></tr>
				<tr><td><span class="hindi-label">पूरा नाम (अंग्रेजी)</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['fname'].' '.$row['lname']; ?></span></td></tr>
				<tr><td><span class="eng-label">Full Name in (English)</span></td></tr>
				<tr><td><span class="hindi-label">पूरा नाम (हिंदी)</span></td><td rowspan="2"><span class="hindi-label"><?php echo $row['hname'].' '.$row['hlname']?></span></td></tr>
				<tr><td><span class="eng-label">Full Name in (Hindi)</span></td></tr>
				<tr><td><span class="hindi-label">लिंग</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['student_gender']; ?></span></td></tr>
				<tr><td><span class="eng-label">Gender</span></td></tr>
				<tr><td><span class="hindi-label">जन्म तिथि</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['student_dob']; ?></span></td></tr>
				<tr><td><span class="eng-label">Date of Birth</span></td></tr>
				<tr><td><span class="hindi-label">ई-मेल</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['student_email']; ?></span></td></tr>
				<tr><td><span class="eng-label">Email Id</span></td></tr>
				<tr><td><span class="hindi-label">मोबाइल नंबर</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['student_mobile']; ?></span></td></tr>
				<tr><td><span class="eng-label">Mobile No</span></td></tr>
				<tr><td><span class="hindi-label">बोर्ड परीक्षा</span></td><td rowspan="2"><span class="eng-label"><?php echo $boardName; ?></span></td></tr>
				<tr><td><span class="eng-label">Board exam appeared for</span></td></tr>
				<tr><td><span class="hindi-label">बोर्ड क्रमांक नं</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['board_roll_no']; ?></span></td></tr>
				<tr><td><span class="eng-label">Board Roll No</span></td></tr>
				<tr><td><span class="hindi-label">स्कूल का पूरा नाम</span></td><td rowspan="2"><span class="eng-label"><?php echo $schoolName?></span></td></tr>
				<tr><td><span class="eng-label">School Full Name</span></td></tr>
				<tr><td><span class="hindi-label">स्कूल का पता</span></td><td rowspan="2"><span class="eng-label"><?php echo $schoolAddress?></span></td></tr>
				<tr><td><span class="eng-label">School Address</span><hr></td></tr>
				<tr><td><span class="hindi-label">अभिभावक का नाम</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['parent_name']; ?></span></td></tr>
				<tr><td><span class="eng-label">Parent / Guardian name</span></td></tr>
				<tr><td><span class="hindi-label">अभिभावक का फोन नं</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['parent_mobile']; ?></span></td></tr>
				<tr><td><span class="eng-label">Parent / Guardian mobile No</span></td></tr>
				<tr><td><span class="hindi-label">इमरजेंसी दूरभाष</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['emergency_landline']; ?></span></td></tr>
				<tr><td><span class="eng-label">Emergency landline No</span></td></tr>
				<tr><td><span class="hindi-label">अभिभावक का ई-मेल</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['parent_email']; ?></span></td></tr>
				<tr><td><span class="eng-label">Parent / Guardian email id</span></td></tr>
				<tr><td><span class="hindi-label">अभिभावक का पता</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['home_address']; ?></span></td></tr>
				<tr><td><span class="eng-label">Parent / Guardian Address</span></td></tr>
				<tr><td><span class="hindi-label">शहर</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['city'];?></span></td></tr>
				<tr><td><span class="eng-label">City</span></td></tr>
				<tr><td><span class="hindi-label">राज्य</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['state'];?></span></td></tr>
				<tr><td><span class="eng-label">State</span></td></tr>
				<tr><td><span class="hindi-label">पिन कोड</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['pincode']; ?></span></td></tr>
				<tr><td><span class="eng-label">Pincode</span></td></tr>
				<tr><td><span class="hindi-label">कक्षा 10 में राम अवतार गुप्त पुरस्कार प्राप्त हुआ</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['rag_participated_chk'];?></span></td></tr>
				<tr><td><span class="eng-label">Received Ram Awatar Gupt Pratibha Puraskar in class 10</span></td></tr>
				<tr><td><span class="hindi-label">प्री-बोर्ड / सिलेक्शन परीक्षा में हिंदी में प्राप्त अंक</span></td><td rowspan="2"><span class="eng-label"><?php echo (int) $row['current_year_preboards'];?></span></td></tr>
				<tr><td><span class="eng-label">Pre Board/ Selection Marks in Hindi Subject</span></td></tr>
				<tr><td><span class="hindi-label">क्या आपने राम अवतार गुप्त हिंदी परीक्षा 2020 दी थी ?</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['rag_pariksha_participated'];?></span></td></tr>
				<tr><td><span class="eng-label">Have you participated in Ram Awatar Gupt Hindi Pariksha 2020?</span></td></tr>
				<tr><td><span class="hindi-label">अपराजय</span></td><td rowspan="2"><span class="eng-label"><?php if($row['category'] == "Aparajay"){ echo 'Yes'; } else { echo 'No'; }?></span></td></tr>
				<tr><td><span class="eng-label">Aparajay</span></td></tr>
				<tr><td><span class="hindi-label">अंकुर</span></td><td rowspan="2"><span class="eng-label"><?php if($row['ankur'] ==""){ echo 'No'; } else { echo 'Yes'; }?></span></td></tr>
				<tr><td><span class="eng-label">Ankur</span><hr></td></tr>
				<tr><td><span class="hindi-label">युवा का हिस्सा बनना चाहेंगे</span></td><td rowspan="2"><span class="eng-label"><?php if($row['yuva'] ==""){ echo 'No'; } else { echo 'Yes'; }?></span></td></tr>
				<tr><td><span class="eng-label">Would like to be a part of Yuva?</span><hr></td></tr>
				<tr><td><span class="hindi-label">फेसबुक हैंडल</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['facebook_handle']; ?></span></td></tr>
				<tr><td><span class="eng-label">Facebook Handle</span></td></tr>
				<tr><td><span class="hindi-label">ट्विटर हैंडल</span></td><td rowspan="2"><span class="eng-label"><?php echo $row['twitter_handle']; ?></span></td></tr>
				<tr><td><span class="eng-label">Twitter Handle</span></td></tr>
				<tr><td><span class="hindi-label">अपलोड किए गए दस्तावेज</span></td><td rowspan="2"><span class="eng-label">
					      <?php if($row['disorder_file'] != "") 
				        { ?>
									Aparajay Documents <br/>
								<?php } ?>
											<?php if($row['hname_file'] != "") { ?>
												Hindi Correct File Name <br/>
											<?php } ?>
                                <?php if($row['student_photo_file'] != "") { ?>
																		Student Photo Identity <br/>
																	<?php } ?>
																				<?php if($row['admit_card_file'] != "") { ?>
																					Admit Card <br/>
																				<?php } ?>
                                              <?php if($row['ankur_activity_file'] != "") { ?>
																									Ankur Activity <br/>
																								<?php } ?>								
																											<?php if($row['marksheet_file'] != "") { ?>
																												Board Marksheet <br/>
																											<?php } ?></span></td></tr>
				                                                             <tr><td><span class="eng-label">Relevant Documents Uploaded</span></td></tr>	
				</tbody>		
				</table>				
			</td>



			<td valign="top">
				<img id="pdf-right-logo" src="images/pdf-email-right.png">
			</td>


		</tr>
	</table>
  </div>
</body>
</html>
