<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "", "auction");
    if($link){
        if( isset($_SESSION["email"]))
        {
            $query = "SELECT `id` FROM `temp-data` WHERE `email` ='".$_SESSION["email"]."'";
       
            $result = mysqli_query($link, $query);
          
            $row = mysqli_fetch_array($result);
            $to = $_SESSION["email"];
            $en_to =md5($_SESSION["email"]);
            
            $body = "http://127.0.0.1:88/Gec-Auction/verification/index.php?vs=".$en_to.$row["id"]."";

            $subject = "Verify your account";    
            send($to, $subject, $body);
        }
        else{
            echo "Some problem with the link.";
        }
    }
    else{
        echo "Some problem with the link.";
    }

    

/*__________________________________________________________________________________
								
								THIS DOESN'T WORK
__________________________________________________________________________________*/

	$message = "";

	function send($to, $subject, $body) {

		$uname = "";
		$passw = "";

		require_once('mail_class/class.phpmailer.php');
		//include("mail_class/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

		$mail             = new PHPMailer();

		$body             = $body;

		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "smtp.gmail.com"; // SMTP server
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		                                           // 1 = errors and messages
		                                           // 2 = messages only

		$mail->SMTPOptions = array (
			'tls' => array (
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);


		$mail->SMTPAuth   = true; 
		$mail->SMTPSecure = 'tls';                 // enable SMTP authentication
		$mail->Host       = "smtp.gmail.com"; // sets the SMTP server
		$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
		$mail->Username   = $uname; // SMTP account username
		$mail->Password   = $passw;        // SMTP account password

		$mail->SetFrom('nsp4898@gmail.com', 'Neel');

		$mail->AddReplyTo("nsp4898@gmail.com","Neel Patel");

		$mail->Subject    = $subject;

		//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->MsgHTML($body);

		$address = $to;
		$mail->AddAddress($address, "By Neel");

		if(!$mail->Send()) {
			return 0;
		} else {
		return 1;
		}
			 
		//$mail->AddAttachment("images/phpmailer.gif");      // attachment
		//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

		
		
	}	

?>

Verification email has been sent to your email. Please verify.