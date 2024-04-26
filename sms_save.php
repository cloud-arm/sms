<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");


$user_id = $_SESSION['SESS_MEMBER_ID'];
$user_name = $_SESSION['SESS_FIRST_NAME'];
$date = date("Y-m-d");
$time = date('H.i');

$id = $_POST['id'];
$number = $_POST['number'];
$message = $_POST['message'];

$number = intval($number);

if ($id == 0) {

    $sql = "INSERT INTO sms (number,message,date,time,action) VALUES (?,?,?,?,?)";
    $request = $db->prepare($sql);
    $request->execute(array($number, $message, $date, $time, 'Pending'));
} else {

    $sql = "UPDATE sms  SET time = ?, number = ?, message = ? WHERE id= ?";
    $request = $db->prepare($sql);
    $request->execute(array($time, $number, $message, $id));
}

header("location: sms_add.php");
