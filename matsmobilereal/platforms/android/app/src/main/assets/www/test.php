<?php

header("Access-Control-Allow-Origin: *");

//Connect & Select Database
//$conn = mysqli_connect("localhost", "root", "", "pharmaccess") or die("could not connect server");
//$conn = mysqli_connect("matslagos.com.ng", "matslago_mats", "busayo123$", "matslago_mats") or die("could not connect server");
$conn = mysqli_connect("192.3.137.194", "matslago_main", "Pharm123$", "matslago_main") or die("could not connect server");
//mysqli_select_db($conn, ) or die("could not connect database");
//Create New Account
if (isset($_POST['signup'])) {
    $fullname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['fullname'])));
    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['password'])));
    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['state'])));
    $lga = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['lga'])));
    $facility_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['facility'])));
    $type = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['type'])));
    $address = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['address'])));
    $gender = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['gender'])));
    $login = mysqli_num_rows(mysqli_query($conn, "select * from `default_phonegap_login` where `email`='$email'"));
    //echo $login;
    if ($login != 0) {
        echo "Hey! You already have account! you can login with it";
    } else {
        $date = date("d-m-y h:i:s");
        $q = mysqli_query($conn, "insert into `default_phonegap_login` (`reg_date`,`fullname`,`email`,`password`,`phone`,`state`,`lga`,`facility_id`,`type`,`address`,`gender`) values ('$date','$fullname','$email','$password','$phone','$state','$lga','$facility_id','$type','$address','$gender')");
        //echo $q;
        if ($q) {
            echo "Thank you for registering with us! Your account will be activated by the admin";
        } else {
            echo "Something Went wrong";
        }
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}

//Get All Programme Dropdown
if (isset($_POST['progdp'])) {
    $rrr = mysqli_query($conn, "select name, id from `default_programs`  where status = 1 order by name");
    $login = mysqli_num_rows($rrr);
    $dp = '<select name="programme" id="programme" class="form-control" style="background-color: #1B9E97;color: black;"><option value="" selected="selected" >- Select -</option>';
    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp .= "<option value='" . $v['id'] . "'>" . $v['name'] . "</option>";
        }
        $dp .= '</select>';
    }
    echo $dp;
}

//Get Available Facilities in LGA
if (isset($_POST['lgaload'])) {
    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['state'])));
    $lga = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['lga'])));

    $rrr = mysqli_query($conn, "SELECT name, id FROM `default_facility_details` WHERE state = lower('$state') and lga = lower('$lga') and statuss = 1 ORDER BY name");
    $login = mysqli_num_rows($rrr);
    $dp = '<select name="facility" id="facility" class="form-control" style="background-color: #1B9E97;color: black;"><option value="" selected="selected" >- Select -</option>';
    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp .= "<option value='" . $v['id'] . "'>" . $v['name'] . "</option>";
        }
        $dp .= '</select>';
    } else {
        $dp = '<select name="programme" id="programme" class="form-control" style="background-color: #1B9E97;color: black;"><option value="" selected="selected" >- No Facility Available -</option></select>';
    }
    echo $dp;
}

//Get Available Facilities in state in json
if (isset($_POST['stateload'])) {
    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['state'])));

    $rrr = mysqli_query($conn, "SELECT JSON_ARRAYAGG(JSON_OBJECT('id', id, 'lga', lga,'name', name)) as jsos FROM `default_facility_details` WHERE state = lower('$state') and statuss = 1 ORDER BY name");
    $login = mysqli_num_rows($rrr);
    $dp = '';
    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp .= $v['jsos'];
        }
    } 
    echo $dp;
}

