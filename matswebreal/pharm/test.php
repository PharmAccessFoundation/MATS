<?php

include('auth_new.php');

$message1 = "<strong>Hello Busayo</strong>,</p><p>Presumptive case has just been detected at your facility and it has been referred</p>";
 $subject = "MATS Presumptive Alert Test";
 $rfemail = "bustonshows@yahoo.com";

 echo sendMailReferral($rfemail, $subject, $message1);

?> 
