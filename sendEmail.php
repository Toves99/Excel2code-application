<?php
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['name']) && isset($_POST['email'])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $subject=$_POST["subject"];
    $message=$_POST["message"];


    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail=new PHPMailer();

    //smtp setting
    $mail->isSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->SMTPAuth =true;
    $mail->Username="clintonekesa90@gmail.com";
    $mail->Password="Clinton@12";
    $mail->Port=465;
    $mail->SMTPSecure="ssl";

    //email settings

    $mail->isHTML(true);
    $mail->setFrom($name,$email);
    $mail->addAddress("clintonekesa90@gmail.com");
    $mail->Subject=("$email ($subject)");
    $mail->Body=$message;

    if($mail->send()){
        $status="success";
        $response="Email is sent!";
    }
    else{
        $status="Failed";
        $response="Something went wrong: <br>" .$mail->ErrorInfo;
    }

    exit(json_encode(array("status"=> $status, "response"=>$response)));
}
?>