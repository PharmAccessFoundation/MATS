<?php

include 'funcs/functions.php';

$conn = mysqli_connect("10.128.62.33", "mats", "matsremote", "mats_main") or die("could not connect server");

//$conn = mysqli_connect("localhost", "matslago_mats", "busayo123$", "matslago_mats") or die("could not connect server");

$q = mysqli_query($conn, "select * from `default_facility_details` where id < 5");


while ($d = mysqli_fetch_array($q)) {
    $last = $d['last_report'];
    $fac_id = $d['id'];
    $name = $d['name'];
    $to = $d['code'];
    //echo $last . ' ' . $fac_id . '<br>';
    $qq = mysqli_query($conn, "select count(*) as co from `default_phonegap_surveys` where facility_id = $fac_id and date_uploaded > '$last'");
    $data=mysqli_fetch_array($qq);
    $count = $data['co'];
    
    $qq1 = mysqli_query($conn, "select count(*) as county from default_phonegap_surveys s join default_facility_details f on f.id = s.facility_id where s.facility_id = $fac_id and s.date_uploaded > '$last' and s.status = 'yes'");
    $data1=mysqli_fetch_array($qq1);
    $count1 = $data1['county'];
    
    $count2 = $count - $count1;
    
    $qq2 = mysqli_query($conn, "select * from default_phonegap_surveys s join default_facility_details f on f.id = s.facility_id where s.facility_id = $fac_id and s.date_uploaded > '$last' and s.status = 'yes'");
   $table = "<table>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Respondent</th>
                    <th>Date Screened</th>
                </tr>";
   $cnt = 1;
    while($data2=mysqli_fetch_array($qq2)){
        $table .= "<tr>
                    <td>$cnt</td>
                    <td>".ucwords($data2['firstname'])."</td>
                    <td>".$data2['mobile']."</td>
                    <td>".getResp($data2['respondent'])."</td>
                    <td>".date('F jS, Y', strtotime($data2['date_uploaded']))."</td>
                    </tr>
";
        $cnt++;
    }
    $table .= "</table>";
        //echo '<br><br>';  continue;
    
    $lastdate = date('F jS, Y', strtotime($last));
    $today = date('F jS, Y');
    
    $message = "<br>
        <html>
        <head>
        <title>MATS Report Update</title>
        </head>
        <body>
        
        Hello $name, <br><br>
        
        Below is the report update from MATS from $lastdate to $today. <br><br>
        
        Total Screen Count: $count<br>
        Suspected Screen Count: $count1<br>
        Negative Screen Count: $count2 <br><br>
        
        Suspected Screens Details<br><br>
        
        $table<br><br>

        Thanks,<br>
        MATS Lagos.
        
        </body>
        </html>
             ";
   $subject = "MATS Survery Report ($lastdate to $today)";
   
   echo $to.'<br>'.$subject.'<br>'.$message.'<br><br>';
   //sendMail($to, $subject, $message)
}

