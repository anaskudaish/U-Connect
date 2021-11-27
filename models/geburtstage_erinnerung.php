<?php
use PHPMailer\PHPMailer\PHPMailer;

// Geburtstag Erinnerung
set_time_limit(3600);//24*60*60
$heute = date("m-d");
$link  = connectdb();

$resultat=  mysqli_query($link,"select id,email from nutzer");

while ($date = mysqli_fetch_assoc($resultat)) {
    $nutzer_id = $date['id'];
    $email     = $date['email'];

    $result1=mysqli_query($link,"select * from kontakte where nutzer_id= '{$nutzer_id}' ");
    while($daten1 = mysqli_fetch_assoc($result1)) {

        $kontakt_id = $daten1['id'];
        $vorname    = $daten1['vorname'];
        $nachname   = $daten1['nachname'];

        $result2    =  mysqli_query($link,"select geburtsdatum from geburtsdatum_kontakte where id= '{$kontakt_id}'");
        $daten2     =  mysqli_fetch_assoc($result2);
        if($daten2 != null){ // Geburtsdatum von Kontakt ist gegeben

            $geburtsdatum = $daten2['geburtsdatum'];


            $arr1   =   explode('-', $geburtsdatum);
            $jahr   =   $arr1[0];
            $monat  =   $arr1[1];
            $tag    =   $arr1[2];

            $arr2[]   =  $monat;
            $arr2[]   =  $tag;
            $datum    =  implode('-',$arr2);

            if($heute == $datum){// kontakt hat heute Geburtstag

                $alter= alter($tag,$monat,$jahr);
                $result3   =   mysqli_query($link,"select * from socialMedia_Kontakte where id= '{$kontakt_id}' ");
                $daten3    =   mysqli_fetch_assoc($result3);

                $instagram =   $daten3['instagram'];
                $facebook  =   $daten3['facebook'];
                $twitter   =   $daten3['twitter'];



                $result4   =   mysqli_query($link,"select telefonnummer from telefonnummer_kontakte where id= '{$kontakt_id}' ");
                $daten4   =   mysqli_fetch_assoc($result4);
                $telefonnummer   =   $daten4['telefonnummer'];

                send_geburtstage_erinnerung($email,$vorname,$nachname,$telefonnummer,$alter,$instagram,$facebook,$twitter);


            }
        }


    }

}


function alter($tag,$monat,$jahr): int
{

    $heute = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    // Geburtsdatum als Timestamp
    $geburtstag = mktime(0, 0, 0, $monat, $tag, $jahr);


    return intval(($heute - $geburtstag) / (60 * 60 * 24 * 365));


}

function send_geburtstage_erinnerung($email,$vorname,$nachname,$telefonnummer,$alter,$instagram,$facebook,$twitter){



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
    $mail->Subject = 'Geburtstag Erinnerung';

    // Mail body content
    $bodyContent = '<h1>U-Connect</h1>';

    $bodyContent .= '<div>'.$vorname .' ' .$nachname .' wird heute ' .$alter .' Jahre alt' .' <b></b>'.'<div>';
    $bodyContent .= '<p><a href="tel:'.$telefonnummer.'">'.$telefonnummer.'</a></p>';

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