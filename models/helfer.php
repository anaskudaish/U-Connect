<?php


function hashpasswort($passwort):string{
    $salt='SWE';
    return  sha1($passwort.$salt);
}


function tags_import($email_nutzer,$neu_tag){
    $link = connectdb();
    $result = mysqli_query($link, "select id from nutzer where email='{$email_nutzer}'");
    $date = mysqli_fetch_assoc($result);
    $nutzer_id = (int)$date['id'];

     $nutzer_tags= tags_export($email_nutzer);
     if(is_null($nutzer_tags)){
         mysqli_query($link,"insert into nutzer_tags (id,tags)  VALUES ('$nutzer_id','$neu_tag')");
     }
     else
     {

    $nutzer_tags[]=$neu_tag;
     $tags= implode('-',  $nutzer_tags);
    mysqli_query($link,"update nutzer_tags set tags='{$tags}' where id='{$nutzer_id}'");
     }
    mysqli_free_result($result);
    mysqli_close($link);
}

function tags_export($email_nutzer){
    $link = connectdb();

    $result = mysqli_query($link, "select id from nutzer where email='{$email_nutzer}'");
    $date = mysqli_fetch_assoc($result);
    $nutzer_id = (int)$date['id'];
    mysqli_free_result($result);

    $resultat=  mysqli_query($link,"select tags from nutzer_tags where id='{$nutzer_id}'");
    $daten = mysqli_fetch_assoc($resultat);
    mysqli_free_result($resultat);

    mysqli_close($link);

    if(empty($daten['tags'])){
        return null;
    }
    else{
        return explode('-', $daten['tags']);
    }

}
