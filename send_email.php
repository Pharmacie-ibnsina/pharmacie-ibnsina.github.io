<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings

    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = '12876f8a25536e';
    $mail->Password = '18025edad3523e';
    //Recipients

    $mail->setFrom($_POST['email'], $_POST['nom']);
    $mail->addAddress('pharmacieibnsina01@gmail.com', 'Admin');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $_POST['nom'].'  '.$_POST['prenom'];
    $mail->Body    = "hello there ".$_POST['nom'].' '.$_POST['prenom']."<br/>"."email : ".$_POST['email']."<br>".$_POST['message'];

    $mail->send();
    $data = array("success" => "thanks we will contact you soon");

    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
} catch (Exception $e) {
    $data = array("error" => "some thing was wrong please try again" );

    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
}