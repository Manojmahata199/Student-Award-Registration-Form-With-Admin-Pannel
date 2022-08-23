<?php
ob_start();

session_start();




if($_SESSION['reg_id']){

include('database.php');
$error_msg="";
$msg="";
$m="";
$n="";


$id=$_SESSION['id'];
$reg_id=$_SESSION['id'];
$student_email=$_SESSION['student_email'];
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];


$sql="SELECT * FROM `student_data` WHERE `id`='$id' and `student_email`='$student_email'";
$query=mysqli_query($conn,$sql);
$row=mysqli_num_rows($query);
if($row>0){
	$res=mysqli_fetch_assoc($query);
}
else{
	$res="";
}

if(isset($_POST['upload_submit'])){

  $stu_reg_id=$res['reg_id']; 
  $board_total_mark=$_POST['board_total_mark'];
  $board_hindi_mark=$_POST['board_hindi_mark'];
  $board_hindi_mark_perc=$_POST['board_hindi_mark_perc'];
  
  

	
	    if(isset($_FILES['Stu_marksheet']))
			{


				$Stu_marksheet_name=$_FILES['Stu_marksheet']['name'];
        $Stu_marksheet_path=$_FILES['Stu_marksheet']['tmp_name'];


				if (!file_exists('$target_dir'.$id.'/marksheet_img/')) {
	    			mkdir('uploads/'.$id.'/marksheet_img/', 0777, true);
					}
				$target_dir = "uploads/".$id."/marksheet_img/";
				$target_file = $target_dir.$_FILES["Stu_marksheet"]["name"];
				$uploadOk = 1;


				
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				// Check if image file is a actual image or fake image
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	        	&& $imageFileType != "pdf" ) {
						$error_msg="Uploaded Marksheet File Is An Invalid";
						$uploadOk = 0;
				}
				// Check file size
				// if ($_FILES["Stu_marksheet"]["size"] > 1000000) {
		  //  			$error_msg= "Sorry, your Marksheet File is too large.";
		  //  		 	$uploadOk = 0;
				// }
				if($uploadOk ==0){
				   $error_msg="Your Marksheet File Was Not uploaded";
				}
				else
				{
					if($uploadOk ==1)
					{
					    $m=move_uploaded_file($_FILES["Stu_marksheet"]["tmp_name"], $target_file);
					    if($m==1){


					    	$sql="UPDATE `student_data` SET `marksheet_file`='$Stu_marksheet_name',`board_total_mark`='$board_total_mark',`board_hindi_mark`='$board_hindi_mark',
					    	`Board_hindi_mark_percent`='$board_hindi_mark_perc' WHERE `id`='$id' and `reg_id`='$stu_reg_id'";

					    	$result=mysqli_query($conn,$sql);

					    	if($result){

					    		$msg="Your Markshit Is Submitted Successfully";
					    	}
					    }		

					    
					}
				}
			}




	

			ob_end_clean();

	


}


 ?>
<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/A.style.css.pagespeed.cf.eQk9-CoeFP.css">
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RAGP Registration Form 2022</title>
	 <!-- add icon link -->
        <link rel = "icon" href ="images/RAGLOGO_2022.png" type = "image/x-icon">

    <!-- Font Icon -->	  
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel = "Stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
		
    <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" type="text/css" href="css/email-style.css">
    <!--<link rel="stylesheet" type="text/css" href="css/style2.css.map">-->
    <link rel="stylesheet" type="text/css" href="css/style_four.css">
     <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    
    <link rel="stylesheet" type="text/css" href="css/email-style.css" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
     <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
 
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
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
      <script src="https://kit.fontawesome.com/9430a00aa9.js" crossorigin="anonymous"></script>


	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script type="text/javascript" src="js2/jquery-3.6.0.min.js"></script>
 <style>


 	
	
	.form-control{

		font-size: 17px;
	}
	.form-select{
		font-size: 15px;
	}

    .cascading-right {
      margin-right: -50px;
    }

    @media (max-width: 991.98px) {
      .cascading-right {
        margin-right: 0;
      }
    }

     @media (min-width: 768px) {
	  #nav-img{
	    height:252px;
	    width:  100%;
	    margin-top: -20px;
	  }
	  #top-nav{
	  	height:236px ;
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
	}
  </style>

