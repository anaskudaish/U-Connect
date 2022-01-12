<?php
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
    return $eventId;
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
    $alleKontakte = AlleKontakte($email);
    $resultat = [];
    foreach($alleKontakte as $Kontakt){
        if(in_array($Kontakt['id'],$ArrayKontaktID)){
        }else{
            $resultat[]=$Kontakt;
        }
    }
    return $resultat;
}

function Suche_NichtTeilnehmer($email,$eventID,$searchtype,$searchText){
    $link  = connectdb();

    $sortiereKontakte  =null;
    $alleNichtTeilnehmer = nichtteilnehmerDesEvents($eventID,$email);
    if($searchtype=="vorname"||$searchtype=="nachname"){
        foreach($alleNichtTeilnehmer as $kontakt){
            // $kontakt['id'] $kontakt['vorname'] $kontakt['nachname'];
            if($kontakt[$searchtype]==$searchText){
                $sortiereKontakte[]=$kontakt;
            }
       }
        if(is_null($sortiereKontakte)){
            $kontakt['id'] = -1;
            $kontakt['vorname'] = "Keine Kontakte mit diesem Namen";
            $kontakt['nachname'] = "";
            $sortiereKontakte[] = $kontakt;
        }
    }else{
     $resultat = mysqli_query($link,"select id from tags_kontakte where tags ='$searchText'");
        if(!is_bool($resultat)) {
            while ($data = mysqli_fetch_assoc($resultat)) {
                $kontakt = getKontakt($data['id']);
                if(in_array($data['id'],array_column($alleNichtTeilnehmer,'id'))){
                $sortiereKontakte[] = $kontakt;//$data['id'] beinhaltet die ID der Kontakte mit dem Tag
                //$kontakt = getKontakt($data['id']);
                }
            }
            if(is_null($sortiereKontakte)){
                $kontakt['id'] = -1;
                $kontakt['vorname'] = "Keine Kontakte mit diesem Tag";
                $kontakt['nachname'] = "";
                $sortiereKontakte[] = $kontakt;
            }
        }
    }
    return $sortiereKontakte;
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

function getBeziehungenImEvent($eventID,$KontaktID,$isEmpty)
{
    if ($isEmpty) {
        $KontaktBeziehung['Durchschnitt'] = '-';
        $KontaktBeziehung['besteWertung'] = "-";
        $KontaktBeziehung['besteName'] = 'Keine Teilnehmer im Event';
        $KontaktBeziehung['schlechtesteWertung'] = "-";
        $KontaktBeziehung['schlechtesteName'] = 'Keine Teilnehmer im Event';
        return $KontaktBeziehung;
    }
    $link = connectdb();
    $resultat = mysqli_query($link,"SELECT kontakte_id FROM event_kontakte where event_id='$eventID'");
    $alleKontakte = [];
    if(!is_bool($resultat)) {
        while ($data = mysqli_fetch_assoc($resultat)) {
            $alleKontakte[] = $data['kontakte_id'];//$data['kontakte_id'] beinhaltet die ID der Kontakte im Event
        }
    }
        $resultat = mysqli_query($link, "SELECT * FROM beziehungen_kontakte WHERE id_beziehung='$KontaktID'");
        $alleBeziehungen = [];
        $mittel = 0.0;
        $beste = -6;
        $schlechteste = 6;
        $anzPers = 0;
        $idBest = -1;
        $idWorst = -1;
        while ($data = mysqli_fetch_assoc($resultat)) {
            if(in_array($data['id'], $alleKontakte)){
                //echo $data['id'];
            $alleBeziehungen[] = $data;
            $currRel = $data['Beziehungs_wert'];
            if ($currRel > $beste) {
                $beste = $data['Beziehungs_wert'];
                $idBest = $data['id'];
            }
            if ($currRel < $schlechteste) {
                $schlechteste = $data['Beziehungs_wert'];
                $idWorst = $data['id'];
            }
            $mittel = $mittel + $currRel;
            $anzPers++;
            }
        }
        if($anzPers> 0){
            $mittel = $mittel / $anzPers;
        }else{
            $mittel = '-';
            $KontaktBeziehung['besteWertung'] ="-";
            $KontaktBeziehung['besteName'] = "Keine Beziehung für dieses Event";
            $KontaktBeziehung['schlechtesteWertung'] = "-";
            $KontaktBeziehung['schlechtesteName'] = "Keine Beziehung für dieses Event";
        }
        $KontaktBeziehung['Durchschnitt'] = number_format((float)$mittel, 2, '.', '');

        if ($idBest != -1) {
            $KontaktBeziehung['besteWertung'] = $beste;
            $resultat = mysqli_query($link, "SELECT * FROM kontakte WHERE id='$idBest'");
            $result = mysqli_fetch_assoc($resultat);
            $KontaktBeziehung['besteName'] = $result['vorname'] . " " . $result['nachname'];
        }
        if ($idWorst != -1) {
                $KontaktBeziehung['schlechtesteWertung'] = $schlechteste;
                $resultat = mysqli_query($link, "SELECT * FROM kontakte WHERE id='$idWorst'");
                $result = mysqli_fetch_assoc($resultat);
                $KontaktBeziehung['schlechtesteName'] = $result['vorname'] . " " . $result['nachname'];
            }
            return $KontaktBeziehung;
        }

    function deleteEvent($EventID)
    {
        $link = connectdb();
        $resultat = mysqli_query($link, "DELETE FROM events WHERE id = '$EventID'");
    }

    function IstTeilnehmer($eventID,$kontaktID){
        $link = connectdb();
        $resultat = mysqli_query($link,"SELECT kontakte_id FROM event_kontakte where event_id='$eventID'");
        while ($data = mysqli_fetch_assoc($resultat)) {
            if($data['kontakte_id']==$kontaktID){
                return true;
            }
        }
        return false;
    }

    function besteTeilnehmer($eventID,$BeziehungsWertMax){
    if($BeziehungsWertMax>5)
        $BeziehungsWertMax = 5;
    if($BeziehungsWertMax<-5)
        $BeziehungsWertMax = -5;
        $link = connectdb();
        $resultat = mysqli_query($link, "SELECT * FROM beziehungen_kontakte WHERE Beziehungs_wert=5");
        $alleKontakte = [];
        //if(is_bool($resultat)) {
            while ($data = mysqli_fetch_assoc($resultat)) {
                if(istTeilnehmer($eventID,$data['id'])&&!istTeilnehmer($eventID,$data['id_beziehung']))
                $alleKontakte[] = $data;//$data['id']==Person im Event, $data['id_beziehung'] 2. Person Ziel der Beziehung
            }
       //}
        $besteBeziehungen = [];
        foreach($alleKontakte as $Beziehung){
            $KontaktBeziehung = getBeziehungenImEvent($eventID,$Beziehung['id_beziehung'],false);
            $currKon = getKontakt($Beziehung['id_beziehung']);
            if($KontaktBeziehung['Durchschnitt']>=$BeziehungsWertMax&&!in_array($currKon,$besteBeziehungen)){
            $besteBeziehungen[] = $currKon;
            }
        }
        return $besteBeziehungen;
    }

    function getMatching($besteKontakte,$andereKontakte){
    $filtered=[];
    foreach($besteKontakte as $Kontakt){
        if(in_array($Kontakt,$andereKontakte)){
            $filtered[]=$Kontakt;
        }
    }
        return $filtered;
    }


    function AlleKontakte($email){

    $link  = connectdb();

    $kontakte =null;

    $resultat=  mysqli_query($link,"select id from nutzer where email='{$email}'");
    $date = mysqli_fetch_assoc($resultat);
    $nutzer_id=$date['id'];


    $result=mysqli_query($link,"select kontakte.id,vorname,nachname from kontakte
left join geburtsdatum_kontakte gk on kontakte.id = gk.id
left join adresse_kontakte ak on kontakte.id = ak.id where nutzer_id= '{$nutzer_id}' ");
    while($daten = mysqli_fetch_assoc($result)) {
        $kontakte []= $daten;
    }

    return $kontakte;
}
