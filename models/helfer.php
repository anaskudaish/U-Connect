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

     $nutzer_tags = array();
     $nutzer_tags= tags_export($email_nutzer);
     if(is_null($nutzer_tags)){
         mysqli_query($link,"insert into nutzer_tags (id,tags)  VALUES ('$nutzer_id','$neu_tag')");
     }
     else
     {

    $nutzer_tags[]=$neu_tag;
     $tags= implode(',',  $nutzer_tags);
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

    $resultat=  mysqli_query($link,"select GROUP_CONCAT(id) as id from kontakte where nutzer_id='{$nutzer_id}'");
    $daten = implode(mysqli_fetch_assoc($resultat));
    mysqli_free_result($resultat);


    if(empty($date))
        return null;
    $resultat =  mysqli_query($link,"SELECT tags FROM tags_kontakte where id in($daten) GROUP BY tags ORDER BY count(tags) DESC");
    $daten = mysqli_fetch_all($resultat);
    mysqli_free_result($resultat);
    mysqli_close($link);


    $tmp = [];
    if(empty($daten)){
        return null;
    }
    else{
        foreach ($daten as $e => $t)
            array_push($tmp,$t[0]);
        return $tmp;
    }

}
