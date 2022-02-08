<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Start<br>";

require_once("../pharm/auth_new.php");
$email = "bustonshows@gmail.com";
$string = 'Mobile Function Test';
sendMailSMTP($email, "Your Password", $string);

echo '<br/>';
echo $_SERVER["DOCUMENT_ROOT"];