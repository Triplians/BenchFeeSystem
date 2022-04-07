<?php

include('config.php');
$id = $_GET['id'];
$delete = "DELETE FROM students_data WHERE s_id = $id";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:index.php');
}else{
	echo "Donot Delete";
}


?>