//Get Available Facilities in LGA For SR
if (isset($_POST['getfac'])) {
    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['state'])));
    $lga = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['lga'])));
    $userid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['userid'])));

    $rrr = mysqli_query($conn, "SELECT f.name, f.id FROM `default_facility_details` f JOIN `default_states` s on s.name = f.state WHERE f.state = lower('$state') and f.lga = lower('$lga') and s.sr_id = $userid ORDER BY f.name");
    $login = mysqli_num_rows($rrr);
    $dp = '<select name="facility" id="facility" class="form-control" style="background-color: #1B9E97;color: black;"><option value="" selected="selected" >- Select -</option>';
    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp .= "<option value='" . $v['id'] . "'>" . $v['name'] . "</option>";
        }
        $dp .= '</select>';
    } else {
        $dp = '<select name="programme" id="programme" class="form-control" style="background-color: #1B9E97;color: black;"><option value="" selected="selected" >- No Facility Available -</option></select>';
    }
    echo $dp;
}



//Get activities

//Get Available Facilities in LGA
if (isset($_POST['actsload'])) {
    $range = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['range'])));
    $regid = (int) mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['regid'])));
    $rsplit = explode(':', $range);
    $from = $rsplit[0];
    $end =  $rsplit[1];

    $rrr = mysqli_query($conn, "SELECT
  (SELECT COUNT(*) FROM default_phonegap_surveys WHERE reg_id = $regid and date_screened BETWEEN '$from' AND '$end') as alll, 
  (SELECT COUNT(*) FROM default_phonegap_surveys WHERE reg_id = $regid AND gender != 'nil' AND date_screened BETWEEN '$from' AND  '$end') as pre,
  (SELECT COUNT(*)  FROM default_phonegap_surveys WHERE reg_id = $regid AND treated = 1  AND date_screened BETWEEN '$from' AND  '$end') as tre,
  (SELECT count(*)  FROM `default_test_results` JOIN `default_phonegap_surveys` `s` ON `s`.`id` = `default_test_results`.`survey_id` WHERE reg_id = $regid AND `afb` NOT IN ('negative', 'MTB not detected') AND `tb_lamp` NOT IN ('negative', 'MTB not detected') AND `chest_xray` NOT IN ('negative', 'MTB not detected') AND `gene_xpert` NOT IN ('negative', 'MTB not detected') AND date_screened BETWEEN '$from' AND  '$end') as pos,
  (SELECT count(*) FROM `default_test_results` JOIN `default_phonegap_surveys` `s` ON `s`.`id` = `default_test_results`.`survey_id` WHERE `afb` IN ('negative', 'MTB not detected') AND reg_id = $regid or `tb_lamp`  IN ('negative', 'MTB not detected') AND reg_id = $regid or `chest_xray` IN ('negative', 'MTB not detected') AND reg_id = $regid or `gene_xpert` IN ('negative', 'MTB not detected') AND reg_id = $regid  AND date_screened BETWEEN '$from' AND  '$end') as neg
  ");

    $login = mysqli_num_rows($rrr);
    $dp = '';
    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp = '<div class="col-md-6 col-12">
                                        <div class="box bg-info" style="margin-bottom:10px">
                                            <div class="box-body">
                                                <div class="text-center fd-box">
                                                    <i class="mdi mdi-lead-pencil font-size-30"></i>
                                                    <h1 style="font-size:1.5rem; padding: 0.5em 0;">'.$v['alll'].'</h1>
                                                    <p style="font-size: 14px; font-weight: bold;">Total Screened</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="box bg-dark" style="margin-bottom:10px">
                                            <div class="box-body">
                                                <div class="text-center fd-box">
                                                    <i class="mdi mdi-approval font-size-30"></i>
                                                    <h1 style="font-size:1.5rem; padding: 0.5em 0;">'.$v['pre'].'</h1>
                                                    <p style="font-size: 14px; font-weight: bold;">Total Presumptive</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="box bg-success" style="margin-bottom:10px">
                                            <div class="box-body">
                                                <div class="text-center fd-box">
                                                    <i class="mdi mdi-hospital font-size-30"></i>
                                                    <h1 style="font-size:1.5rem; padding: 0.5em 0;">'.$v['tre'].'</h1>
                                                    <p style="font-size: 14px; font-weight: bold;">Total Presented</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="box bg-danger" style="margin-bottom:10px">
                                            <div class="box-body">
                                                <div class="text-center fd-box">
                                                    <i class="mdi mdi-account-minus font-size-30"></i>
                                                    <h1 style="font-size:1.5rem; padding: 0.5em 0;">'.$v['neg'].'</h1>
                                                    <p style="font-size: 14px; font-weight: bold;">Total Negative</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="box bg-secondary" style="margin-bottom:10px">
                                            <div class="box-body">
                                                <div class="text-center fd-box">
                                                    <i class="mdi mdi-account-plus font-size-30"></i>
                                                    <h1 style="font-size:1.5rem; padding: 0.5em 0;">'.$v['pos'].'</h1>
                                                    <p style="font-size: 14px; font-weight: bold;">Total Positive</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
        }
       
    } else {
        $dp = '';
    }
    echo $dp;
}


