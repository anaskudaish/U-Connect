<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function is_email_ok($email,$neue_email):int{
    $link = connectdb();
    // resultat = 0 Diese E-Mail existiert bereits
    // resultat = 1 Diese E-Mail existiert nicht bereits
    // resultat = 2 die von Ihnen eingegebene E-Mail entspricht Ihre aktuelle E-Mail

    $resultat=1;
    $stmt1=  mysqli_stmt_init($link);
    mysqli_stmt_prepare($stmt1, "select id from nutzer where email=(?)");
    mysqli_stmt_bind_param($stmt1, 's', $email);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    $daten1= mysqli_fetch_assoc($result1);
    mysqli_free_result($result1);

    $stmt2=  mysqli_stmt_init($link);
    mysqli_stmt_prepare($stmt2, "select id from nutzer where email=(?)");
    mysqli_stmt_bind_param($stmt2, 's', $neue_email);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $daten2= mysqli_fetch_assoc($result2);
    mysqli_free_result($result2);

    if($daten1['id']==$daten2['id']){
        $resultat=2;
    }
    else{// id != id D.H ist email eines anderen nutzer
        $stmt3=  mysqli_stmt_init($link);
        mysqli_stmt_prepare($stmt3, "select id from nutzer where email=(?)");
        mysqli_stmt_bind_param($stmt3, 's', $neue_email);
        mysqli_stmt_execute($stmt3);
        $result3 = mysqli_stmt_get_result($stmt3);
        $daten3= mysqli_fetch_assoc($result3);
        mysqli_free_result($result3);

        if($daten3 != null){
            $resultat=0;

        }
    }


    mysqli_close($link);
    return $resultat;
}


function neue_email($email,$neue_email){
    $link = connectdb();
     mysqli_query($link, "update nutzer set  email ='{$neue_email}'  where email='{$email}' ");

}
function neues_passwort($email,$hashpasswort){
    $link = connectdb();


    mysqli_query($link, "update nutzer set  passwort ='{$hashpasswort}'  where email='{$email}' ");


}

function passwort_ok($email, $hashpasswort){
    $link = connectdb();

    $resultat=false;

    $stmt=  mysqli_stmt_init($link);
    mysqli_stmt_prepare($stmt, "select id from nutzer where email=(?) and passwort=(?)");
    mysqli_stmt_bind_param($stmt, 'ss', $email,$hashpasswort);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $dataemailANDpass= mysqli_fetch_assoc($result);

    // login_ok
    if ($dataemailANDpass != null) {

        $resultat = true;
    }
    //ansonsten passwort_not_ok

    mysqli_free_result($result);
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
