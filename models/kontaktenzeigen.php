<?php


function kontakte($email){

    $link  = connectdb();

    $kontakte =null;

    $resultat=  mysqli_query($link,"select id from nutzer where email='{$email}'");
    $date = mysqli_fetch_assoc($resultat);
    $nutzer_id=$date['id'];


    $result=mysqli_query($link,"select kontakte.id,vorname,nachname,bildname, geburtsdatum, stadt,land from kontakte
left join geburtsdatum_kontakte gk on kontakte.id = gk.id
left join adresse_kontakte ak on kontakte.id = ak.id where nutzer_id= '{$nutzer_id}' ");
    while($daten = mysqli_fetch_assoc($result)) {

        $kontakte []= $daten;

    }

    return $kontakte;
}

function kontaktdaten($kontakt_id)
{
    $link = connectdb();

    $kontakt = null;

    $result1 = mysqli_query($link, "select * from kontakte where id= '{$kontakt_id}' ");
    $daten1 = mysqli_fetch_assoc($result1);
    $kontakt ['id'] = $daten1['id'];
    $kontakt ['vorname'] = $daten1['vorname'];
    $kontakt ['nachname'] = $daten1['nachname'];
    $kontakt ['bildname'] = $daten1['bildname'];
    $kontakt  ['erinnerungsinterval'] = $daten1 ['erinnerungsinterval'];


    $result2 = mysqli_query($link, "select * from socialMedia_Kontakte where id= '{$kontakt_id}' ");
    $daten2 = mysqli_fetch_assoc($result2);
    $kontakt ['instagram'] = $daten2['instagram'] ?? null;
    $kontakt ['facebook'] = $daten2['facebook'] ?? null;
    $kontakt ['twitter'] = $daten2['twitter'] ?? null;

    $result8  =   mysqli_query($link,"select GROUP_CONCAT(url) as url from urls_kontakte where id= '{$kontakt_id}' ");
    if(!is_bool($result8))
        $daten8    =   mysqli_fetch_assoc($result8);
    $kontakt ['url']= $daten8['url']?? null;

    $result3 = mysqli_query($link, "select telefonnummer from telefonnummer_kontakte where id= '{$kontakt_id}' ");
    $daten3 = mysqli_fetch_assoc($result3);
    $kontakt ['telefonnummer'] = $daten3['telefonnummer'];


    $result4 = mysqli_query($link, "select * from adresse_kontakte where id= '{$kontakt_id}' ");
    $daten4 = mysqli_fetch_assoc($result4);
    $kontakt ['strasse'] = $daten4['strasse'] ?? null;
    $kontakt ['plz'] = $daten4['plz'] ?? null;
    $kontakt ['stadt'] = $daten4['stadt'] ?? null;
    $kontakt ['land'] = $daten4['land'] ?? null;


    $result5 = mysqli_query($link, "select * from geburtsdatum_kontakte where id= '{$kontakt_id}' ");
    $daten5 = mysqli_fetch_assoc($result5);
    $kontakt ['geburtsdatum'] = $daten5['geburtsdatum'] ?? null;
    if (!empty($kontakt ['geburtsdatum'])){
        $arr1 = explode('-', $kontakt['geburtsdatum']);
        $jahr = $arr1[0];
        $monat = $arr1[1];
        $tag = $arr1[2];

        $alter = alter_kontakt($tag, $monat, $jahr);
        $kontakt ['alter'] = $alter;

    }

    $result6  =   mysqli_query($link,"select GROUP_CONCAT(tags) as tags from tags_kontakte where id= '{$kontakt_id}' ");
    $daten6    =   mysqli_fetch_assoc($result6);
    $kontakt ['tags']= $daten6['tags']?? null;


    $result7  =   mysqli_query($link,"select * from text_kontakte where id= '{$kontakt_id}' ");
    $daten7    =   mysqli_fetch_assoc($result7);
    $kontakt ['textfeld']= $daten7['textfeld']?? null;



    return $kontakt;

}


function alter_kontakt($tag,$monat,$jahr): int
{

    $heute = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    // Geburtsdatum als Timestamp
    $geburtstag = mktime(0, 0, 0, $monat, $tag, $jahr);


    return intval(($heute - $geburtstag) / (60 * 60 * 24 * 365));


}
