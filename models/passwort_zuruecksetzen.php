<?php


function passwort_zuruecksetzen($email,$hashpasswort){
    $link = connectdb();

    mysqli_query($link, "update nutzer set passwort ='{$hashpasswort}' where email='{$email}'");
    mysqli_query($link, "update nutzer set passwort_zurueck=0 where email='{$email}'");
    $result=  mysqli_query($link, "select id from nutzer where  email='{$email}'");
    $date= mysqli_fetch_assoc($result);
    $id=$date['id'];

    mysqli_query($link, "delete from temporaeres_passwort where id ='{$id}'");


    mysqli_free_result($result);
    mysqli_close($link);


}