<?php

$ndate = date("2018-08-01 02:00:00");
$ldate = date("2018-07-01 02:00:00", strtotime("-1 month"));
$subject = "Monthly Report For " . ucfirst(date('F Y', strtotime("-1 month")));

echo $ndate.'<br>'.$ldate.'<br>'.$subject;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 
include 'funcs/functions.php';

$to = "bustonshows@yahoo.com";
$subject = 'Hi2 From Busayo';
//$message = '31 . Iduna Specialist Hospital: 98; 4  ';
//$message = '29 . Hillstar Hospital: 458; 4 30 . Holy Trinity Hospital: 110;';
//$message = 'Dear MATS Administrator, MONTH: JUNE TOTAL SCREENED ALL HOSPITALS: 8113 NUMBER OF PRESUMPTIVE ALL HOSPITALS: 283 1 . Adefemi Hospital: 7; 0 2 . Ademola Hospital: 196; 5 3 . Adeoti Hospital: 112; 1 4 . Agape Medical Centre: 113; 2 5 . Ahmadiyyah Muslim Hospital: 424; 9 6 . Akanbi Hospital: 435; 11 7 . Al-Sadiq Memorial Clinic: 93; 0 8 . Ancel Hospital: 39; 5 9 . Anthony Cardinal Okojie Maternity Centre Ikoga Badagry: 65; 1 10 . Anthony Cardinal Okojie Medical Centre New Oko-Oba: 141; 5 11 . Bissalam Hospital Egbe: 48; 16 12 . Christ Foundation Hospital: 217; 5 13 . Christ the Healer Clinic and Maternity: 10; 0 14 . Church of God Mission: 20; 3 15 . Community Health Development Initiative: 1; 1 16 . Community Health Project Amukoko (St. Theresa): 62; 39 17 . Crest Hospital: 177; 11 18 . Deseret International Hospital: 159; 2 19 . EHJ (Eucharistic Heart Of Jesus) Catholic Hospital: 17; 0 20 . El-Dunamis Medical Centre: 330; 28 21 . Emmanuel Padua Maternal Home: 73; 1 22 . Everlife Hospital: 282; 5 23 . Faleti Medical Centre: 39; 6 24 . Folabi Medical Centre: 85; 1 25 . G & S Medical and Dental Hospital : 80; 6 26 . G & T Nursing and Maternity: 48; 2 27 . Goodness Medical Centre: 87; 1 33 . Ladi-Lak Hospital: 99; 11 34 . Life Fount Medical Centre: 99; 4 35 . Light Hospital and Maternity Home: 50; 7 36 . Longe Medical Centre: 170; 0 37 . Lota Hospital: 419; 5 38 . Mayfair Medical Centre: 78; 2 39 . Mobonike Hospital: 400; 2 40 . Mucas Hospital: 67; 4 41 . Munidola Clinic: 3; 3 42 . Muskat Hospital: 4; 0 43 . Ogunmodede Memorial Hospital: 166; 4 44 . OnyemsB Hospital: 126; 4 45 . Promise Medical Centre Limited: 945; 1 46 . Renue Clinic: 88; 1 47 . Sacred Heart Hospital: 77; 0 48 . Solad Medical Centre: 1; 1 49 . St. Catherine of Siena Medical Centre: 556; 30 50 . St. John the Evangelical Parish Clinic: 32; 0 51 . St. Sabina Hospital: 139; 5 52 . Syban Hospital: 3; 0 53 . Tolu Medical Centre 2 (Ojo Road): 1; 0 54 . Unita Hospital: 24; 1 Thank You, MATS LAGOS ADMIN';
$message = 'Dear MATS Administrator, MONTH: JUNE TOTAL SCREENED ALL HOSPITALS: 8113 NUMBER OF PRESUMPTIVE ALL HOSPITALS: 283 1 . Adefemi Hospital: 7; 0 2 . Ademola Hospital: 196; 5 3 . Adeoti Hospital: 112; 1 4 . Agape Medical Centre: 113; 2 5 . Ahmadiyyah Muslim Hospital: 424; 9 6 . Akanbi Hospital: 435; 11 7 . Al-Sadiq Memorial Clinic: 93; 0 8 . Ancel Hospital: 39; 5 9 . Anthony Cardinal Okojie Maternity Centre Ikoga Badagry: 65; 1 10 . Anthony Cardinal Okojie Medical Centre New Oko-Oba: 141; 5 11 . Bissalam Hospital Egbe: 48; 16 12 . Christ Foundation Hospital: 217; 5 13 . Christ the Healer Clinic and Maternity: 10; 0 14 . Church of God Mission: 20; 3 15 . Community Health Development Initiative: 1; 1 16 . Community Health Project Amukoko (St. Theresa): 62; 39 17 . Crest Hospital: 177; 11 18 . Deseret International Hospital: 159; 2 19 . EHJ (Eucharistic Heart Of Jesus) Catholic Hospital: 17; 0 20 . El-Dunamis Medical Centre: 330; 28 21 . Emmanuel Padua Maternal Home: 73; 1 22 . Everlife Hospital: 282; 5 23 . Faleti Medical Centre: 39; 6 24 . Folabi Medical Centre: 85; 1 25 . G & S Medical and Dental Hospital : 80; 6 26 . G & T Nursing and Maternity: 48; 2 27 . Goodness Medical Centre: 87; 1 28 . Gowon Estate Clinic: 450; 2 29 . Hillstar Hospital: 458; 4 30 . Holy Trinity Hospital: 110; 4 31 . Iduna Specialist Hospital: 98; 4 32 . Ilogbo Central Hospital: 90; 18 33 . Ladi-Lak Hospital: 99; 11 34 . Life Fount Medical Centre: 99; 4 35 . Light Hospital and Maternity Home: 50; 7 36 . Longe Medical Centre: 170; 0 37 . Lota Hospital: 419; 5 38 . Mayfair Medical Centre: 78; 2 39 . Mobonike Hospital: 400; 2 40 . Mucas Hospital: 67; 4 41 . Munidola Clinic: 3; 3 42 . Muskat Hospital: 4; 0 43 . Ogunmodede Memorial Hospital: 166; 4 44 . OnyemsB Hospital: 126; 4 45 . Promise Medical Centre Limited: 945; 1 46 . Renue Clinic: 88; 1 47 . Sacred Heart Hospital: 77; 0 48 . Solad Medical Centre: 1; 1 49 . St. Catherine of Siena Medical Centre: 556; 30 50 . St. John the Evangelical Parish Clinic: 32; 0 51 . St. Sabina Hospital: 139; 5 52 . Syban Hospital: 3; 0 53 . Tolu Medical Centre 2 (Ojo Road): 1; 0 54 . Unita Hospital: 24; 1 Thank You, MATS LAGOS ADMIN';

$mess1 = str_replace('(', '', $message);   
$mess2 = str_replace(')', '', $mess1);       
$mess3 = str_replace('&', '', $mess2); 
$mess4 = str_replace('-', '', $mess3);
$mess5 = str_replace('Specialist', '', $mess4);
sendMail($to, $subject, $mess5);
echo $mess5;
var_dump($mess5);
'El-Dunamis Medical Centre: 330; 28 21 . Emmanuel Padua Maternal Home: 73; 1 22 . Everlife Hospital: 282; 5 23 . Faleti Medical Centre: 39; 6 24 . Folabi Medical Centre: 85; 1 25 . G & S Medical and Dental Hospital : 80; 6 26 . G & T Nursing and Maternity: 48; 2 27 . Goodness Medical Centre: 87; 1 28 . Gowon Estate Clinic: 450; 2 29 . Hillstar Hospital: 458; 4 30 . Holy Trinity Hospital: 110; 4 31 . Iduna Specialist Hospital: 98; 4 32 . Ilogbo Central Hospital: 90; 18 33 . Ladi-Lak Hospital: 99; 11 34 . Life Fount Medical Centre: 99; 4 35 . Light Hospital and Maternity Home: 50; 7 ';
 * 
 */