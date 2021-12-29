<?php
require_once('../models/kontaktenzeigen.php');

function events($email){

    $link  = connectdb();

    $events =null;

    $resultat=  mysqli_query($link,"select id from nutzer where email='{$email}'");
    $date = mysqli_fetch_assoc($resultat);
    $nutzer_id=$date['id'];

    $result=mysqli_query($link,"select id,EventName from events where nutzer_id= '{$nutzer_id}' ");
    while($daten = mysqli_fetch_assoc($result)) {

        $events []= $daten;

    }

    return $events;
}

function createEvent($email,$eventname,$date,$time,$contacts)
{
    $link = connectdb();
    $email = mysqli_real_escape_string($link, $email);
    $eventname = mysqli_real_escape_string($link, $eventname);
    $date = mysqli_real_escape_string($link, $date);
    $time = mysqli_real_escape_string($link, $time);
    $id = mysqli_fetch_assoc(mysqli_query($link, "select id from nutzer where email='{$email}'"))['id'];

    $r1 = mysqli_query($link, "INSERT INTO events(nutzer_id, eventname, Datum, Uhrzeit)  VALUES('$id','$eventname','$date','$time')");
    $r2 = 0;
    if ($r1) {
        $eventId = mysqli_insert_id($link);
        if (!empty($contacts)) {
            $tmp = explode(",", $contacts);
            foreach ($tmp as $t)
                $r2 += mysqli_query($link, "insert into event_kontakte VALUES ('$eventId','$t')");
        }
    }
    return (bool)$r2;
}

    function ausgewaehtlesevent($eventID){
    $link  = connectdb();
    $resultat=  mysqli_query($link,"select * from events where id='{$eventID}'");
    $result = mysqli_fetch_assoc($resultat);
    return $result;
}



function updateEvent($email,$eventId,$eventName,$date,$time){
    $link = connectdb();
    $email = mysqli_real_escape_string($link,$email);
    $eventId = mysqli_real_escape_string($link,$eventId);
    $eventName = mysqli_real_escape_string($link,$eventName);
    $date = mysqli_real_escape_string($link,$date);

    mysqli_query($link,"UPDATE events SET eventname='$eventName',Datum='$date',Uhrzeit='$time' WHERE id='$eventId'");

    //TODO Contacts
}


function teilnehmerDesEvents($eventID){

    $link  = connectdb();

    $events =null;

    $resultat=  mysqli_query($link,"select * from event_kontakte where event_id='{$eventID}'");
    $date = mysqli_fetch_assoc($resultat);
    if(!empty($date)){
        $ArrayKontaktDaten = [];
        $counter = 0;
        foreach($date as $KontaktID){
            $result =  mysqli_query($link,"select id,vorname,nachname from kontakte where id='{$KontaktID}'");
            $kontaktDaten = mysqli_fetch_array($result);
            $ArrayKontaktDaten[$counter]= $kontaktDaten;
            mysqli_free_result($result);
            $counter++;
        }
        return $ArrayKontaktDaten;
    }
    return [];
}

function nichtteilnehmerDesEvents($eventID,$email){
    $Kontakte = teilnehmerDesEvents($eventID);
    $alleKontakte = kontakte($email);
    $resultat = [];
    $i = 0;
    foreach($alleKontakte as $Kontakt){
        if(!in_array($Kontakt,$Kontakte))
        {
            $resultat[$i]=$Kontakt;
            next($Kontakte);
        }
    }
    return $resultat;
}
