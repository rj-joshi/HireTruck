<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"/>
	<link rel="icon" type="image/ico" href="https://i.ibb.co/GQ6gw34/1544624867669.png" />
</head>
</html>
<?php
$secret = '6LfX7nQUAAAAAM5UR8XIuOEStN2S5UtE3xWOhRK9'; //our secret key generated by Google
$response = @$_POST['g-recaptcha-response']; //responce from google inn variable
$remoteip = $_SERVER['REMOTE_ADDR']; //checking ip address
$url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip"); //pass data to goole to verify im not robot!!
$result = json_decode($url,TRUE); //we get responce from google in jason connvert them in array and gat the result
//print_r($result); // print array from responce and convert JASON output to php!!
if ($result['success'] == 1) //check if result is sucess or not??
    {
				require("connection.php");
				require('Meiler/OTP.php');
				//mysqli_connect("localhost", "root", "") or die(mysql_error());
				//mysqli_select_db("hire_truck_demo") or die(mysql_error());
				if($_POST){
				    $Shipper_fname=mysqli_real_escape_string($con, htmlspecialchars($_POST['SHIPPER_fname']));
				    $Shipper_lname=mysqli_real_escape_string($con, htmlspecialchars($_POST['SHIPPER_lname']));
				    $Shipper_mail=mysqli_real_escape_string($con, htmlspecialchars($_POST['SHIPPER_mail']));
				    $Shipper_number=mysqli_real_escape_string($con, htmlspecialchars($_POST['SHIPPER_number']));
				    $Shipper_address=mysqli_real_escape_string($con, htmlspecialchars($_POST['SHIPPER_address']));
                    $sec_type =mysqli_real_escape_string($con, htmlspecialchars($_POST['secq']));
                    $sec_ans =mysqli_real_escape_string($con, htmlspecialchars($_POST['secans']));
					$Shipper_mail = strtolower($Shipper_mail);
				    $num=md5(rand(5,10));
				    $finalpass=substr($num,-8);

				    $query=$query="insert into user_s(S_fname,S_lname,S_mail,S_mnumber,S_address,S_password,S_security_question,S_security_answer,S_status,S_active) VALUES('$Shipper_fname','$Shipper_lname','$Shipper_mail','$Shipper_number','$Shipper_address','$finalpass','$sec_type','$sec_ans','0','0')";
				    $sql=mysqli_query($con,$query) or die(mysqli_error($query));
				    if($sql){
				        //echo "date inserted";
				        $eename = $Shipper_fname;
				        $eemail = $Shipper_mail;
				        $password=$finalpass;
				        otp($eemail,$eename,$password);
				        header( "refresh:3;url=login.php" );
				    }
				    else{
				        echo " error";
				    }
				    $con->close();
				}
		}else {
			echo "<div class='container'> <div class='alert alert-danger' role='alert' style='text-align:center; margin-top:25%;padding-top:2%;padding-bottom:2%' ></h4> <strong>Ohh Snap!!!</strong>&nbsp;&nbsp;it seems You are forgot The reCAPTCHA!!</h4></div> </div>";
	    header( "refresh:3;url=Shipper_registration.php" );
		}
?>
