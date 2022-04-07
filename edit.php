<?php
include('config.php');

$id = $_GET['id'];

if(isset($_POST['submit']))
{
	$s_fullname = $_POST['full_name'];
	$s_std = $_POST['std'];
	$s_board = $_POST['board'];
	$s_school = $_POST['school'];
	$s_address = $_POST['address'];
	$s_mobile = $_POST['mobile'];
    $recp_date = $_POST['recp_date'];
	$pay_mode = $_POST['pay_mode'];
	$chq_no = $_POST['chq_no'];
	$total_fees = $_POST['total_fees'];

	$update = "UPDATE students_data SET s_fullname='$s_fullname', s_std = '$s_std', s_board = '$s_board', s_school = '$s_school', s_address = '$s_address', s_mobile = '$s_mobile', recp_date='$recp_date', pay_mode='$pay_mode', chq_no='$chq_no', total_fees='$total_fees' WHERE s_id=$id ";
	$run_update = mysqli_query($con,$update);

	if($run_update){
		header('location:index.php');
	}else{
		echo "Data not update";
	}
}

?>