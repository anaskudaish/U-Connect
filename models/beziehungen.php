<?php
function kontakt_name($kontakt_id){
    $link = connectdb();
    $result= mysqli_query($link,"SELECT k.id,bk.id_beziehung, bk.Beziehungs_wert from kontakte k 
                                        JOIN beziehungen_kontakte bk ON k.id = bk.id WHERE k.id = '$kontakt_id'");

    $name=[];
    while($names = mysqli_fetch_assoc($result)) {

        $name[]= $names;

    }

    mysqli_close($link);
    return $name;
}
function get_name_zu_beziehung($beziehung){
    $link = connectdb();
    $result= mysqli_query($link,"SELECT vorname, nachname From kontakte WHERE id = '$beziehung'");

    $result3=[];
    while($result2 = mysqli_fetch_assoc($result)) {

        $result3[] = $result2;

    }
    mysqli_close($link);
    return $result3;
}
function get_zu_bearbeitenden_name($zu_bearebiten){
    $link = connectdb();

    $result=  mysqli_query($link,"select id ,vorname, nachname from kontakte WHERE id LIKE '$zu_bearebiten'");

    $name =[];
    while($result2 = mysqli_fetch_assoc($result)) {

        $name[]= $result2;

    }
    mysqli_close($link);
    return $name;
}
function beziehung_hinzufügen($id,$id_beziehung,$bewertung){
    $link = connectdb();

    if(empty($id) || empty($id_beziehung) || empty($bewertung))
        return 0;
    $result=  mysqli_query($link,"REPLACE INTO beziehungen_kontakte(id, id_beziehung, Beziehungs_wert) VALUES('$id','$id_beziehung','$bewertung')");

    mysqli_close($link);
    return $result;
}
function name_vom_kontakt($id){
    $link = connectdb();

    $result=  mysqli_query($link,"SELECT vorname, nachname FROM kontakte WHERE id LIKE '$id';");

    $result2 = mysqli_fetch_assoc($result);
    mysqli_close($link);
    return $result2;
}
function beziehung_entfernen($id,$beziehung_zu){
    $link = connectdb();

    if(empty($beziehung_zu))
        return 0;
    $result = mysqli_query($link,"DELETE FROM beziehungen_kontakte WHERE id = '$id' AND id_beziehung = '$beziehung_zu'");

    if(!is_bool($result))
        $result2 = mysqli_fetch_assoc($result);
    else
        $result2 = 0;
    mysqli_close($link);
    return $result2;
}