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

$added = false;

//Add new student code 

if(isset($_POST['submit'])){

	$s_fullname = $_POST['full_name'];
	$s_std = $_POST['std'];
	$s_board = $_POST['board'];
	$s_school = $_POST['school'];
	$s_address = $_POST['address'];
	$s_mobile = $_POST['mobile'];

	$insert_data = "INSERT INTO students_data(s_fullname,s_std,s_board,s_school,s_address,s_mobile,create_date) VALUES ('$s_fullname','$s_std','$s_board','$s_school','$s_address','$s_mobile',NOW())";
	$run_data = mysqli_query($con,$insert_data);

  	if($run_data){
		  $added = true;
  	}else{
  		echo "Data not insert";
  	}

}

?>







<!DOCTYPE html>
<html>
<head>
	<title>Student Crud Operation</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
<a href="index.php" target="_blank"><img src="images/benc_coach.jpeg" alt="" height="100px" width="300px" ></a><br><hr>

<!-- adding alert notification  -->
<?php
	if($added){
		echo "
			<div class='btn-success' style='padding: 15px; text-align:center;'>
				Your Student Data has been Successfully Added.
			</div><br>
		";
	}

?>





	<a href="logout.php" class="btn btn-success"><i class="fa fa-lock"></i> Logout</a>
	<a href="print.php" class="btn btn-success"> Print</a>
	<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-plus"></i> Add New Student
  </button>
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
				<th class="text-center" scope="col">Edit</th>
				<th class="text-center" scope="col">Delete</th>
			</tr>
		</thead>
			<?php

        	$get_data = "SELECT * FROM students_data";
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
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#DeleteStudents$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>

			</tr>


        		";
        	}

        	?>

			
			
		</table>
		
	</div>


	<!---Add in modal---->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="text-center">
			<img src="images/benchmark_coaching.jpeg" width="100px" height="100px" alt="">
		</div>
    
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
			
			<!-- This is test for New Card Activate Form  -->
			<!-- This is Address with email id  -->
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Full Name</label>
<input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Standard</label>
<input type="text" class="form-control" name="std" placeholder="Standard (Eg: 9th)" required>
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="firstname">Board</label>
<input type="text" class="form-control" name="board" placeholder="Board" required>
</div>
<div class="form-group col-md-6">
<label for="firstname">School</label>
<input type="text" class="form-control" name="school" placeholder="School" required>
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="fathername">Address</label>
<textarea class="form-control" name="address" placeholder="Enter Address" required></textarea>
</div>
<div class="form-group col-md-6">
<label for="mothername">Mobile No.</label>
<input type="text" class="form-control" name="mobile" placeholder="Enter Mobile No." required>
</div>
</div>

    	<input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">
        	
        	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!------DELETE modal---->

<!-- Modal -->
<?php

$get_data = "SELECT * FROM students_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['s_id'];
	echo "

<div id='DeleteStudents$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title text-center'>Are you want to sure??</h4>
      </div>
      <div class='modal-body'>
        <a href='delete.php?id=$id' class='btn btn-danger' style='margin-left:250px'>Delete</a>
      </div>
      
    </div>

  </div>
</div>
	";
}
?>


<!----edit Data--->

<?php

$get_data = "SELECT * FROM students_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['s_id'];
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

<div id='edit$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h4 class='modal-title text-center'>Edit your Data</h4> 
      </div>

      <div class='modal-body'>
        <form action='edit.php?id=$id' method='post' enctype='multipart/form-data'>

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
			<input type='text' class='form-control' name='chq_no' placeholder='Details' value='$chq_no' required>
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
			 <input type='submit' name='submit' class='btn btn-info btn-large' value='Submit'>
			 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
		 </div>


        </form>
      </div>

    </div>

  </div>
</div>


	";
}


?>


	<!--<ul class="nav nav-pills">
		<li><a href="#">Ninja training</a></li>
		<li class="active"><a href="#">Wizard Training</a></li>
		<li><a href="#">Psychic Training</a></li>
	</ul>-->


<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>



</body>
</html>