<body class="img js-fullheight" style="background-image:url(images/xbg.jpg.pagespeed.ic.tiVxeakBSd.webp)">
	<div class="main">
		<nav class="navbar" id="top-nav" style="background-color: #fee588;">
		      <img src="images/Header_Banner1.webp" class="img-responsive" id="nav-img" alt="Ram Awatar Gupt Protsahan-2022" style="background-size: cover;background-repeat: no-repeat;">		 
		</nav>
		<div class="col-md-12" id="back" style="background-image: url(images/rag_website_bg.webp);">
        <div class="container rounded-3" style="background-color: #fffae6; margin-top:20px;">
	       <!-- <div class="navbar" style="text-align:center;align-content: center;align-items: center;">-->
				 
				    <!--<img src="images/Middle_banner2.png" class="img-responsive" alt="-2022-" style="background-size: cover;background-repeat: no-repeat;height:50px;width: 100%;">-->
				    <!--<h3 class="text-center col-md-12 section-heading sub-heading text-center py-3 text-light" style="margin-top: -50px; color: #fff;text-align: center; align-content: center; align-items: center;font-size: 26px; font-weight:700; color:#fff;width: 100%;">-2022-</h3>-->
				  
		      <!--</div>-->
		      <div class="navbar" style="text-align:center;align-content: center;align-items: center;background-color:#ae2627 ;font-size: 25px;color: #fff;">
				 
				   <!--  <img src="images/Middle_banner2.png" class="img-responsive" alt="-2022-" style="background-size: cover;background-repeat: no-repeat;height:50px;width: 100%;">
				    <h3 class="text-center col-md-12 section-heading sub-heading text-center py-3 text-light" style="margin-top: -50px; color: #fff;text-align: center; align-content: center; align-items: center;font-size: 26px; font-weight:700; color:#fff;width: 100%;">-2022-</h3> -->
				    <h3 class="text-center my-2" style="font-size:25px; font-weight:700; color:#fff;">-2022-</h3>
				  
		    </div>


						<?php if(isset($_SESSION['msg'])){ ?>

                                    <div class="col-md-12 bg-danger alert-dismissible  alert alert-danger py-4">

                                        <h5 class="text-light text-center"><?php echo $_SESSION['msg']; ?></h5>
                                    </div>



            <?php  unset($_SESSION['msg']);}?>

            <?php if($error_msg){ ?>
            	          <div class="col-md-12 bg-danger alert-dismissible  alert alert-danger py-4">

                            <h5 class="text-light text-center"><?php echo $error_msg; ?></h5>
                        </div>
            <?php } ?>
             <?php if($msg){ ?>
            	          <div class="col-md-12 bg-success alert-dismissible  alert alert-success py-4">

                            <h5 class="text-light text-center"><?php echo $msg; ?></h5>
                        </div>
            <?php } ?>




						<!-- <div class="container rounded bg-white mt-5 mb-5"> -->
							    <div class="row">
							        <div class="col-md-3 border-right">
							            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle circle" width="150px" src="uploads/<?php echo $res['id']; ?>/student-photo/<?php echo $res['student_photo_file']; ?>"><span class="font-weight-bold"><?php echo ''.$res['fname'].' '.$res['lname'].''; ?></span><span class="text-black-50"><?php echo $res['student_email']; ?></span><span> </span></div>
							            <hr>
							        </div>
							       
							        <div class="col-md-5 border-right">
							            <div class="p-2 py-2">
							                <div class="d-flex justify-content-between align-items-center mb-1">
							                    <h4 class="text-right">Student Details</h4>
							                </div>

                               <hr>
                                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	 <label class="labels"><span>यूनिक रोल नम्बर</span><br><span>Unique Roll Number</span></label>
							                    	
							                    	
							                     </div>
							                     <div class="col-md-6">
							                     	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo "T-".$res['boardexam']."-".$res['reg_id'].""; ?></span></h6>
							                     	  
							                     	</div>
							                </div>

							                


							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	 <label class="labels"><span>रजिस्ट्रेशन (परीक्षा क्षेत्र)</span><br><span>Registered Location</span></label>
							                    	
							                    	
							                     </div>
							                     <div class="col-md-6">
							                     	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['reg_location']; ?></span></h6>
							                     	  
							                     	</div>
							                </div>




							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	 <label class="labels"><span>पूरा नाम (अंग्रेजी)</span><br><span>Full Name in English</span></label>
							                    	
							                    	
							                     </div>
							                     <div class="col-md-6">
							                     	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo ''.$res['fname'].' '.$res['lname'].''; ?></span></h6>
							                     	  
							                     	</div>
							                </div>


							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	 <label class="labels"><span>पूरा नाम (हिंदी)</span><br><span>Full Name in Hindi</span></label>
							                    	
							                     </div>
							                     <div class="col-md-6">
							                     	  <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo  ''.$res['hname'].' '.$res['hlname'].''; ?></span></h6>
							                     </div>
							                </div>



							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	 <label class="labels"><span>मोबाइल नंबर</span><br><span>Mobile Number</span></label>
							                    	
							                    	
							                     </div>
							                     <div class="col-md-6">
							                     	    <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['student_mobile']; ?></span></h6>
							                     </div>
							                </div>



							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	 <label class="labels"><span>ई-मेल</span><br><span>Email ID</span></label>
							                    	
							                     </div>
							                     <div class="col-md-6">
							                     	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['student_email']; ?></span></h6>
							                     </div>
							                </div>



							                 <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	  <label class="labels"><span>लिंग</span><br><span>Gender</span></label>
							                    </div>
							                    <div class="col-md-6">
							                    	  <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['student_gender']; ?></span></h6>
							                    	</div>
							                </div>



							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	  <label class="labels"><span>जन्म तिथि</span><br><span>Date of Birth (Year-Month-Day)</span></label>
							                    </div>
							                    <div class="col-md-6">
							                        <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['student_dob']; ?></span></h6>
							                    </div>
							                </div>

                               <hr>
							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>अभिभावक का नाम</span><br><span>Parent Name</span></label>
							                    </div>
							                    <div class="col-md-6">
							                    	    <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['parent_name']; ?></span></h6>
							                    </div>
							                </div>

                             

							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	   <label class="labels"><span>अभिभावक का फोन नं</span><br><span>Parent Phone Number</span></label>
							                    </div>
							                    <div class="col-md-6">
							                    	  <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['parent_mobile']; ?></span></h6>
							                    </div>
							                </div>



							                <div class="row mt-1 d-flex">
							                      <div class="col-md-6">
							                      	  <label class="labels"><span>अभिभावक का ई-मेल</span><br><span>Parent Email ID</span></label>
							                      </div>
							                      <div class="col-md-6">
							                      	  <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['parent_email']; ?></span></h6>
							                      </div>
							                </div>



							                <div class="row mt-1 d-flex">
							                      <div class="col-md-6">
							                      	
							                    	    <label class="labels"><span>अभिभावक का पता</span><br><span>Parent Address</span></label>
							                      </div>
							                      <div class="col-md-6">
							                      	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['home_address']; ?></span></h6>
							                     </div>
							                 </div>


							                 <div class="row mt-1 d-flex">
							                  	<div class="col-md-6">
							                  		<label class="labels"><span>पिन कोड</span><br><span>Pincode</span></label>
							                    </div>
							                    <div class="col-md-6">
							                    	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['pincode']; ?></span></h6>
							                    </div>
							                 </div>



							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>शहर</span><br><span>City</span></label>
							                    </div>
							                    <div class="col-md-6">
							                      <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['city']; ?></span></h6>
							                    </div>
							                </div>



							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>राज्य</span><br><span>State</span></label>
									                 </div>
									                 <div class="col-md-6">
									                   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['state']; ?></span></h6>
									                 </div>
							                </div>

                              <hr>

							                 <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	  <label class="labels"><span>स्कूल का नाम</span><br><span>School Name</span></label>
							                    </div>
							                    <div class="col-md-6">
							                    		<?php if($res['school_name']=="others"){ ?>
							                   		<h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['other_school_name']; ?></span></h6>
							                   	<?php }else{ ?>
							                   	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['school_name']; ?></span></h6>

							                   	<?php } ?>
							                    	    
							                    </div>
							                 </div>



							                 <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	   <label class="labels"><span>स्कूल का पता</span><br><span>School Address</span></label>
							                   </div>
							                   <div class="col-md-6">
							                   	<?php if($res['school_name']=="others"){ ?>
							                   		<h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['other_school_address']; ?></span></h6>
							                   	<?php }else{ ?>
							                   	    <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['school_address']; ?></span></h6>

							                   	<?php } ?>
							                   </div>
							                 </div>



							                 <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	   <label class="labels"><span>कक्षा का नाम</span><br><span>Class Name</span></label>
							                     </div>
							                     <div class="col-md-6">

							                     	    <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['class']; ?></span></h6>
							                     	</div>
							                </div>



							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	  <label class="labels"><span>बोर्ड परीक्षा</span><br><span>Board Exam</span></label>
							                    </div>
							                    <div class="col-md-6">
							                    	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['boardexam']; ?></span></h6>
							                    </div>
							                </div>




							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	 <label class="labels"><span>बोर्ड क्रमांक नं</span><br><span>Board Roll Number</span></label>
							                    	
							                    	
							                     </div>
							                     <div class="col-md-6">
							                     	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['board_roll_no']; ?></span></h6>
							                     	  
							                     	</div>
							                </div>
							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	 <label class="labels"><span>प्री बोर्ड मार्क्स</span><br><span>Pre-Board Marks</span></label>
							                    	
							                    	
							                     </div>
							                     <div class="col-md-6">
							                     	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['current_year_preboards']; ?></span></h6>
							                     	  
							                     	</div>
							                </div>

                               <hr>

							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>फेसबुक हैंडल</span><br><span>Facebook Handle</span></label>
							                    </div>
							                    <div class="col-md-6">
							                    	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['facebook_handle']; ?></span></h6>
							                    </div>
							                 </div>



							                <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>इंस्टाग्राम हैंडल</span><br><span>Instagram Handle</span></label>
							                    </div>
								                 <div class="col-md-6">
								                 	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><?php echo $res['twitter_handle']; ?></span></h6>
								                 </div>
								              </div>

								              <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>सभी फ़ाइल</span><br><span>All File</span></label>
							                    </div>
								                 <div class="col-md-6">
								                 	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><br>
								                 	   
								                 	   
								                 	   
								                 	   <b>Student Full Details & Registration Card=></b><span><a href="../uploads/<?php echo 'file'.$res['id'].'.pdf';?>" target="_blank">Click to Open</a></span><br>
								                 	 
								                 	  


								                 	   <b>Disorder File=></b><span><?php 
								                 	     if($res['disorder_file']){

								                 	   	echo $res['disorder_file'].'  <a href="../uploads/'.$res['id'].'/disorder-img/'.$res['disorder_file'].'" target="_blank">Click to Open</a>"'; 
								                 	   }else{
								                 	   	echo "No Data";
								                 	   }

								                 	 ?></span><br>

								                 	   	<b>Student Photo=></b><span><?php 
								                 	   	if($res['student_photo_file']){

								                 	   		echo $res['student_photo_file'].'  <a href="../uploads/'.$res['id'].'/student-photo/'.$res['student_photo_file'].'" target="_blank">Click to Open</a>"'; 
								                 	   	}else{
								                 	   		echo "No Data";
								                 	   	}

								                 	   ?></span><br>


								                 	  <b> Hindi Name File=></b><span><?php 
								                 	   	if($res['hname_file']){

								                 	   		echo $res['hname_file'].'  <a href="../uploads/'.$res['id'].'/hindi-name/'.$res['hname_file'].'" target="_blank">Click to Open</a>"'; 
								                 	   	}else{
								                 	   		echo "No Data";
								                 	   	}

								                 	   ?></span><br>


								                 	   <b>Admit Card File=></b><span><?php 
								                 	   	if($res['admit_card_file']){

								                 	   		echo $res['admit_card_file'].'  <a href="../uploads/'.$res['id'].'/admit-card/'.$res['admit_card_file'].'" target="_blank">Click to Open</a>"'; 
								                 	   	}else{
								                 	   		echo "No Data";
								                 	   	}

								                 	   ?></span><br>


								                 	   	<b>Ankur Activity File=></b><span><?php 
								                 	   	if($res['ankur_activity_file']){

								                 	   		echo $res['ankur_activity_file'].'  <a href="../uploads/'.$res['id'].'/ankur-activity/'.$res['ankur_activity_file'].'" target="_blank">Click to Open</a>"'; 
								                 	   	}else{
								                 	   		echo "No Data";
								                 	   	}

								                 	   ?></span><br>
								                 	  
								                 	   
								                 	   
								                 	   


								                 	   


								                 	   


								                 	   	<b>Marksheet File=></b><span><?php 
								                 	   	if($res['marksheet_file']){

								                 	   		echo $res['marksheet_file']; 
								                 	   	}else{
								                 	   		echo "No Data";
								                 	   	}

								                 	   ?></span><br>







								                 	   </h6>
								                 </div>
								              </div>	



                              <hr>

							               
							            </div>
							        </div>

							        <div class="col-md-4">
							       <?php if($res['marksheet_file']!=""){ ?>
							        	<div>
							        		<hr>
							        		<div class="d-flex justify-content-between align-items-center mb-1">
							        		  <h4 class="text-dark text-center">Your Allready Uploaded Details</h4>	
							        		</div>
							        		<hr>
							        		  <div class="alert alert-danger py-2 my-2">
							        		  	<h4 class="text-center text-dark">आपने अपना बोर्ड विवरण पहले ही अपलोड कर दिया है, यदि आप सभी विवरण अपडेट करना चाहते हैं तो फिर से अपलोड करें<br>You Allready Uploaded Your Board Details, If You Want To Update All Details Then Upload Again</h4>
							        		  </div>
							        	
							        		    <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>बोर्ड कुल अंक</span><br><span>Board Total Marks</span></label>
							                    </div>
								                 <div class="col-md-6">
								                 	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><b><?php echo $res['board_total_mark']; ?></b></span></h6>
								                 </div>
								              </div>

								              <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>बोर्ड नॉट मार्क्स</span><br><span>Board Hindi Marks</span></label>
							                    </div>
								                 <div class="col-md-6">
								                 	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><b><?php echo $res['board_hindi_mark']; ?></b></span></h6>
								                 </div>
								              </div>
								              <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>बोर्ड हिंदी अंक प्रतिशत</span><br><span>Board Hindi Marks Percentage</span></label>
							                    </div>
								                 <div class="col-md-6">
								                 	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><b><?php echo $res['Board_hindi_mark_percent']; ?>%</b></span></h6>
								                 </div>
								              </div>
								              <div class="row mt-1 d-flex">
							                    <div class="col-md-6">
							                    	<label class="labels"><span>अपलोड की गई मार्कशीट</span><br><span>Uploaded Marksheet</span></label>
							                    </div>
								                 <div class="col-md-6">
								                 	   <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><b><?php echo $res['marksheet_file']; ?></b></span></h6>							                 	 
								                 <h6 class="text text-left text-dark mx-2"><span>:&nbsp</span><span><a href="uploads/<?php echo $res['id']?>/marksheet_img/<?php echo $res['marksheet_file']?>" target="_blank"><b>Click to See Uploaded Marksheet</b></a></span></h6>
								                 </div>
								              </div>


							        		

							        	</div>
							        <?php } ?>
							        	<hr>
							        	<div class="d-flex justify-content-between align-items-center mb-1">
							                    <h4 class="text-right">Upload Board Details</h4>
							          </div>
							                 <hr>	
							            <div class="p-2 py-2">
							            	  
							              <form id="rag2020-form"  method="post"  enctype="multipart/form-data">					           
							                <div class="col-md-12"><label class="labels"><span>बोर्ड कुल अंक</span><span class="req-col text-danger">*</span><br><span>Board Total Marks</span></label>

							                	<input type="number" class="form-control mb-2" placeholder="Enter Board Total marks" name="board_total_mark" 
							                	id="board_total_mark" value="" required>
							                </div> <br>
							                <div class="col-md-12"><label class="labels"><span>बोर्ड नॉट मार्क्स</span><span class="req-col text-danger">*</span><br><span>Board Hindi Marks</span></label>

							                	<input type="number" class="form-control mb-2" placeholder="Enter Board Hindi Marks" name="board_hindi_mark" 
							                	id="board_hindi_mark" value="" required>
							                </div> <br>

							                <div class="col-md-12"><label class="labels"><span>बोर्ड हिंदी अंक प्रतिशत (केवल संख्या में)</span><span class="req-col text-danger">*</span><br><span>Board Hindi Marks Percentage (Only In Number)</span></label>

							                	<input type="number" class="form-control mb-2" placeholder="Enter Board Hindi Marks Percentage" name="board_hindi_mark_perc" 
							                	id="board_hindi_mark_perc" value="" required>
							                </div> <br>


							                <div class="col-md-12"><label class="labels"><span>मार्कशीट अपलोड करें (समर्थित फ़ाइल प्रारूप और आकार - *.pdf, *.jpg, *.png max. 1 MB)</span><span class="req-col text-danger">*</span><br><span>Upload Marksheet  (Supported File Format & Size - *.pdf, *.jpg, *.png max. 1 MB)</span></label>

							                	<input type="file" class="form-control mb-2" placeholder="Upload Your Marksheet" name="Stu_marksheet" 
							                	id="Stu_marksheet" value="" required>
							                </div>
							                
							                <div class="col-md-12 text-center">

							                	<button type="submit" name="upload_submit" id="upload_submit" value="Upload Details" class="btn btn-success my-3 mx-4"><i class="fa-solid fa-upload"></i><span>&nbsp</span>विवरण अपलोड करें(Upload Details)</button>
							                </div>

							              </form>
							                
							                <div class="col-md-12 text-center container">
							                	<hr class="bg-dark text-dark my-4">
							                	<p class="text-dark text-center">Click to Logout</p>
							                	<a href="logout.php"><h2 class="text-dark text-center"><b><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Logout</span></b></h2></a>
							                </div>
							            </div>
							             <div class="text-center">
							             	<img src="images/Flame.png" class="text-center" style="height: 50%; width: 50%;align-items: center; align-content: center; align-items: center;">
							        	
							        	
							             </div>
							        </div>

							    </div>
							</div>
							</div>
							<!-- </div> -->
					
		       
		
					  

			
			  </div>
	    </div>
		 <nav class="navbar" id="footer_main">
    	
       <footer id="footer" style="background-color:#ae2627;color: #fff;" class="navbar bottom-0">Powered By Sanmarg Pvt. Ltd.</footer>

     </nav>
     </div>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery.steps.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>


