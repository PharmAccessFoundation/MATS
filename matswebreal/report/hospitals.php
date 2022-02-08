<?php

include 'funcs/functions.php';

//$conn = mysqli_connect("localhost", "root", "", "pharmaccess") or die("could not connect server");
$conn = mysqli_connect("10.128.62.33", "mats", "matsremote", "mats_main") or die("could not connect server");

$sq = mysqli_query($conn, "SELECT f.id as fid, name, count(*) as counte FROM default_phonegap_surveys p join default_facility_details f on p.facility_id = f.id where date_screened between '$ldate' and '$ndate' group by name");


$subject = "Monthly Summary For " . ucfirst(date('F Y'));
$ndate = date("Y-m-d H:i:s");
$ldate = date("Y-m-d H:i:s", strtotime("-1 month"));
$subject = "Monthly Report For " . ucfirst(date('F Y', strtotime("-1 month")));

$q = mysqli_query($conn, "SELECT facility_id, display_name, email FROM default_phonegap_surveys s join default_profiles p on s.facility_id = p.facility join default_users u on u.id = p.user_id where date_screened between '$ldate' and '$ndate' group by facility_id");
while ($d = mysqli_fetch_array($q)) {
    $fid = $d['facility_id'];
    $email = $d['email'];
    $fname = $d['display_name'];

    $arrr = array();
    $all = 0;
    $pall = 0;
    $i = 1;

    $qq = mysqli_query($conn, "select * from default_phonegap_surveys where facility_id = $fid and status = 'yes' and date_screened between '$ldate' and '$ndate'");
    while ($dd = mysqli_fetch_array($qq)) {
        $firstname = $dd['firstname'];
        $mob = $dd['mobile'];
        $resp = getResp($dd['respondent']);
        $details = ($dd['details'] == '0') ? 'Nil' : $dd['details'];
        $arrr[$i] = $firstname . ' ' . $mob . ' ' . $resp . ' ' . $details;
        $pall++;
        $i++;
    }
    $qqq = mysqli_query($conn, "select count(*) as allcnt from default_phonegap_surveys where facility_id = $fid  and date_screened between '$ldate' and '$ndate'");
    while ($d = mysqli_fetch_array($qqq)) {
        $all = $d['allcnt'];
    }

    $message = "Dear $fname,
    
For the month of " . ucfirst(date('F Y')) . ", you have screened a total of $all people. $pall of these people were presumptive.
    
Please find the details of the presumptive below:";

    if (empty($arrr)) {
        $message .= "
No Presumptive Record.";
    } else {
        foreach ($arrr as $key => $value) {
            $message .= "
$key. $value";
        }
    }

    $message .= "
    
Thank you.
MATS LAGOS";

    sendMail($email, $subject, removeSend($message));
    echo removeSend($message) . '<br><br>' . $email, '<br><br>';
}

