<?php
include('../../connect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// get json data
$json_data = file_get_contents('php://input');

// get values
$sms = json_decode($json_data, true);

// respond init
$result_array = array();

foreach ($sms as $list) {

    // get values
    $number = $list['number'];
    $message = $list['message'];
    $date = $list['date'];
    $time = $list['time'];
    $device = $list['device'];
    $action = $list['action'];


    //------------------------------------------------------------------//
    try {

        //checking duplicate
        $con = 0;
        $result = $db->prepare("SELECT * FROM sms WHERE number = '$number' AND device = '$device'  ");
        $result->bindParam(':id', $cus);
        $result->execute();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $con = $row['id'];
        }

        if ($con == 0) {

            // insert query
            $sql = "INSERT INTO sms (number,message,date,time,device,action) VALUES (?,?,?,?,?,?)";
            $ql = $db->prepare($sql);
            $ql->execute(array($number, $message, $date, $time, $device, $action));

        }

        // get sales  data
        $result = $db->prepare("SELECT * FROM sms WHERE number=:id ");
        $result->bindParam(':id', $number);
        $result->execute();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $id = $row['id'];
        }

        // create success respond 
        $res = array(
            "cloud_id" => $id,
            "status" => "success",
            "message" => "",
        );

        array_push($result_array, $res);
    } catch (PDOException $e) {

        // create error respond 
        $res = array(
            "cloud_id" => 0,
            "status" => "failed",
            "message" => $e->getMessage(),
        );

        array_push($result_array, $res);
    }
}

// send respond
echo (json_encode($result_array));