//Create New Account
if (isset($_POST['addfacility'])) {
    $name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['name'])));
    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['state'])));
    $lga = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['lga'])));
    $type = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['type'])));
    $address = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['address'])));
    $programme = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['programme'])));
    $login = mysqli_num_rows(mysqli_query($conn, "select * from `default_facility_details` where `email`='$email'"));
    //echo $login;
    if ($login != 0) {
        echo "Hey! This Facility Has Been Added Before";
    } else {
        $date = date("d-m-y h:i:s");
        $q = mysqli_query($conn, "insert into `default_facility_details` (`name`,`email`,`phone`,`program_id`,`state`,`lga`,`address`,`type`) values ('$name','$email','$phone','$programme','$state','$lga','$address','$type')");
        //echo $q;
        if ($q) {
            echo "Thank you for adding this facility! It will be considered for approval";
        } else {
            echo "Something Went wrong";
        }
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}

//Upload Survey
if (isset($_POST['supost'])) {
    $mobil = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['mobile'])));
    $mobile = ($mobil) ? $mobil : '0';
    $nam = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['firstname'])));
    $name = ($nam) ? $nam : 'non-presumptive';
    $respondent = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['respondent'])));
    $cough = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cough'])));
    $more = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['more'])));
    $growth = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['growth'])));
    $details = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['details'])));
    $status = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['status'])));
    $facility = (int) mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['screenfacility'])));
    $weightloss = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['weightloss'])));
    $nightsweat = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['nightsweat'])));
    $fever = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['fever'])));
    $datess = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['datescreened'])));

    $age = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['age'])));
    $gender = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['gender'])));
    $address = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['address'])));
    $occupation = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['occupation'])));
    $marital = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['marital'])));
    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['state'])));
    $lga = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['lga'])));
    $reffacility = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['reffacility'])));
    $antitb = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['antitb'])));
    $hiv = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['hiv'])));
    $mode = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['mode'])));
    $regid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['regid'])));
    $longlat = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['longlat'])));
    $reffacility_int = (int) $reffacility;
    $reg_id = (int) $regid;
    $piid = date('Hisy');
	$reference_id = '0';

	if(strtolower($status) == 'yes'){
		$searchsource1 = mysqli_query($conn, "select * from `default_facility_details` where `id`=$facility");
        $sourcefacc = mysqli_fetch_array($searchsource1);
        $facility_name = $sourcefacc['name'];
        $facility_state = $sourcefacc['state'];
        $facility_lga = $sourcefacc['lga'];

		$patient_id = tothree($facility_state) . '-' . tothree($facility_lga) . '-' . tothree($facility_name) . '-' . $piid;
        $reference_id = $patient_id;
	}else{
		$reference_id = $piid;
	}

    $dates = dateconvert($datess);

    $date = date("y-m-d", strtotime("-2 weeks"));

    $rrr = mysqli_query($conn, "select * from `default_phonegap_surveys` where `date_uploaded`>'$date' and `firstname`='$name' and `mobile`='$mobile' and `mobile`!='nil' and `respondent`= $respondent");
    $login = mysqli_num_rows($rrr);
    //echo $login;
    if ($login != 0) {
        $data = mysqli_fetch_array($rrr);
        mysqli_query($conn, "update `default_phonegap_surveys` set `date_screened`=$dates,`respondent`=$respondent,`cough`=$cough,`more`=$more,`growth`=$growth,`details`='$details',`facility_id`=$facility,`status`='$status',`weightloss`='$weightloss',`fever`='$fever',`nightsweat`='$nightsweat',`age`='$age',`gender`='$gender',`address`='$address',`occupation`='$occupation',`marital`='$marital',`state`='$state',`lga`='$lga',`reffacility`='$reffacility',`antitb`='$antitb',`hiv`='$hiv',`mode`='$mode' where `firstname`='$name' and `mobile`='$mobile' and `reference_id`='$reference_id' and `reg_id`=$reg_id and `longlat`='$longlat'");
        echo "exist:" . ucfirst($data['status']);
    } else {
        $q = mysqli_query($conn, "insert into `default_phonegap_surveys` (`firstname`,`mobile`,`respondent`,`cough`,`more`,`growth`,`details`,`facility_id`,`status`,`weightloss`,`nightsweat`,`fever`,`date_screened`,`age`,`gender`,`address`,`occupation`,`marital`,`state`,`lga`,`reffacility`,`antitb`,`hiv`,`mode`,`reference_id`,`reg_id`,`longlat`) values ('$name','$mobile',$respondent,$cough,$more,$growth,'$details',$facility,'$status','$weightloss','$nightsweat','$fever','$dates','$age','$gender','$address','$occupation','$marital','$state','$lga','$reffacility','$antitb','$hiv','$mode','$reference_id',$reg_id,'$longlat')");
        //echo $q; State-LGA-ScrenningFacilityID-PatientID
        if ($q) {
            if (strtolower($status) == 'yes') {
                $searchsource = mysqli_query($conn, "select * from `default_facility_details` where `id`=$facility");
                $sourcefac = mysqli_fetch_array($searchsource);
                $searchref = mysqli_query($conn, "select * from `default_facility_details` where `id`=$reffacility_int");
                $reffac = mysqli_fetch_array($searchref);

                $scname = $sourcefac['name'];
                $rfname = $reffac['name'];
                $sclga = $sourcefac['lga'];
                $rflga = $reffac['lga'];
                $scstate = $sourcefac['state'];
                $rfstate = $reffac['state'];
                $scemail = $sourcefac['email'];
                $rfemail = $reffac['email'];
                $scphone = $sourcefac['phone'];
                $rfphone = $reffac['phone'];

                $subject = "MATS Presumptive Alert";
                $smssubject = "MATS Alert";

                if ($reffacility_int == $facility) {
                    $message = "<p><strong>Hello $scname</strong>,</p><p>You have done self referral of the person you have screened with details below:</p><strong>Name: $name<br/>Gender: $gender<br/>Address: $address<br/>Phone Number: $mobile</strong><br/><br/>Thank you!";
                    //$message = ""
                    sendMailReferral($scemail, $subject, $message);
                    sendSMS($scphone, $smssubject, $message);
                } else {
                    $message1 = "<p><strong>Hello $rfname</strong>,</p><p>Presumptive case has just been detected at <strong>$scname, $lga, $state State</strong> and it has been referred to your facility ($rfname) for further treatment.</p> <p>Please do assist and treat as urgent and below are the details of the presumtive:</p><strong>Name: $name<br/>Gender: $gender<br/>Address: $address<br/>Phone Number: $mobile</strong><br/><br/>Thank you!";
                   /* $message2 = "<p><strong>Hello $scname</strong>,</p><p>Presumptive case has just been detected at your facility and it has been referred to this facility <strong>($rfname, $lga, $state state)</strong> for further treatment. Please do assist in any way you can</p> Thank you!";*/
                    $message2 = "<p><strong>Dear $scname</strong>,</p><p>A presumptive TB case has just been detected in your facility and it has been referred to this facility <strong>($rfname, $lga, $state state)</strong> for further evaluation. Please follow-up to ensure this individual is tested and subsequently managed.<p>For enquiry or to troubleshoot challenges, please contact Dr. Egbedeyi Olufunsho via f.egbedeyi@pharmaccess.org</p><p>Kind regards<p>";
                    sendMailReferral($rfemail, $subject, $message1);
                    sendMailReferral($scemail, $subject, $message2);

                    sendSMS($rfphone, $smssubject, $message1);
                    sendSMS($scphone, $smssubject, $message2);
                }

            }
            //create eTB Manager API

            echo "success:0";
        } else {
            echo "failed:0;";
        }
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}

