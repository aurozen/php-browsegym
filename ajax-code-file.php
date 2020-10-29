<?php
  Header("Cache-control: private, no-cache");  
  Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); # Past date
  Header("Pragma: no-cache");
  
  $ActionVal=0;
  if(isset($_REQUEST['ActionVal'])) $ActionVal=$_REQUEST['ActionVal'];
  
  require './vendor/autoload.php';
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  
  if($ActionVal==0)
   {
      if(isset($_POST["TelephoneNumber"]))
      {
          $TelephoneNumber=trim($_POST["TelephoneNumber"]);
          if($TelephoneNumber!="" && is_numeric($TelephoneNumber) && strlen($TelephoneNumber)==10)
          {
              $SMSText="Hello, We can see you have fitness goals. Download the Aurozen App to acheive them https://play.google.com/store/apps/details?id=com.aurozenuserapp.user";
              	$params = array(
			    'credentials' => array(
			        
			    ),
			    'region' => 'ap-south-1', //
			    'version' => 'latest'
			);
			$sns = new \Aws\Sns\SnsClient($params);

			$args = array(
			    "MessageAttributes" => [
	                'AWS.SNS.SMS.SMSType' => [
	                    'DataType' => 'String',
	                    'StringValue' => 'Transactional'
	                ]
	            ],
	
			    "Message" => $SMSText,
			    "PhoneNumber" =>"+91".$TelephoneNumber  // Provide phone number with country code
			  );


			$result = $sns->publish($args);

			echo $result;
          }
      }
   }
   else if($ActionVal==2)
   {
     if(isset($_POST["EmailAddress"]))
      {
        $EmailAddress=$_POST["EmailAddress"]; 

		$mail = new PHPMailer;		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = '';  					 	  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = '';             // SMTP username
		$mail->Password = '';                         // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to
		$mail->From = '';
		$mail->FromName = '';
		$mail->addAddress('','');     // Add a recipient
		$mail->addReplyTo('','Information');
	
		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = 'Aurozen App';
		$mail->Body = '';
		$mail->AltBody = '';
	
		$mail->send();
      }
   }
?>
