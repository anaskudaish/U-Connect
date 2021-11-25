<?php


function kontakte($email){

    $link  = connectdb();

    $kontakte =null;

    $resultat=  mysqli_query($link,"select id from nutzer where email='{$email}'");
    $date = mysqli_fetch_assoc($resultat);
    $nutzer_id=$date['id'];


    $result=mysqli_query($link,"select id,vorname,nachname,bildname from kontakte where nutzer_id= '{$nutzer_id}' ");
    while($daten = mysqli_fetch_assoc($result)) {

        $kontakte []= $daten;

    }

    return $kontakte;
}

function kontaktdaten($kontakt_id){
    $link  = connectdb();

    $kontakt=null;

    $result1=mysqli_query($link,"select * from kontakte where id= '{$kontakt_id}' ");
    $daten1    =   mysqli_fetch_assoc($result1);
    $kontakt ['id']= $daten1['id'];
    $kontakt ['vorname']= $daten1['vorname'];
    $kontakt ['nachname']= $daten1['nachname'];
    $kontakt ['bildname']= $daten1['bildname'];
    $kontakt  ['erinnerungsinterval']= $daten1 ['erinnerungsinterval'];


    $result2  =   mysqli_query($link,"select * from socialMedia_Kontakte where id= '{$kontakt_id}' ");
    $daten2    =   mysqli_fetch_assoc($result2);
    $kontakt ['instagram']= $daten2['instagram'];
    $kontakt ['facebook']= $daten2['facebook'];
    $kontakt ['twitter']= $daten2['twitter'];


    $result3  =   mysqli_query($link,"select telefonnummer from telefonnummer_kontakte where id= '{$kontakt_id}' ");
    $daten3    =   mysqli_fetch_assoc($result3);
    $kontakt ['telefonnummer']= $daten3['telefonnummer'];


    $result4   =   mysqli_query($link,"select * from adresse_kontakte where id= '{$kontakt_id}' ");
    $daten4   =   mysqli_fetch_assoc($result4);
    $kontakt ['strasse']= $daten4['strasse'];
    $kontakt ['plz']= $daten4['plz'];
    $kontakt ['stadt']= $daten4['stadt'];
    $kontakt ['land']= $daten4['land'];



    $result5  =   mysqli_query($link,"select * from geburtsdatum_kontakte where id= '{$kontakt_id}' ");
    $daten5   =   mysqli_fetch_assoc($result5);
    $kontakt ['geburtsdatum']= $daten5['geburtsdatum'];


    $result6  =   mysqli_query($link,"select * from tags_kontakte where id= '{$kontakt_id}' ");
    $daten6    =   mysqli_fetch_assoc($result6);
    $kontakt ['tags']= $daten6['tags'];


    $result7  =   mysqli_query($link,"select * from text_kontakte where id= '{$kontakt_id}' ");
    $daten7    =   mysqli_fetch_assoc($result7);
    $kontakt ['textfeld']= $daten7['textfeld'];



return $kontakt;

}