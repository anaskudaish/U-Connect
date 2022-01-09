<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function nutzer_existiert($email): bool
{
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

function neues_temporaerPasswort($email,$hashpasswort){
    $link = connectdb();

    $time= strtotime("1 hour");
    $ablauf_zeit= date("Y-m-d-H-i",$time);


    $result = mysqli_query($link,"select id,passwort_zurueck from nutzer where email='{$email}'");
    $date = mysqli_fetch_assoc($result);


    $passwort_zurueck=$date['passwort_zurueck'];
    $id=$date['id'];

    if($passwort_zurueck==0){
        mysqli_query($link,"update  nutzer set passwort_zurueck=1 where id ='{$id}'");

    }
    mysqli_query($link,"replace into temporaeres_passwort (id,passwort, ablauf_zeit) VALUES ('$id','$hashpasswort','$ablauf_zeit') ");
    mysqli_free_result($result);
    mysqli_close($link);

}

//send das temporäre Passwort
function send_temporaerPasswort($email){

    $resultat= true;

    $passwort = uniqid(); //Random String
    $hashpasswort=  hashpasswort($passwort);
    neues_temporaerPasswort($email,$hashpasswort);
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
    $mail->Subject = 'Neues Passwort fuer Ihr U-Connect';

    // Mail body content
    $bodyContent = '<h1>U-Connect</h1>';
    $bodyContent .= '<div>Sie haben aufgefordert, Ihr Passwort zurueckzusetzen. </div>';
    $bodyContent .='Ihr neues Passwort ist : <b>'.$passwort .'</b> .';
    $bodyContent .= '<p >Gesandt von <b><a href="http://localhost:9000">U-Connect</a></b></p>';
    $mail->Body    = $bodyContent;

    if(!$mail->send()) {
        $resultat= false;
    }

    return $resultat;

}
