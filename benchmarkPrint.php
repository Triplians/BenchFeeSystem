<?php
include('config.php');
header('content-type:image/jpeg');

$recp_id = $_GET['spid'];
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




	$font="arial.ttf";
	$image=imagecreatefromjpeg("BenchmarkReceipt.jpeg");
	$color=imagecolorallocate($image,19,21,22);

	imagettftext($image,30,0,765,453,$color,$font,$s_fullname);
	imagettftext($image,30,0,765,526,$color,$font,$s_std);
	imagettftext($image,30,0,765,600,$color,$font,$s_board);
	imagettftext($image,30,0,765,675,$color,$font,$s_school);

	imagettftext($image,30,0,270,823,$color,$font,$recp_id);
	imagettftext($image,30,0,160,897,$color,$font,$recp_date);
	imagettftext($image,30,0,330,973,$color,$font,$pay_mode);
	imagettftext($image,30,0,55,1100,$color,$font,$chq_no);

	imagettftext($image,30,0,2255,600,$color,$font,$total_fees);
	imagettftext($image,30,0,2255,750,$color,$font,$total_fees);


	imagejpeg($image);
	imagedestroy($image);
	

	// if($run_update){
		
	// } 
	// else{
	// 	echo "Data not update";
	// }
}
?>