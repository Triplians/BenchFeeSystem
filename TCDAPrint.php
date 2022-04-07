<?php
include('config.php');
header('content-type:image/jpeg');

$recp_id = $_GET['tcdaid'];

if(isset($_POST['tcdasubmit']))
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
	$image=imagecreatefromjpeg("TCDAReceipt.jpeg");
	$color=imagecolorallocate($image,19,21,22);

	imagettftext($image,30,0,765,425,$color,$font,$s_fullname);
	imagettftext($image,30,0,765,500,$color,$font,$s_std);
	imagettftext($image,30,0,765,580,$color,$font,$s_board);
	imagettftext($image,30,0,765,650,$color,$font,$s_school);

	imagettftext($image,30,0,270,800,$color,$font,$recp_id);
	imagettftext($image,30,0,160,869,$color,$font,$recp_date);
	imagettftext($image,30,0,330,940,$color,$font,$pay_mode);
	imagettftext($image,30,0,55,1090,$color,$font,$chq_no);

	imagettftext($image,30,0,2235,570,$color,$font,$total_fees);
	imagettftext($image,30,0,2235,720,$color,$font,$total_fees);


	imagejpeg($image);
	imagedestroy($image);
	

	// if($run_update){
		
	// } 
	// else{
	// 	echo "Data not update";
	// }
}
?>