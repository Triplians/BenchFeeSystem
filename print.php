<?php
    // Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// database connection
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Print</title>
</head>
<body>
<div class="container">
<a href="index.php" target="_blank"><img src="images/benc_coach.jpeg" alt="" height="100px" width="300px" ></a><br><hr>

	<a href="logout.php" class="btn btn-success"><i class="fa fa-lock"></i> Logout</a>
	<a href="index.php" class="btn btn-success"> Student Data</a>



    <hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			   <th class="text-center" scope="col">S.L</th>
				<th class="text-center" scope="col">Name</th>
				<th class="text-center" scope="col">Standard</th>
				<th class="text-center" scope="col">Board</th>
				<th class="text-center" scope="col">School</th>
				<th class="text-center" scope="col">Mobile</th>
				<th class="text-center" scope="col">Receipt Date</th>
				<th class="text-center" scope="col">Receipt No.</th>
				<th class="text-center" scope="col">Payment Mode</th>
				<th class="text-center" scope="col">Details</th>
				<th class="text-center" scope="col">Amount</th>
				<th class="text-center" scope="col">Benchmark Receipt</th>
				<th class="text-center" scope="col">TCDA Receipt</th>
				<!--<th class="text-center" scope="col">PrintButton</th>-->
			</tr>
		</thead>
			<?php

        	$get_data = "SELECT * FROM students_data where recp_date!='' OR recp_date!=NULL OR total_fees!='' OR total_fees!=NULL";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['s_id'];
				$s_fullname = $row['s_fullname'];
				$s_std = $row['s_std'];
				$s_board = $row['s_board'];
				$s_school = $row['s_school'];
				$s_mobile = $row['s_mobile'];
				$recp_date = $row['recp_date'];
				$recp_no = $row['s_id'];
				$pay_mode = $row['pay_mode'];
				$chq_no = $row['chq_no'];
				$total_fees = $row['total_fees'];

				
        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$s_fullname</td>
				<td class='text-left'>$s_std</td>
				<td class='text-left'>$s_board</td>
				<td class='text-left'>$s_school</td>

				<td class='text-left'>$s_mobile</td>
				<td class='text-left'>$recp_date</td>
				<td class='text-left'>$recp_no</td>
				<td class='text-left'>$pay_mode</td>
				<td class='text-left'>$chq_no</td>
				<td class='text-left'>$total_fees</td>
			
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#BenchMarkRecp$id' title='Benchmark Print'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#TCDARecp12$id' title='TCDA Print'><i class='fa fa-address-card-o'></i></a>
					</span>
				</td>
			</tr>


        		";
        	}

        	?>

			
			
		</table>
</div>


<!-- Benchmark Receipt Print modal  -->
<?php 

// <!-- profile modal start -->
$get_data = "SELECT * FROM students_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$sid_for_print = $row['s_id'];
	$s_fullname = $row['s_fullname'];
	$s_std = $row['s_std'];
	$s_board = $row['s_board'];
	$s_school = $row['s_school'];
	$s_address = $row['s_address'];
	$s_mobile = $row['s_mobile'];
	$recp_date = $row['recp_date'];
	$pay_mode = $row['pay_mode'];
	$chq_no = $row['chq_no'];
	$total_fees = $row['total_fees'];
	
	echo "
	<div class='modal' id='BenchMarkRecp$sid_for_print' tabindex='-1' role='dialog'>
  		<div class='modal-dialog' role='document'>
    		<div class='modal-content'>
			<div class='modal-header'>
			<button type='button' class='close' data-dismiss='modal'>&times;</button>
			<h4 class='modal-title text-center'>Benchmark Receipt</h4> 
	 		</div>
      		<div class='modal-body'>
						<form action='benchmarkPrint.php?spid=$sid_for_print' method='post' enctype='multipart/form-data'>
						  <div class='form-row'>
			  				<div class='form-group col-md-6'>
			  					<label>Full Name</label>
			  					<input type='text' class='form-control' name='full_name' placeholder='Full Name' value='$s_fullname' required>
			  				</div>
			  				<div class='form-group col-md-6'>
			  					<label>Standard</label>
			  					<input type='text' class='form-control' name='std' placeholder='Standard (Eg: 9th)' value='$s_std' required>
			  				</div>
			  			  </div>

						  <div class='form-row'>
			  				<div class='form-group col-md-6'>
			  					<label>Board</label>
			  					<input type='text' class='form-control' name='board' placeholder='Board' value='$s_board' required>
			  				</div>
			  				<div class='form-group col-md-6'>
			  					<label>School</label>
			  					<input type='text' class='form-control' name='school' placeholder='School' value='$s_school' required>
			  				</div>
			  			  </div>

						  <div class='form-row'>
							<div class='form-group col-md-6'>
								<label>Receipt Date</label>
								<input type='date' class='form-control' name='recp_date' placeholder='Date' value='$recp_date' required>
							</div>
							<div class='form-group col-md-6'>
								<label>Payment Mode</label>
								<select name='pay_mode' class='form-control'>
								  <option value='$pay_mode'>$pay_mode</option>
								  <option value='Cash'>Cash</option>
								  <option value='Cheque'>Cheque</option>
								  <option value='IMPS'>IMPS</option>
		  						  <option value='NEFT'>NEFT</option>
		  						  <option value='UPI'>UPI</option>
								</select>
							</div>
						   </div>


						   <div class='form-row'>
			  				<div class='form-group col-md-6'>
			  					<label>Details</label>
			  					<input type='text' class='form-control' name='chq_no' placeholder='Details' value='$chq_no'>
			  				</div>
			  				<div class='form-group col-md-6'>
			  					<label>Amount</label>
			  					<input type='text' class='form-control' name='total_fees' placeholder='Amount' value='$total_fees' required>
			  				</div>
			  			   </div>

						   <div class='form-row'>
			  				<div class='form-group col-md-6'>
			  					<label>Address</label>
			  					<textarea class='form-control' name='address' placeholder='Enter Address' required>$s_address</textarea>
			  				</div>
			  				<div class='form-group col-md-6'>
			  					<label>Mobile No.</label>
			  					<input type='text' class='form-control' name='mobile' placeholder='Enter Mobile No.' value='$s_mobile' required>
			  				</div>
			  			   </div>

							 <div class='modal-footer'>
			 					<input type='submit' name='submit' class='btn btn-info btn-large' value='Print'>
			 					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
		 					</div>
						</form>

			</div>
    	</div>
  		</div>
	</div>";
	
}


