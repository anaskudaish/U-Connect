<?php
function kontakt_name($kontakt_id){
    $link = connectdb();
    $result= mysqli_query($link,"SELECT k.id,bk.id_beziehung, bk.Beziehungs_wert from kontakte k 
                                        JOIN beziehungen_kontakte bk ON k.id = bk.id WHERE k.id = '$kontakt_id'");

    while($names = mysqli_fetch_assoc($result)) {

        $name[]= $names;

    }

    mysqli_close($link);
    return $name;
}
function get_name_zu_beziehung($beziehung){
    $link = connectdb();
    $result= mysqli_query($link,"SELECT vorname, nachname From kontakte WHERE id = '$beziehung'");

    while($result2 = mysqli_fetch_assoc($result)) {

        $result3[] = $result2;

    }
    mysqli_close($link);
    return $result3;
}
function get_zu_bearbeitenden_name($zu_bearebiten){
    $link = connectdb();

    $result=  mysqli_query($link,"select id ,vorname, nachname from kontakte WHERE id LIKE '$zu_bearebiten'");

    while($result2 = mysqli_fetch_assoc($result)) {

        $name[]= $result2;

    }
    mysqli_close($link);
    return $name;
}
function beziehung_hinzufügen($id,$id_beziehung,$bewertung){
    $link = connectdb();

    $result=  mysqli_query($link,"INSERT INTO beziehungen_kontakte(id, id_beziehung, Beziehungs_wert) VALUES('$id','$id_beziehung','$bewertung')");

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

    $result = mysqli_query($link,"DELETE FROM beziehungen_kontakte WHERE id = '$id' AND id_beziehung = '$beziehung_zu'");

    $result2 = mysqli_fetch_assoc($result);
    mysqli_close($link);
    return $result2;
}
function beziehung_update($id){
    $link = connectdb();

    $result=  mysqli_query($link,"SELECT vorname, nachname FROM kontakte WHERE id ='$id';");

    $result2 = mysqli_fetch_assoc($result);
    mysqli_close($link);
    return $result2;
}