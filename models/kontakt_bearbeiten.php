<?php


function kontakt_bearbeiten(): bool {

    $resultat=true;
    $email_nutzer = $_SESSION['email'];
    $link = connectdb();
    $result = mysqli_query($link, "select id from nutzer where email='{$email_nutzer}'");
    $date = mysqli_fetch_assoc($result);
    $nutzer_id = (int)$date['id'];
    //$email_nutzer = mysqli_real_escape_string($link,$_SESSION['email']);
    $vorname = mysqli_real_escape_string($link,$_POST['vorname']);
    $nachname = mysqli_real_escape_string($link,$_POST['nachname']);

    $erinnerungsinterval = mysqli_real_escape_string($link,$_POST['erinnerungsinterval']);
    $telefonnummer = mysqli_real_escape_string($link,$_POST['telefonnummer']);
    $instagram = mysqli_real_escape_string($link,$_POST['instagram']);
    $facebook = mysqli_real_escape_string($link,$_POST['facebook']);
    $twitter = mysqli_real_escape_string($link,$_POST['twitter']);
    $strasse = mysqli_real_escape_string($link,$_POST['strasse']);
    $plz = mysqli_real_escape_string($link,$_POST['plz']);
    $stadt = mysqli_real_escape_string($link,$_POST['stadt']);
    $land = mysqli_real_escape_string($link,$_POST['land']);
    $textfeld = mysqli_real_escape_string($link,$_POST['textfeld']);
    $geburtsdatum = mysqli_real_escape_string($link,$_POST['geburtsdatum']);
    $tags = mysqli_real_escape_string($link,$_POST['tags']);


    $result = mysqli_query($link, "select bildname from kontakte where id=$_POST[id_kontakt]");
    $date = mysqli_fetch_assoc($result);
    $curPic = (string)$date['bildname'];

    $bildname = "unknown.jpg";
    if (!$_FILES['bild']['error']){

        if($curPic != "unknown.jpg")
            unlink("img\\" . $curPic);

        $bildname = $_FILES['bild']['name'];
        $bildtmp = $_FILES['bild']['tmp_name'];

        $bildExt = explode('.', $bildname);
        $bildActualExt = strtolower(end($bildExt));

        $bildnameNew = uniqid('', true) . "." . $bildActualExt;
        $bildspeichern =  "img\\". $bildnameNew;

        move_uploaded_file($bildtmp, $bildspeichern);
        $bildname = $bildnameNew;

    }

    mysqli_begin_transaction($link);
    try {


        mysqli_query($link, "update kontakte set vorname='$vorname', nachname='$nachname', erinnerungsinterval='$erinnerungsinterval', bildname='$bildname' where id=$_POST[id_kontakt]");

        mysqli_query($link,"update telefonnummer_kontakte set telefonnummer='$telefonnummer' where id=$_POST[id_kontakt]");

        if(!empty($instagram . $facebook . $twitter))
            mysqli_query($link,"replace into socialmedia_kontakte VALUES($_POST[id_kontakt],'$instagram','$facebook','$twitter')");

        if(!empty($strasse . $plz . $stadt .$land))
        mysqli_query($link,"replace into adresse_kontakte VALUES($_POST[id_kontakt],'$strasse','$plz','$stadt','$land')");

        if(!empty($textfeld))
            mysqli_query($link,"replace into text_kontakte VALUES($_POST[id_kontakt],'$textfeld')");

        if(!empty($geburtsdatum))
            mysqli_query($link,"replace into geburtsdatum_kontakte VALUES($_POST[id_kontakt],'$geburtsdatum')");

        if($tags){
            mysqli_query($link,"delete from tags_kontakte where id=$_POST[id_kontakt]");
            $tmp = explode(",",$tags);
            foreach ($tmp as $t)
                mysqli_query($link, "insert into tags_kontakte VALUES ('$_POST[id_kontakt]','$t')");

        }



        mysqli_commit($link);
    }
    catch (mysqli_sql_exception $exception) {
        $resultat=false;
        mysqli_rollback($link);

    }
    mysqli_free_result($result);
    mysqli_close($link);
    return $resultat;
}
