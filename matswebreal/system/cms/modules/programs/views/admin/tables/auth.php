<?php

header("Access-Control-Allow-Origin: *");

//Connect & Select Database
$conn = mysqli_connect("localhost", "hpar_main", "newstaff123$", "hpar_main") or die("could not connect server");
//$conn = mysqli_connect("matslagos.com.ng", "matslago_mats", "busayo123$", "matslago_mats") or die("could not connect server");
//mysqli_select_db($conn, ) or die("could not connect database");
//Login
if (isset($_POST['login'])) {
    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['password'])));
    $lll = mysqli_query($conn, "select *, `default_phonegap_login`.id as sid from `default_phonegap_login` join `default_programs` p on p.id = ward_id join  `default_program_comms` c on c.id = comm_id  where `phone`='$phone' and `password`='$password' and `default_phonegap_login`.`status`= 1");
    $login = mysqli_num_rows($lll);

    $rrr = mysqli_query($conn, "SELECT threshold_score FROM `default_program_methods` WHERE name = 'PPI'");
    $login2 = mysqli_num_rows($rrr);

    $rrrr = mysqli_query($conn, "SELECT threshold_score FROM `default_program_methods` WHERE name = 'Community'");
    $login22 = mysqli_num_rows($rrrr);
    //echo $login;
    if ($login != 0 && $login2 != 0 && $login22 != 0) {
        $data = mysqli_fetch_array($lll);
        $ppi = mysqli_fetch_array($rrr);
        $comm = mysqli_fetch_array($rrrr);

        echo "success:" . $data['phone'] . ":" . $data['first'] . ":" . $data['middle'] . ":" . $data['surname'] . ":" . $data['state'] . ":" . $data['lga'] . ":" . $data['national'] . ":" . $data['address'] . ":" . $data['sex'] . ":" . $data['pix'] . ":" . $data['ward'] . ":" . $data['comm'] . ":" . $data['ward_id'] . ":" . $data['sid'] . ":" . $ppi['threshold_score'] . ":" . $comm['threshold_score'] . ":" . $data['date_added'];
    } else {
        echo "failed:0";
    }
}


//Create New Account
if (isset($_POST['signup'])) {

    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $middle = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['middle'])));
    $surname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['surname'])));
    $sex = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sex'])));
    $address = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['address'])));
    $national = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['national'])));
    $first = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['first'])));
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['state'])));
    $lga = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['lga'])));
    $reslga = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['reslga'])));
    $comm = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['comm'])));
    $ward = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['ward'])));
    $pix = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['pix'])));
    $password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['password'])));

    $login = mysqli_num_rows(mysqli_query($conn, "select * from `default_phonegap_login` where `phone`='$phone'"));
    //echo $login;
    if ($login != 0) {
        echo "Hey! You already have account! you can login with it";
    } else {
        $date = date("d-m-y h:i:s");
        $q = mysqli_query($conn, "insert into `default_phonegap_login` (`phone`,`middle`,`surname`,`sex`,`address`,`national`,`first`,`email`,`state`,`lga`,`pix`,`password`,`comm_id`,`ward_id`,`reslga`) values ('$phone','$middle','$surname','$sex','$address','$national','$first','$email','$state','$lga','$pix','$password','$comm','$ward','$reslga')");
        //echo $q;
        if ($q) {
            echo "Thank you for registering with us! Your account will be confirmed by the admin";
        } else {
            echo "Something Went wrong";
        }
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}

// Principal Insert
if (isset($_POST['pr'])) {
    $sname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sname'])));
    $fname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['fname'])));
    $mname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['mname'])));
    $dob = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['dob'])));
    $sex = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sex'])));
    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $altphone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['altphone'])));
    $passport = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['passport'])));
    $marital = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['marital'])));
    $address = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['address'])));
    $hhid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['hhid'])));
    $spousecount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['spousecount'])));
    $dependentcount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['dependcount'])));
    $datescreened = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['datescreened'])));
    $reg_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['reg_id'])));
    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['state'])));
    $lga = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['lga'])));
    $wardid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['wardid'])));
    $commid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['commid'])));

    $q = mysqli_query($conn, "insert into `default_program_households` (`reg_id`,`sname`,`fname`,`mname`,`dob`,`sex`,`phone`,`altphone`,`passport`,`marital`,`address`,`hhid`,`spousecount`,`dependcount`,`date_registered`,`state`,`lga`,`ward`,`comm`) values ('$reg_id','$sname','$fname','$mname','$dob','$sex','$phone','$altphone','$passport','$marital','$address','$hhid','$spousecount','$dependentcount','$datescreened','$state','$lga','$wardid','$commid')");
    //echo $q;
    if ($q) {
        echo true;
    } else {
        echo "Something Went wrong";
    }

    echo mysqli_error($conn);
    mysqli_close($conn);
}


