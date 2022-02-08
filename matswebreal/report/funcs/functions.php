<?php
ini_set('max_execution_time', 100);

function sendMail($to, $subject, $message) {
    $headers = 'From: report@matslagos.com.ng' . "\r\n" .
            'Reply-To: report@matslagos.com.ng' . "\r\n" .
            'MIME-Version: 1.0' . '\r\n' .
            'Content-type:text/html;charset=UTF-8' . '\r\n' .
            'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}

function getResp($typ) {
    $type = (int) $typ;
    if ($type == 1) {
        return 'Self';
    } elseif ($type == 2) {
        return 'Adult Dependent';
    } elseif ($type == 3) {
        return 'Infant';
    } else {
        return 'Nil';
    }
}

function removeSend($message) {
    $mess1 = str_replace('(', '', $message);
    $mess2 = str_replace(')', '', $mess1);
    $mess3 = str_replace('&', '', $mess2);
    $mess4 = str_replace('-', '', $mess3);
    $mess5 = str_replace('Specialist', '', $mess4);
    return $mess5;
}
