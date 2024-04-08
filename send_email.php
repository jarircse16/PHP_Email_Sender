<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

session_start();

if(isset($_POST['send'])){

    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $count = $_POST['count'];

   
    //Load composer's autoloader
    for( $i=0; $i< $count; $i++) {
    $mail = new PHPMailer(true);                            
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'abdurrrouf4530@gmail.com';     
        $mail->Password = 'xahf xjck ptsn ssqz';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        //Send Email
        $mail->setFrom('abdurrrouf4530@gmail.com');
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo('abdurrrouf4530@gmail.com');
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
   
       $_SESSION['result'] = 'Message has been sent';
       echo "$i emails are sent";
	   $_SESSION['status'] = 'ok';
    } catch (Exception $e) {
	   $_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	   $_SESSION['status'] = 'error';
    }
}	
	header("location: index.php");

}


