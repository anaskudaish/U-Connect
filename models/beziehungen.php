<?php
function kontakt_name(){
    $link = connectdb();
    $result=  mysqli_query($link,"select id ,vorname, nachname from kontakte");

    while($names = mysqli_fetch_assoc($result)) {

        $name[]= $names;

    }

    mysqli_close($link);
    return $name;
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