//Login
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['password'])));
    $loc = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['loc'])));
    $lll = mysqli_query($conn, "select * from `default_phonegap_login`  join `default_facility_details`  on `default_phonegap_login`.`facility_id` = `default_facility_details`.`id` where `default_phonegap_login`.`email`='$email' and `default_phonegap_login`.`password`='$password' and `default_phonegap_login`.`facility_id` != 8 and `default_phonegap_login`.`statusi`=1");
    $login = mysqli_num_rows($lll);
    //echo $login;
    if ($login != 0) {
        $data = mysqli_fetch_array($lll);
        $ssid = $data['reg_id'];
        $datelogin = date("Y-m-d");

        $rrr = mysqli_query($conn, "update `default_phonegap_login` set login_longlat = '$loc', login_date = '$datelogin' where reg_id = $ssid");

        echo "success:" . $data['facility_id'] . ":" . $data['fullname'] . ":" . $data['name']. ":" . $data['reg_id']. ":" . $data['pix'];
    } else {
        echo "failed:0";
    }
}

//Change Password
if (isset($_POST['change_password'])) {
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $old_password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['old_password'])));
    $new_password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['new_password'])));
    $check = mysqli_num_rows(mysqli_query($conn, "select * from `default_phonegap_login` where `email`='$email' and `password`='$old_password'"));
    // echo $check;
    if ($check != 0) {
        mysqli_query($conn, "update `default_phonegap_login` set `password`='$new_password' where `email`='$email'");
        echo "Password Changed successfully";
    } else {
        echo "Your old password is incorrect";
    }
}


