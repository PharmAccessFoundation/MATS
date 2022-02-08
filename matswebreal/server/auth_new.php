<?php

header("Access-Control-Allow-Origin: *");

//Connect & Select Database
//$conn = mysqli_connect("localhost", "root", "", "pharmaccess") or die("could not connect server");
//$conn = mysqli_connect("matslagos.com.ng", "matslago_mats", "busayo123$", "matslago_mats") or die("could not connect server");
$conn = mysqli_connect("10.128.62.33", "mats", "matsremote", "mats_main") or die("could not connect server");
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
    $login = mysqli_num_rows(mysqli_query($conn, "select * from `default_phonegap_login` where `email`='$email'"));
    //echo $login;
    if ($login != 0) {
        echo "Hey! You already have account! you can login with it";
    } else {
        $date = date("d-m-y h:i:s");
        $q = mysqli_query($conn, "insert into `default_phonegap_login` (`reg_date`,`fullname`,`email`,`password`,`phone`,`state`,`lga`,`facility_id`) values ('$date','$fullname','$email','$password','$phone','$state','$lga','$facility_id')");
        //echo $q;
        if ($q) {
            echo "Thank you for Registering with us! you can login now"; 
        } else {
            echo "Something Went wrong";
        }
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}

//Get All Programme Dropdown
if (isset($_POST['progdp'])) {
 $rrr = mysqli_query($conn, "select name, id from `default_programs` order by name");
    $login = mysqli_num_rows($rrr);
    $dp = '<select name="programme" id="programme" class="form-control" style="background-color: #3b8ec2;color: black;"><option value="" selected="selected" >- Select -</option>';
    //echo $login;
    if ($login != 0) {
       
        foreach ($rrr as $v) {
       // var_dump($v);
            $dp .= "<option value='".$v['id']."'>".$v['name']."</option>";
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
    $dp = '<select name="facility" id="facility" class="form-control" style="background-color: #3b8ec2;color: black;"><option value="" selected="selected" >- Select -</option>';
    //echo $login;
    if ($login != 0) {
       
        foreach ($rrr as $v) {
       // var_dump($v);
            $dp .= "<option value='".$v['id']."'>".$v['name']."</option>";
        }
        $dp .= '</select>';

    }else{
        $dp = '<select name="programme" id="programme" class="form-control" style="background-color: #3b8ec2;color: black;"><option value="" selected="selected" >- No Facility Available -</option></select>';
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
    $programme = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['programme'])));
    $login = mysqli_num_rows(mysqli_query($conn, "select * from `default_facility_details` where `email`='$email'"));
    //echo $login;
    if ($login != 0) {
        echo "Hey! This Facility Has Been Added Before";
    } else {
        $date = date("d-m-y h:i:s");
        $q = mysqli_query($conn, "insert into `default_facility_details` (`name`,`email`,`phone`,`program_id`,`state`,`lga`) values ('$name','$email','$phone','$programme','$state','$lga')");
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

    $dates = dateconvert($datess);

    $date = date("y-m-d", strtotime("-2 weeks"));

    $rrr = mysqli_query($conn, "select * from `default_phonegap_surveys` where `date_uploaded`>'$date' and `firstname`='$name' and `mobile`='$mobile' and `mobile`!='nil' and `respondent`= $respondent");
    $login = mysqli_num_rows($rrr);
    //echo $login;
    if ($login != 0) {
        $data = mysqli_fetch_array($rrr);
        mysqli_query($conn, "update `default_phonegap_surveys` set `date_screened`=$dates,`respondent`=$respondent,`cough`=$cough,`more`=$more,`growth`=$growth,`details`='$details',`facility_id`=$facility,`status`='$status',`weightloss`='$weightloss',`fever`='$fever',`nightsweat`='$nightsweat',`age`='$age',`gender`='$gender',`address`='$address',`occupation`='$occupation',`marital`='$marital',`state`='$state',`lga`='$lga',`reffacility`='$reffacility',`antitb`='$antitb',`hiv`='$hiv',`mode`='$mode' where `firstname`='$name' and `mobile`='$mobile'");
        echo "exist:" . ucfirst($data['status']);
    } else {
        $q = mysqli_query($conn, "insert into `default_phonegap_surveys` (`firstname`,`mobile`,`respondent`,`cough`,`more`,`growth`,`details`,`facility_id`,`status`,`weightloss`,`nightsweat`,`fever`,`date_screened`,`age`,`gender`,`address`,`occupation`,`marital`,`state`,`lga`,`reffacility`,`antitb`,`hiv`,`mode`) values ('$name','$mobile',$respondent,$cough,$more,$growth,'$details',$facility,'$status','$weightloss','$nightsweat','$fever','$dates','$age','$gender','$address','$occupation','$marital','$state','$lga','$reffacility','$antitb','$hiv','$mode')");
         //echo $q;
        if ($q) {
            if (strtolower($status) == 'yes') {
                $arr1 = array(
                    1 => 'Mobonike Hospital',
                    2 => 'Mayfair Medical Centre',
                    7 => 'Emmanuel Padua Maternal Home',
                    12 => 'Eternal Life Hospital',
                    16 => 'Folabi Medical Centre',
                    24 => 'Ahmadiyyah Muslim Hospital',
                    33 => 'St. Catherine of Siena Medical Centre',
                    34 => 'St. John the Evangelical Parish Clinic',
                    48 => 'Christ Foundation Hospital',
                    60 => 'R-Jolad Hospital'
                );

                $arr2 = array(
                    3 => 'Adeoti Hospital',
                    10 => 'El-Dunamis Medical Centre',
                    11 => 'Agape Medical Centre',
                    13 => 'Adefemi Hospital',
                    18 => 'Lota Hospital',
                    19 => 'Crest Hospital',
                    41 => 'G & T Nursing and Maternity',
                    43 => 'Community Health Development Initiative',
                    47 => 'Anthony Cardinal Okojie Maternity Centre Ikoga Badagry',
                    49 => 'Longe Medical Centre',
                );

                $arr3 = array(
                    4 => 'Salem Hospital',
                    5 => 'Promise Medical Centre',
                    21 => 'EHJ (Eucharistic Heart of Jesus) Catholic Hospital',
                    23 => 'Unita Hospital',
                    35 => 'Community Health Project Amukoko (St. Theresa)',
                    39 => 'Ogunmodede Memorial Hospital',
                    44 => 'Bissalam Hospital',
                    46 => 'Renue Clinic',
                    50 => 'Anthony Cardinal Okojie Medical Centre New Oko-Oba',
                    51 => 'G & S Medical and Dental Hospital',
                );

                $arr4 = array(
                    6 => 'St. Sabina Hospital',
                    14 => 'Al-Sadiq Memorial Clinic',
                    15 => 'Delta Crown Hospital',
                    20 => 'Akanbi Hospital',
                    28 => 'Deseret International Hospital',
                    38 => 'Mucas Hospital',
                    40 => 'Gowon Estate Clinic',
                    42 => 'Light Hospital and Maternity Home',
                    52 => 'Holy Trinity Hospital',
                    59 => 'Ladi-Lak Hospital',
                );

                $arr5 = array(
                    61 => 'Subol Hospital',
                    9 => 'Mojol Hospital',
                    29 => 'Christ the Healer Clinic and Maternity',
                    30 => 'Muskat Hospital',
                    32 => 'Ancel Hospital',
                    53 => 'Church of God Mission',
                    54 => 'Goodness Medical Centre',
                    55 => 'Everlife Hospital',
                    56 => 'Ademola Hospital',
                    57 => 'Ilogbo Central Hospital',
                );

                $arr6 = array(
                    17 => 'Hillstar Hospital',
                    22 => 'Solad Medical Centre',
                    25 => 'Sacred Heart Hospital',
                    26 => 'Iduna Specialist Hospital',
                    27 => 'Syban Hospital',
                    31 => 'Munidola Clinic',
                    36 => 'Tolu Medical Centre 2 (Ojo Road)',
                    37 => 'Faleti Medical Centre',
                    45 => 'Life Fount Medical Centre',
                    58 => 'OnyemsB Hospital',
                );
                $arr_main = array('vivianokafor200@gmail.com', 'lauratomicyn@gmail.com', 'oluwayomiadebayo@gmail.com', 'akpunonucynthia@gmail.com', 'foluwakea@yahoo.com', 'ebinehitaagboifoh1@gmail.com',);
                $arr_name = array('Vivian Okafor', 'Laura Alegbemi', 'Yomi Akinbo', 'Amaka Akpunonu', 'Foluke Sogunwa', 'Ebinehita Agboifoh');
                $arr_arr = array($arr1, $arr2, $arr3, $arr4, $arr5, $arr6);

                $to = '';
                $name = '';
                $fcname = '';

                foreach ($arr_arr as $key => $arr) {
                    if (array_key_exists($facility, $arr)) {
                        $to = $arr_main[$key];
                        $name = $arr_name[$key]; 
                        $fcname = $arr[$facility];
                        break;
                    }
                }

                $subject = "MATS Presumptive Alert";
                $message = "Hello $name, presumptive case has just been detected in this facility: $fcname";
                sendMail($to, $subject, $message);
            }

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
    $lll = mysqli_query($conn, "select * from `default_phonegap_login`  join `default_facility_details`  on `default_phonegap_login`.`facility_id` = `default_facility_details`.`id` where `default_phonegap_login`.`email`='$email' and `default_phonegap_login`.`password`='$password' and `default_phonegap_login`.`facility_id` != 8 and `default_phonegap_login`.`statusi`=1");
    $login = mysqli_num_rows($lll);
    //echo $login;
    if ($login != 0) {
        $data = mysqli_fetch_array($lll);
        echo "success:" . $data['facility_id'] . ":" . $data['fullname'] . ":" . $data['name'];
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
            'MIME-Version: 1.0' . '\r\n' .
            'Content-type:text/html;charset=UTF-8' . '\r\n' .
            'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}

function sendMailReferral($to, $subject, $message) {
    $headers = 'From: referral@matslagos.com.ng' . "\r\n" .
            'Reply-To: referral@matslagos.com.ng' . "\r\n" .
            'MIME-Version: 1.0' . '\r\n' .
            'Content-type:text/html;charset=UTF-8' . '\r\n' .
            'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}

function dateconvert($var) {
    $date = explode('/', $var);
    $year = $date[2];
    $dtm = DateTime::createFromFormat('m', $date[0]);
    $month = $dtm->format('m');
    $dtd = DateTime::createFromFormat('d', $date[1]);
    $day = $dtd->format('d');
    return $year.'-'.$month.'-'.$day;
}

?>