// Spouse Insert
if (isset($_POST['sp'])) {
    $sname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sname'])));
    $fname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['fname'])));
    $mname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['mname'])));
    $dob = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['dob'])));
    $sex = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sex'])));
    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $altphone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['altphone'])));
    $passport = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['passport'])));
    $hhid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['hhid'])));

    $q = mysqli_query($conn, "insert into `default_program_spouses` (`sname`,`fname`,`mname`,`dob`,`sex`,`phone`,`altphone`,`passport`,`hhid`) values ('$sname','$fname','$mname','$dob','$sex','$phone','$altphone','$passport','$hhid')");
    //echo $q;
    if ($q) {
        echo true;
    } else {
        echo "Something Went wrong";
    }

    echo mysqli_error($conn);
    mysqli_close($conn);
}

// Dependent Insert
if (isset($_POST['dp'])) {
    $sname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sname'])));
    $fname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['fname'])));
    $mname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['mname'])));
    $dob = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['dob'])));
    $sex = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sex'])));
    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $altphone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['altphone'])));
    $passport = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['passport'])));
    $hhid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['hhid'])));

    $q = mysqli_query($conn, "insert into `default_program_dependents` (`sname`,`fname`,`mname`,`dob`,`sex`,`phone`,`altphone`,`passport`,`hhid`) values ('$sname','$fname','$mname','$dob','$sex','$phone','$altphone','$passport','$hhid')");
    //echo $q;
    if ($q) {
        echo true;
    } else {
        echo "Something Went wrong";
    }

    echo mysqli_error($conn);
    mysqli_close($conn);
}


//Create New Community
if (isset($_POST['addcomm'])) {

    $name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['name'])));
    $method = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['method'])));
    $wardid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['wardid'])));

    $q = mysqli_query($conn, "insert into `default_program_comms` (`ward_id`,`name`,`screen_method`,`status`) values ($wardid,'$name',$method, 0)");
    //echo $q;
    if ($q) {
        echo "Thank you for creating new community! It will be confirmed by the admin";
    } else {
        echo "Something Went wrong";
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}

//Insert Question
if (isset($_POST['quest'])) {
    $ques = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['ques'])));
    $agent = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['agent'])));
    $lga = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['lga'])));
    $ward = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['ward'])));
    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['state'])));
    $comm = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['comm'])));
    $datescreened = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['datescreened'])));

    $q = mysqli_query($conn, "insert into `default_program_questions` (`agent_id`,`state`,`lga`,`ward`,`comm`,`question`,`date_created`) values ($agent,'$state','$lga','$ward','$comm','$ques','$datescreened')");
    $last_id = mysqli_insert_id($conn);
    //echo $q;
    if ($q) {
        echo true;
    } else {
        echo "Something Went wrong";
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}



//Insert Screen Offline
if (isset($_POST['pushscreenoff'])) {
    $score = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['offscore'])));
    $agent = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['offagent'])));
    $threshold = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['offthreshold'])));
    $screen = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['offscreen'])));
    $commid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['commid'])));
    $hcount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['hcount'])));
    $datescreened = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['offdatescreened'])));

    $q = mysqli_query($conn, "insert into `default_program_screens` (`agent_id`,`screen_method`,`household_score`,`threshold_score`,`comm_id`,`household_count`,`date_screened`) values ($agent,$screen,$score,$threshold,$commid,$hcount, $datescreened)");
    //echo $q;
    if ($q) {
        echo "THE SCREENED HOUSEHOLD SCORE IS  " . $score;
    } else {
        echo "Something Went wrong";
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}

//Insert Screen
if (isset($_POST['pushscreen'])) {
    $score = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['score'])));
    $agent = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['agent'])));
    $threshold = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['threshold'])));
    $screen = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['screen'])));
    $datescreened = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['datescreened'])));
    $commid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['commid'])));
    $hcount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['hcount'])));

    $q = mysqli_query($conn, "insert into `default_program_screens` (`agent_id`,`screen_method`,`household_score`,`threshold_score`,`comm_id`,`household_count`,`date_screened`) values ($agent,$screen,$score,$threshold,$commid,$hcount, $datescreened)");
    //$last_id = mysqli_query($conn,"SELECT LAST_INSERT_ID()");
    $last_id = mysqli_insert_id($conn);
    //echo $q;
    if ($q) {
        // echo "THE SCREENED HOUSEHOLD SCORE IS  " . $score;
        echo $last_id;
    } else {
        echo "Something Went wrong";
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}



if (isset($_POST['wardload'])) {

    $state = mysqli_real_escape_string($conn, htmlspecialchars(trim(strtolower($_POST['state']))));
    $lga = mysqli_real_escape_string($conn, htmlspecialchars(trim(strtolower($_POST['lga']))));

    $rrr = mysqli_query($conn, "SELECT ward, id FROM `default_programs` WHERE state = '$state' and lga = '$lga' and status = 1 ORDER BY ward");
    $login = mysqli_num_rows($rrr);
    $dp = '<select name="ward" onchange="comms()" id="ward" class="form-control" style=""><option value="" selected="selected" >- Select -</option>';
    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp .= "<option value='" . $v['id'] . "'>" . $v['ward'] . "</option>";
        }
        $dp .= '</select>';
    } else {
        $dp = '<select name="ward" id="ward" class="form-control" style=""><option value="" selected="selected" >- No Ward Available -</option></select>';
    }
    echo $dp;
}