//Update Pix
if (isset($_POST['pix'])) {
    $sid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sid'])));
    $pic = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['pic'])));
    $check = 1;
    // echo $check;
    if ($check != 0) {
        mysqli_query($conn, "update `default_phonegap_login` set `pix`='$pic' where `reg_id`=$sid");
        echo "Profile Picture Updated Successfully";
    } else {
        echo "Error In Profile Picture Update";
    }
}

// Forget Password
if (isset($_POST['forget_password'])) {
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $q = mysqli_query($conn, "select * from `default_phonegap_login` where `email`='$email'");
    $check = mysqli_num_rows($q);
    if ($check != 0) {
        echo "we have sent password to your email address, please check";
        $data = mysqli_fetch_array($q);
        $string = "Hey," . $data['fullname'] . ", Your password is" . $data['password'];
        mail($email, "Your Password", $string);
    } else {
        echo "Your have not registered with us";
    }
}

function sendMail($to, $subject, $message) {
    $headers = 'From: report@matslagos.com.ng' . "\r\n" .
            'Reply-To: report@matslagos.com.ng' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}

function tothree($text) {
    if (preg_match('/\s/', $text) == 0) {
        $three = substr($text, 0, 3);
    } else {
        $exs = explode(" ", $text);
        $two = substr($exs[0], 0, 2);
        $one = substr($exs[1], 0, 1);
        $three = $two.$one;
    }
    return strtoupper($three);
}

function sendMailReferral($to, $subject, $message) {
    $headers = 'From: referral@matslagos.com.ng' . "\r\n" .
            'Reply-To: referral@matslagos.com.ng' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}

function sendSMS($phone, $subject, $message) {
}

function dateconvert($var) {
    $date = explode('/', $var);
    $year = $date[2];
    $dtm = DateTime::createFromFormat('m', $date[0]);
    $month = $dtm->format('m');
    $dtd = DateTime::createFromFormat('d', $date[1]);
    $day = $dtd->format('d');
    return $year . '-' . $month . '-' . $day;
}
?>

