<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function nutzer_existiert($email){
    $link = connectdb();
    $resultat=false;
    $stmt=  mysqli_stmt_init($link);
    mysqli_stmt_prepare($stmt, "select id from nutzer where email=(?)");
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $id = mysqli_fetch_assoc($result);

    if($id!= null){
        $resultat=true;
    }
    mysqli_free_result($result);
    mysqli_close($link);
    return $resultat;
}

function registrierung($email,$hashpasswort){
    $link = connectdb();

    $resultat=true;
    $stmt=  mysqli_stmt_init($link);
    mysqli_stmt_prepare($stmt, "insert into nutzer (email, passwort) VALUES (?,?)");
    mysqli_stmt_bind_param($stmt, 'ss', $email,$hashpasswort);
    $result=  mysqli_stmt_execute($stmt);

    if($result == false){
        $resultat = false;
    }



    mysqli_close($link);
    return $resultat;

}


 function code_senden($email){


    $code = uniqid(); //Random String
    $mail = new PHPMailer;

    $mail->isSMTP();                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;               // Enable SMTP authentication
    $mail->Username = 'uconnect22@gmail.com';   // SMTP username
    $mail->Password = 'iwmgehnxatcmwxxe';   // SMTP password
    $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                    // TCP port to connect to

    // Sender info passwort : qayxswedc123
    $mail->setFrom('uconnect22@gmail.com', 'U-Connect');

    // Add a recipient
    $mail->addAddress($email);

    // Set email format to HTML
    $mail->isHTML(true);

    // Mail subject
    $mail->Subject = ' Ihr U-Connect Bestaetigungscode';

    // Mail body content
    $bodyContent = '<h1>U-Connect</h1>';
    $bodyContent .= 'Ihr Code ist : <b>' . $code . '</b> .';
    $bodyContent .= '<p >Gesandt von <b><a href="http://localhost:9000">U-Connect</a></b></p>';
    $mail->Body = $bodyContent;

     if(!$mail->send()){
         $code=null;
     }
     return $code;
}