// <!-- Benchmark print modal end -->


?>



<!-- Benchmark Receipt Print modal  -->
<?php 

// <!-- profile modal start -->
$get_data = "SELECT * FROM students_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$sid_for_tcdaprint = $row['s_id'];
	$s_fullname = $row['s_fullname'];
	$s_std = $row['s_std'];
	$s_board = $row['s_board'];
	$s_school = $row['s_school'];
	$s_address = $row['s_address'];
	$s_mobile = $row['s_mobile'];
	$recp_date = $row['recp_date'];
	$pay_mode = $row['pay_mode'];
	$chq_no = $row['chq_no'];
	$total_fees = $row['total_fees'];
	
	echo "
	<div class='modal' id='TCDARecp12$sid_for_tcdaprint' tabindex='-1' role='dialog'>
  		<div class='modal-dialog' role='document'>
    		<div class='modal-content'>
			<div class='modal-header'>
			<button type='button' class='close' data-dismiss='modal'>&times;</button>
			<h4 class='modal-title text-center'>TCDA Receipt</h4> 
	 		</div>
      		<div class='modal-body'>
						<form action='TCDAPrint.php?tcdaid=$sid_for_tcdaprint' method='post' enctype='multipart/form-data'>
						  <div class='form-row'>
			  				<div class='form-group col-md-6'>
			  					<label>Full Name</label>
			  					<input type='text' class='form-control' name='full_name' placeholder='Full Name' value='$s_fullname' required>
			  				</div>
			  				<div class='form-group col-md-6'>
			  					<label>Standard</label>
			  					<input type='text' class='form-control' name='std' placeholder='Standard (Eg: 9th)' value='$s_std' required>
			  				</div>
			  			  </div>

						  <div class='form-row'>
			  				<div class='form-group col-md-6'>
			  					<label>Board</label>
			  					<input type='text' class='form-control' name='board' placeholder='Board' value='$s_board' required>
			  				</div>
			  				<div class='form-group col-md-6'>
			  					<label>School</label>
			  					<input type='text' class='form-control' name='school' placeholder='School' value='$s_school' required>
			  				</div>
			  			  </div>

						  <div class='form-row'>
							<div class='form-group col-md-6'>
								<label>Receipt Date</label>
								<input type='date' class='form-control' name='recp_date' placeholder='Date' value='$recp_date' required>
							</div>
							<div class='form-group col-md-6'>
								<label>Payment Mode</label>
								<select name='pay_mode' class='form-control'>
								  <option value='$pay_mode'>$pay_mode</option>
								  <option value='Cash'>Cash</option>
								  <option value='Cheque'>Cheque</option>
								  <option value='IMPS'>IMPS</option>
		  						  <option value='NEFT'>NEFT</option>
		  						  <option value='UPI'>UPI</option>
								</select>
							</div>
						   </div>


						   <div class='form-row'>
			  				<div class='form-group col-md-6'>
			  					<label>Details</label>
			  					<input type='text' class='form-control' name='chq_no' placeholder='Details' value='$chq_no'>
			  				</div>
			  				<div class='form-group col-md-6'>
			  					<label>Amount</label>
			  					<input type='text' class='form-control' name='total_fees' placeholder='Amount' value='$total_fees' required>
			  				</div>
			  			   </div>

						   <div class='form-row'>
			  				<div class='form-group col-md-6'>
			  					<label>Address</label>
			  					<textarea class='form-control' name='address' placeholder='Enter Address' required>$s_address</textarea>
			  				</div>
			  				<div class='form-group col-md-6'>
			  					<label>Mobile No.</label>
			  					<input type='text' class='form-control' name='mobile' placeholder='Enter Mobile No.' value='$s_mobile' required>
			  				</div>
			  			   </div>

							 <div class='modal-footer'>
			 					<input type='submit' name='tcdasubmit' class='btn btn-info btn-large' value='Print'>
			 					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
		 					</div>
						</form>

			</div>
    	</div>
  		</div>
	</div>";
	
}


// <!-- Benchmark print modal end -->


?>




</body>
</html>