<!-- jquery ui js -->
<script src="jq_ui_js/jquery-ui.min.js"></script>
<script  src="jq_ui_js/jquery-ui.js"></script>

 <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
 crossorigin="anonymous"></script>



 <script>if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
     }
  </script>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js+bootstrap.min.js+main.js.pagespeed.jc.9eD6_Mep8S.js"></script><script>eval(mod_pagespeed_T07FyiNNgg);</script>
<script>eval(mod_pagespeed_zB8NXha7lA);</script>
<script>eval(mod_pagespeed_xfgCyuItiV);</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"71788cd2e92c94b8","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.12.0","si":100}' crossorigin="anonymous"></script>


<script type="text/javascript">
	

$(document).ready(function(){
 	
	
 $(this).scrollTop(0);
 $('#upload_submit').click(function(){


	if($('#board_total_mark').val()=="" || $('#board_hindi_mark').val()=="" || $('#board_hindi_mark_perc').val()=="" || $('#Stu_marksheet').val()==""){

		alert("Please enter all 'Board Details'");
	}


 });


 $("#Stu_marksheet").on("change", function() {
	var file=$('#Stu_marksheet').val();
    var ext = $('#Stu_marksheet').val().split('.').pop().toLowerCase();

    var fileSize = $("#Stu_marksheet")[0].files[0].size;//size in MB

    if($.inArray(ext, ['pdf','png','jpg']) == -1) {
       alert('Please upload an acceptable File type and size');
       this.value ='';
    }
    else if(fileSize>1000000){

    	alert('Do not exceed the File size limit (1MB)');
       this.value ='';
    }
    
});

  $("#board_total_mark").on("change", function() {

	var val = parseInt(this.value);
    if(val > 1000 || val < 0)
    {
        alert("Please enter valid 'Board Total Hindi Marks'");
        this.value ='';        
    }
			  

  });

   $("#board_hindi_mark").on("change", function() {

	var val = parseInt(this.value);
    if(val > 100 || val < 0)
    {
        alert("Please enter valid 'Hindi Marks'");
        this.value ='';        
    }
			  

  });

   $("#board_hindi_mark_perc").on("change", function() {

	var val = parseInt(this.value);
    if(val > 100 || val < 0)
    {
        alert("Please enter valid 'Hindi Marks Percentage'");
        this.value ='';        
    }
			  

  });










});





</script>






</body>
</html>





<?php }else{


	$_SESSION['msg']="Please Login First";
    header('location:student_login.php');


} ?>