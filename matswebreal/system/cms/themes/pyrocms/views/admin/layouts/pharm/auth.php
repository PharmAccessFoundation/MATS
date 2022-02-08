<?php

header("Access-Control-Allow-Origin: *");

//Connect & Select Database
//$conn = mysqli_connect("localhost", "root", "", "pharmaccess") or die("could not connect server");
//$conn = mysqli_connect("showmeg.org", "showmeg_pharmm", "buston123$", "showmeg_pharm") or die("could not connect server");

$conn = mysqli_connect("107.151.3.66", "pharmaccessmats", "busayo123$", "pharmacc_mats") or die("could not connect server");
//mysqli_select_db($conn, ) or die("could not connect database");
//Create New Account
if (isset($_POST['signup'])) {
    $fullname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['fullname'])));
    $phone = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['phone'])));
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['password'])));
    $login = mysqli_num_rows(mysqli_query($conn, "select * from `default_phonegap_login` where `email`='$email'"));
    //echo $login;
    if ($login != 0) {
        echo "exist";
    } else {
        $date = date("d-m-y h:i:s");
        $q = mysqli_query($conn, "insert into `default_phonegap_login` (`reg_date`,`fullname`,`email`,`password`,`phone`) values ('$date','$fullname','$email','$password','$phone')");
        //echo $q;
        if ($q) {
            echo "success";
        } else {
            echo "failed";
        }
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}

//Upload Survey
if (isset($_POST['supost'])) {
    $mobile = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['mobile'])));
    $name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['name'])));
    $respondent = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['respondent'])));
    $cough = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cough'])));
    $more = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['more'])));
    $growth = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['growth'])));
    $details = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['details'])));
    $status = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['status'])));
    $facility = (int) mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['facility'])));

    

    $date = date("y-m-d",strtotime("-1 month"));

    $rrr = mysqli_query($conn, "select * from `default_phonegap_surveys` where `date_uploaded`>'$date' and `firstname`='$name' and `mobile`='$mobile' and `respondent`= $respondent");
    $login = mysqli_num_rows($rrr);
    //echo $login;
    if ($login != 0) {
        $data = mysqli_fetch_array($rrr);
         mysqli_query($conn, "update `default_phonegap_surveys` set `respondent`=$respondent,`cough`=$cough,`more`=$more,`growth`=$growth,`details`='$details',`facility_id`=$facility,`status`='$status' where `firstname`='$name' and `mobile`='$mobile'");
        echo "exist:" . $data['status'];
    } else {
        $q = mysqli_query($conn, "insert into `default_phonegap_surveys` (`firstname`,`mobile`,`respondent`,`cough`,`more`,`growth`,`details`,`facility_id`,`status`) values ('$name','$mobile',$respondent,$cough,$more,$growth,'$details',$facility,'$status')");
        //echo $q;
        if ($q) {
            echo "success:0";
        } else {
            echo "failed:0";
        }
    }
    echo mysqli_error($conn);
    mysqli_close($conn);
}

//Login
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['password'])));
    $lll = mysqli_query($conn, "select * from `default_phonegap_login` where `email`='$email' and `password`='$password' and facility_id != 8");
    $login = mysqli_num_rows($lll);
    //echo $login;
    if ($login != 0) {
        $data = mysqli_fetch_array($lll);
        echo "success:" . $data['facility_id'] . ":" . $data['fullname'];
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
        echo "success";
    } else {
        echo "incorrect";
    }
}

// Forget Password
if (isset($_POST['forget_password'])) {
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $q = mysqli_query($conn, "select * from `default_phonegap_login` where `email`='$email'");
    $check = mysqli_num_rows($q);
    if ($check != 0) {
        echo "success";
        $data = mysqli_fetch_array($q);
        $string = "Hey," . $data['fullname'] . ", Your password is" . $data['password'];
        mail($email, "Your Password", $string);
    } else {
        echo "invalid";
    }
}
?>