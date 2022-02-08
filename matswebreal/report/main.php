<?php

include 'funcs/functions.php';

$to = "bustonshows@yahoo.com";
$subject = "Monthly Summary For " . ucfirst(date('F Y'));
$ndate = date("Y-m-d H:i:s");
$ldate = date("Y-m-d H:i:s", strtotime("-1 month"));
$arrr = array();

//$conn = mysqli_connect("localhost", "root", "", "pharmaccess") or die("could not connect server");
$conn = mysqli_connect("10.128.62.33", "mats", "matsremote", "mats_main") or die("could not connect server");

$q = mysqli_query($conn, "SELECT f.id as fid, name, count(*) as counte FROM default_phonegap_surveys p join default_facility_details f on p.facility_id = f.id where date_screened between '$ldate' and '$ndate' group by name");

$i = 1;
$preallcount = 0;
$allcount = 0;

while ($d = mysqli_fetch_array($q)) {
    $fid = $d["fid"];
    $hosp = $d["name"];
    $all = $d["counte"];
    $allcount = $allcount + $all;
    $qq = mysqli_query($conn, "SELECT count(*) as precount FROM default_phonegap_surveys  where status = 'yes' and facility_id = $fid and date_screened between '$ldate' and '$ndate' ");

    while (@$dd = mysqli_fetch_array($qq)) {
        $precount = $dd['precount'];
        $preallcount = $preallcount + $precount;
    }
    $arrr[$i] = $hosp . ': ' . $all . '; ' . $precount;
    $i++;
}

$message = "Dear MATS Administrator,

";
    
$message .= "MONTH: " . strtoupper(date('F'))."   
TOTAL SCREENED ALL HOSPITALS: $allcount 
NUMBER OF PRESUMPTIVE ALL HOSPITALS: " . $preallcount;
        

foreach ($arrr as $key => $v) {
    $message .= "
$key . $v";
    
}

$message .= "
    
Thank You,
MATS LAGOS ADMIN";
$messagee = removeSend($message);
echo $messagee;


$to1 = 'a.asumah@pharmacess.org';
$to2 = 'f.egbedeyi@pharmaccess.org';
$to3 = 'victor.adepoju@kncvtbc.org';
$to4 = 'patience.edo@kncvtbc.org';

sendMail($to1, $subject, $messagee);
sendMail($to2, $subject, $messagee);
sendMail($to3, $subject, $messagee);
sendMail($to4, $subject, $messagee);
sendMail($to, $subject, $messagee);

