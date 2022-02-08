<?php

header("Access-Control-Allow-Origin: *");

//Connect & Select Database
//$conn = mysqli_connect("10.128.62.33", "mats", "matsremote", "mats_main") or die("could not connect server");
$conn = mysqli_connect("10.128.62.33", "mats", "matsremote", "mats_main") or die("could not connect server");

$date = date("y-m-d",strtotime("-1 month"));
$rrr = mysqli_query($conn, "select * from `default_phonegap_surveys` where `date_uploaded`>'$date'");
$login = mysqli_num_rows($rrr);

echo $login;