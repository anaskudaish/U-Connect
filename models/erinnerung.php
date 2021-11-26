<?php

use PHPMailer\PHPMailer\PHPMailer;

set_time_limit(3600);//24*60*60

$heute = date("Y-m-d");

    $link  = connectdb();

    $resultat=  mysqli_query($link,"select id,email from nutzer");

    while ($date = mysqli_fetch_assoc($resultat)){
        $nutzer_id=$date['id'];
        $email=$date['email'];


        $result=mysqli_query($link,"select * from kontakte where nutzer_id= '{$nutzer_id}' ");
        while($daten = mysqli_fetch_assoc($result)){

            $kontakt_id   =          $daten['id'];
            $vorname      =          $daten['vorname'];
            $nachname     =          $daten['nachname'];
            $erinnerungsinterval =   $daten['erinnerungsinterval'];
            $naechsteerinnerung  =   $daten['naechsteerinnerung'];



            if($naechsteerinnerung ==  $heute){



                $result1   =   mysqli_query($link,"select * from socialMedia_Kontakte where id= '{$kontakt_id}' ");
                $daten1    =   mysqli_fetch_assoc($result1);
                mysqli_free_result($result1);
                $instagram =   $daten1['instagram'];
                $facebook  =   $daten1['facebook'];
                $twitter   =   $daten1['twitter'];



                $result2   =   mysqli_query($link,"select telefonnummer from telefonnummer_kontakte where id= '{$kontakt_id}' ");
                $daten2    =   mysqli_fetch_assoc($result2);
                mysqli_free_result($result2);
                $telefonnummer   =   $daten2['telefonnummer'];

                send_erinnerung($email,$vorname,$nachname,$telefonnummer,$instagram,$facebook,$twitter);

                $time= strtotime($erinnerungsinterval);
                $naechsteerinnerung_neue= date("Y-m-d",$time);

                mysqli_query($link, "update kontakte set  naechsteerinnerung ='{$naechsteerinnerung_neue}' 
                         where id='{$kontakt_id}' and nutzer_id='{$nutzer_id}'");
            }

        }
        mysqli_free_result($result);
    }

    mysqli_free_result($resultat);
    mysqli_close($link);




function send_erinnerung($email,$vorname,$nachname,$telefonnummer,$instagram,$facebook,$twitter){



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
    $mail->Subject = 'Erinnerung';

    // Mail body content
    $bodyContent = '<h1>U-Connect</h1>';
    $bodyContent .= '<div>Melde dich mal bei ' .'<b>' .$vorname .' ' .$nachname .'</b>'. '<div>';
    $bodyContent .= '<p>Telefonnummer:<a href="tel:'.'  '.$telefonnummer.'">' .$telefonnummer.'</a></p>';

    if(!empty($Instragram)) {
        $bodyContent .= '<p><a href="'.$instagram.'">Instragram</a></p>';
    }
    if(!empty($facebook)) {
        $bodyContent .= '<p><a href="'.$facebook.'">Facebook</a></p>';
    }
    if(!empty($twitter)) {
        $bodyContent .= '<p><a href="'. $twitter.'">Twitter</a></p>';
    }


    $bodyContent .= '<p >Gesandt von <b><a href="http://localhost:9090">U-Connect</a></b></p>';
    $mail->Body    = $bodyContent;

    $mail->send();

}