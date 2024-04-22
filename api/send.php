<?php 
include("../connect.php");
date_default_timezone_set("Asia/Colombo");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$json_data = file_get_contents('php://input');
$row = json_decode($json_data, true);


$id=$row['cloud_id'];
$action=$row['Action'];
$number =$row['number'];
$date=date('H.i.s');

if($action=='send'){
	$sql = 'UPDATE  sms SET action =? WHERE id =? ';
	$ql = $db->prepare($sql);
	$ql->execute(array('Send',$id));
}

$result = $db->prepare("SELECT * FROM sms WHERE  action='pending' ORDER BY ID ASC LIMIT 1");
$result->bindParam(':id', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){  

	$result_array[] = array (
		"id" => $row['id'],
		"number" => '+94'.$row['number'],
		
		"ms" => $row['message'],
	);
}
echo (json_encode ( $result_array ));
?>