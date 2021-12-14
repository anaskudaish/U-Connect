<?php

function vorname_suchen($email,$search_text)
{
    $link  = connectdb();

    $vornamen  =null;

    $resultat=  mysqli_query($link,"select id from nutzer where email='{$email}'");
    $date = mysqli_fetch_assoc($resultat);
    $nutzer_id=$date['id'];


    $result=mysqli_query($link,"select id,vorname from kontakte where nutzer_id= '{$nutzer_id}' ");
    while($daten = mysqli_fetch_assoc($result)) {

        $vornamen []= $daten;

    }
return $vornamen;
}
function nachname_suchen($email,$search_text)
{
    $link  = connectdb();

    $nachnamen  =null;

    $resultat=  mysqli_query($link,"select id from nutzer where email='{$email}'");
    $date = mysqli_fetch_assoc($resultat);
    $nutzer_id=$date['id'];


    $result=mysqli_query($link,"select id,nachname from kontakte where nutzer_id= '{$nutzer_id}' ");
    while($daten = mysqli_fetch_assoc($result)) {

        $nachnamen []= $daten;

    }
return $nachnamen;
}
function tags_suchen($email,$search_text)
{
    $link  = connectdb();

    $tags  =null;

    $resultat=  mysqli_query($link,"select id from nutzer where email='{$email}'");
    $date = mysqli_fetch_assoc($resultat);
    $nutzer_id=$date['id'];


    $result1=mysqli_query($link,"select id from kontakte where nutzer_id= '{$nutzer_id}' ");
    while($daten1 = mysqli_fetch_assoc($result1)) {
        $kontakt_id=$daten1['id'];

        $result2=mysqli_query($link,"select id,tags from tags_kontakte where id= '{$kontakt_id}' ");
        while($daten2 = mysqli_fetch_assoc($result2)) {
            $tags []= $daten2;

        }
    }
return $tags;
}

function kontakte_ergebnisse($show){

    $link  = connectdb();

    $kontakte =null;


foreach ($show as $value) {
    $kontakt_id = $value['id'];
    $result = mysqli_query($link, "select id,vorname,nachname,bildname from kontakte where id= '{$kontakt_id}' ");
    $daten = mysqli_fetch_assoc($result);

        $kontakte [] = $daten;


}
    return $kontakte;
}