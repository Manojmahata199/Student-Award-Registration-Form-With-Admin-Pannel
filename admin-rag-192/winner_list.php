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
                     <h2>Winner List</h2>
					 </div>
			</div>					 
		<form name="bulk_action_form" action="" method="post" onSubmit="return emailverify_confirm();"/>
		<table class="table table-responsive table-striped w-auto table-bordered">
        <thead>
        <tr>
               
							  <th>Sr.No</th> 	
							  <th>RAGP ROLL No</th>
                              <th>Hindi Name</th>
                              <th>Class</th>
							  <th>Board</th>
                              <th>Options</th>
							 
            
        </tr>
        </thead>
        <?php              
        // Get users from the database
        $sql="SELECT * FROM `winner_list`";                       
        // List all records
        if($result = mysqli_query($conn, $sql)){
						if(mysqli_num_rows($result) > 0){
							$i=1;
						while($row = mysqli_fetch_array($result)){	
                             
        ?>
        <tr>
                  
                       <td><?php echo $i++?></td>
					   <td><?php echo $row['reg_id']; ?></td>
                       <td><?php echo $row['winner_name']; ?></td>
					   <td><?php echo $row['winner_class']; ?></td>
					   <td><?php echo $row['winner_board']; ?></td>
                       <td><a class="btn btn-primary text-center text-dark" href="staff_id_generate/newcard.php?id=<?php echo $row['id']; ?>">Print</a></td>
					  
					 
        </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No records found.</td></tr>
        <?php }}?>
    </table>
	
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