
<?php
function otpmob($eename,$password,$num){
$number = $num;
$text = "Welcome to HireTruck $eename your Account Password is:$password Do not share it to anyone!!";
//post
$url="www.way2sms.com/api/v1/sendCampaign";
$message = urlencode($text);// urlencode your message
$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=MZHGF9CH38KFVI52TYHZLMFBBWS6QKQ3&secret=WP5A855IQU2I3F0V&usetype=stage&phone=$number&senderid=HRTRK&message=$message");// post data
// query parameter values must be given without squarebrackets.
 // Optional Authentication:
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
//echo $result;
}?>
