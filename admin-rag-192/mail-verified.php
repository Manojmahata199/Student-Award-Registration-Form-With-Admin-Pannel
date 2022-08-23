<?php

include('common-header.php');
include('action.php');
require_once "config.php"; 
error_reporting(E_ALL);
if (isset($_SESSION['username'])){	
?>
<div id="page-wrapper" >
            <div id="page-inner">                
<!-- Display the status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="alert alert-success"><?php echo $statusMsg; ?></div>
<?php } ?>

			<div class="row">
                    <div class="col-lg-12">
                     <h2>Email To Verified Student</h2>
					 </div>
			</div>					 
		<form name="bulk_action_form" action="" method="post" onSubmit="return emailverify_confirm();"/>
		<table class="table table-responsive table-striped w-auto table-bordered">
        <thead>
        <tr>
            <th><input type="checkbox" id="select_all" value=""/></th>        
							  <th>Sr.No</th> 	
							  <th>RAG ROLL NO</th>
                              <th>English Name</th>
                              <th>Board Marks</th>
                              <th>Board Marksheet</th>  
							  <th>Student Email</th>
							  <th>Standard</th>
							  <th>School Name</th>
                                                          
							  <th>Location</th>
            
        </tr>
        </thead>
        <?php              
        // Get users from the database
        $sql="SELECT * FROM `student_data` WHERE `reg_location`='Kolkata-Howrah,Hooghly'";                       
        // List all records
        if($result = mysqli_query($conn, $sql)){
						if(mysqli_num_rows($result) > 0){
							$i=1;
						while($row = mysqli_fetch_array($result)){	
                             if($row['school_name']=="others"){
                                  $school_name=$row['other_school_name'];
                            }else{
                             
                               $school_name=$row['school_name'];
                             }
        ?>
        <tr>
            <td align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row['id']; ?>"/></td>        
            <td><?php echo $i++?></td>
					   <td><?php echo $row['boardexam']."-".substr($row['class'], -2)."-".substr("0000000{$row['id']}", -7)?></td>
                       <td><?php echo $row['fname']." ".$row['lname']?></td>
					   <td><?php echo $row['board_hindi_mark']?></td>
					   <td><?php echo $row['marksheet_file']?></td>
					   <td><?php echo $row['student_email']?></td>
					   <td><?php echo $row['class']?></td>
					   <td><?php echo $school_name; ?></td>
                       
					   <td><?php echo $row['reg_location']?></td>	
            
        </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No records found.</td></tr>
        <?php }}?>
    </table>
	<input type="submit" class="btn btn-success" name="bulk_email_submit" value="Send Email"/>
</form>

                    

				
</div>
<?php
include('common-footer.php');
}
else{
	
	// Redirect user to welcome page
    header("location: index.php");
}	
?> 
<script>
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
	
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
function emailverify_confirm(){
    if($('.checkbox:checked').length > 0){
        var result = confirm("Are you sure want to email the selected user?");
        if(result){
            return true;
        }else{
            return false;
        }
    }else{
        alert('Select at least 1 record to Email.');
        return false;
    }
}
</script>
				
