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

    $resultat=  mysqli_query($link,"select * from event_kontakte where event_id='{$eventID}'");
        $ArrayKontaktDaten = [];
        while($date = mysqli_fetch_assoc($resultat)) {
            $KontaktID = $date['kontakte_id'];
            $result =  mysqli_query($link,"select id,vorname,nachname from kontakte where id='{$KontaktID}'");
            $kontaktDaten = mysqli_fetch_array($result);
            $ArrayKontaktDaten[]= $kontaktDaten;
            mysqli_free_result($result);
        }
        return $ArrayKontaktDaten;
}

function nichtteilnehmerDesEvents($eventID,$email){
    $Kontakte = teilnehmerDesEvents($eventID);
    $ArrayKontaktID = [];
    foreach($Kontakte as $test){
        $ArrayKontaktID[] = $test[0];
    }
    $alleKontakte = kontakte($email);
    $resultat = [];
    foreach($alleKontakte as $Kontakt){
        if(in_array($Kontakt['id'],$ArrayKontaktID)){
        }else{
            $resultat[]=$Kontakt;
        }
    }
    return $resultat;
}

function teilnehmerHinzufuegen($eventID,$KontaktID){
    $link = connectdb();
    $resultat = mysqli_query($link,"INSERT into event_kontakte (event_id, kontakte_id) VALUES ('{$eventID}','{$KontaktID}')");
}

function teilnehmerEntfernen($eventID,$TeilnehmerID){
    $link = connectdb();
    $resultat = mysqli_query($link,"DELETE FROM event_kontakte WHERE kontakte_id ='$TeilnehmerID'AND event_id = '$eventID'");
}

function getKontakt($kontaktID){
    $link = connectdb();
    $resultat = mysqli_query($link,"SELECT vorname,nachname,id FROM kontakte WHERE id='$kontaktID'");
    $result = mysqli_fetch_assoc($resultat);
    return $result;
}

function getBeziehungenImEvent($eventID,$KontaktID,$isEmpty){
    if($isEmpty){
        $KontaktBeziehung['Durchschnitt'] = '-';
        $KontaktBeziehung['besteWertung'] = "-";
        $KontaktBeziehung['besteName'] = 'Keine Teilnehmer im Event';
        $KontaktBeziehung['schlechtesteWertung'] = "-";
        $KontaktBeziehung['schlechtesteName'] = 'Keine Teilnehmer im Event';
        return $KontaktBeziehung;
    }
    $link = connectdb();
    $resultat = mysqli_query($link,"SELECT * FROM beziehungen_kontakte WHERE id_beziehung='$KontaktID'");
    $alleBeziehungen = [];
    $mittel = 0.0;
    $beste = -6;
    $schlechteste = 6;
    $anzPers = 0;
    $idBest = -1;
    $idWorst = -1;
    while($data = mysqli_fetch_assoc($resultat)) {
        $alleBeziehungen[] = $data;
        $currRel = $data['Beziehungs_wert'];
        if($currRel>$beste){
            $beste = $data['Beziehungs_wert'];
            $idBest = $data['id'];
        }
        if($currRel<$schlechteste){
            $schlechteste = $data['Beziehungs_wert'];
            $idWorst = $data['id'];
        }
        $mittel = $mittel+$currRel;
        $anzPers++;
    }
    $mittel = $mittel/$anzPers;
    $KontaktBeziehung['Durchschnitt'] = $mittel;

    if($idBest!=-1){
    $KontaktBeziehung['besteWertung'] = $beste;
    $resultat = mysqli_query($link,"SELECT * FROM kontakte WHERE id='$idBest'");
    $result = mysqli_fetch_assoc($resultat);
    $KontaktBeziehung['besteName'] = $result['vorname']." ".$result['nachname'];
    }else{
        $KontaktBeziehung['besteWertung'] = "-";
        $KontaktBeziehung['besteName'] = "keine Beziehung gefunden";
    }
    if($idWorst!=-1){
    $KontaktBeziehung['schlechtesteWertung'] = $schlechteste;
    $resultat = mysqli_query($link,"SELECT * FROM kontakte WHERE id='$idWorst'");
    $result = mysqli_fetch_assoc($resultat);
    $KontaktBeziehung['schlechtesteName'] = $result['vorname']." ".$result['nachname'];
    }else{
        $KontaktBeziehung['schlechtesteWertung'] = "-";
        $KontaktBeziehung['schlechtesteName'] = "keine Beziehung gefunden";
    }
    return $KontaktBeziehung;
}