if (isset($_POST['commload'])) {

    $wardid = mysqli_real_escape_string($conn, htmlspecialchars(trim(strtolower($_POST['wardid']))));

    $rrr = mysqli_query($conn, "SELECT name, id FROM `default_program_comms` WHERE ward_id = '$wardid' and status = 1");
    $login = mysqli_num_rows($rrr);
    $dp = '<select name="comm" id="comm" class="form-control" style=""><option value="" selected="selected" >- Select -</option>';
    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp .= "<option value='" . $v['id'] . "'>" . $v['name'] . "</option>";
        }
        $dp .= '</select>';
    } else {
        $dp = '<select name="comm" id="comm" class="form-control" style=""><option value="" selected="selected" >- No Ward Available -</option></select>';
    }
    echo $dp;
}

//load comunity with method
if (isset($_POST['commload2'])) {

    $wardid = mysqli_real_escape_string($conn, htmlspecialchars(trim(strtolower($_POST['wardid']))));

    $rrr = mysqli_query($conn, "SELECT name, screen_method, id FROM `default_program_comms` WHERE ward_id = '$wardid' and status = 1");
    $login = mysqli_num_rows($rrr);
    $dp = '<select name="comm" id="comm" class="form-control" style=""><option value="" selected="selected" >- Select -</option>';
    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp .= "<option value='" . $v['id'] . ":" . $v['screen_method'] . "'>" . $v['name'] . "</option>";
        }
        $dp .= '</select>';
    } else {
        $dp = '<select name="comm" id="comm" class="form-control" style=""><option value="" selected="selected" >- No Ward Available -</option></select>';
    }
    echo $dp;
}


//Get Scores

if (isset($_POST['getscore'])) {

    $sid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sid'])));

    $rrr = mysqli_query($conn, "SELECT threshold_score FROM `default_program_methods` WHERE id = $sid");
    $login = mysqli_num_rows($rrr);

    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp = $v['threshold_score'];
        }
    } else {
        $dp = 'Score Error';
    }
    echo $dp;
}

//Get Screened Households

if (isset($_POST['gethouse'])) {

    $sid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sid'])));

    $rrr = mysqli_query($conn, "SELECT household_score,household_count,comm_id,date_uploaded FROM `default_program_screens` where agent_id = $sid and status = 0 and comm_id = (select comm_id from `default_program_screens` order by date_uploaded desc LIMIT 1) ORDER by household_score DESC ");
    $login = mysqli_num_rows($rrr);

    //echo $login;
    if ($login != 0) {
        $dp = '';
        foreach ($rrr as $data) {
            $dp .= $data['household_score'] . ":" . $data['household_count'] . ":" . $data['comm_id']. ":" . $data['date_uploaded']. "|";
        }
    } else {
        $dp = false;
    }
    echo $dp;
}


//load Household Count

if (isset($_POST['getcount'])) {

    $sid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sid'])));

    $rrr = mysqli_query($conn, "SELECT count(id) as counta FROM `default_program_screens` WHERE screen_method = $sid");
    $login = mysqli_num_rows($rrr);

    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp = $v['counta'];
        }
    } else {
        $dp = 'Count Error';
    }
    echo $dp;
}


//load Current Question

if (isset($_POST['getquest'])) {

    $sid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sid'])));
    $commid = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['commid'])));

    $rrr = mysqli_query($conn, "SELECT question FROM `default_program_questions` WHERE agent_id = $sid  and comm = '$commid' ORDER BY id DESC LIMIT 1");
    $login = mysqli_num_rows($rrr);

    //echo $login;
    if ($login != 0) {

        foreach ($rrr as $v) {
            // var_dump($v);
            $dp = $v['question'];
        }
    } else {
        $dp = false;
    }
    echo $dp;
}

//Change Password
if (isset($_POST['change_password'])) {
    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $old_password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['old_password'])));
    $new_password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['new_password'])));
    $check = mysqli_num_rows(mysqli_query($conn, "select * from `default_phonegap_login` where `email`='$email' and `password`='$old_password'"));
    // echo $check;
    if ($check != 0) {
        mysqli_query($conn, "update `default_phonegap_login` set `password`='$new_password' where `phone`='$phone'");
        echo "Password Changed successfully";
    } else {
        echo "Your old password is incorrect";
    }
}

// Forget Password
if (isset($_POST['forget_password'])) {
    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $q = mysqli_query($conn, "select * from `default_phonegap_login` where `phone`='$phone'");
    $check = mysqli_num_rows($q);
    if ($check != 0) {
        echo "we have sent password to your email address, please check";
        $data = mysqli_fetch_array($q);
        $string = "Hey," . $data['first'] . ", Your password is " . $data['password'];
        mail($data['email'], "Your Password", $string);
    } else {
        echo "Your have not registered with us";
    }
}

function sendMail($to, $subject, $message) {
    $headers = 'From: report@mmpost.ng' . "\r\n" .
            'Reply-To: report@mmpost.ng' . "\r\n" .
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
    return $year . '-' . $month . '-' . $day;
}
?>

