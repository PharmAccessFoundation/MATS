<?php
function sendreqnow($inputxml, $url){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "9094",
  CURLOPT_URL => "http://196.6.103.58:9094/nibsspayplusapi/core/transactions/payment/".$url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $inputxml,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: text/xml",
    "xmlrequest: $inputxml"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "cURL Error #:" . $err;
} else {
  return $response;
}

}

$params = json_decode(file_get_contents('php://input'), true);
$inputxml = $params['inputxml'];
$url =  $params['url'];

$response = sendreqnow($inputxml, $url);
echo($response);

