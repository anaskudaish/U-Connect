<?php


function kontakt_hinzufuegen($email_nutzer,$vorname,$nachname,$bildname,$erinnerungsinterval,
                             $telefonnummer,$instagram,$facebook,$twitter,$strasse,$plz,$stadt,$land,$textfeld,$geburtsdatum,$tags): bool {

    $resultat=true;

    $link = connectdb();
    $result = mysqli_query($link, "select id from nutzer where email='{$email_nutzer}'");
    $date = mysqli_fetch_assoc($result);
    $nutzer_id = (int)$date['id'];

    mysqli_begin_transaction($link);
    try {

        $time= strtotime($erinnerungsinterval);
        $naechsteerinnerung= date("Y-m-d",$time);
       if($bildname== null){
        $bildname='unknown.jpg';
       }
         mysqli_query($link, "insert into kontakte (nutzer_id,vorname,nachname,bildname,erinnerungsinterval,naechsteerinnerung)
         VALUES ('$nutzer_id','$vorname','$nachname','$bildname','$erinnerungsinterval','$naechsteerinnerung')");

        $lastid= (int)mysqli_insert_id($link);

        if($telefonnummer){
            mysqli_query($link, "insert into telefonnummer_kontakte (id,telefonnummer)
         VALUES ('$lastid','$telefonnummer')");
        }


        if($instagram || $facebook || $twitter){// eine oder mehr nicht null, dann insert
            mysqli_query($link, "insert into socialmedia_kontakte (id,instagram,facebook,twitter)
         VALUES ('$lastid','$instagram','$facebook','$twitter')");

        }

        if($strasse|| $plz||$stadt||$land){
            mysqli_query($link, "insert into adresse_kontakte (id,strasse,plz,stadt,land)
         VALUES ('$lastid','$strasse','$plz','$stadt','$land')");
        }

        if($textfeld){
                  mysqli_query($link, "insert into text_kontakte (id,textfeld)
         VALUES ('$lastid','$textfeld')");
         }

      if($geburtsdatum){
          mysqli_query($link, "insert into geburtsdatum_kontakte (id,geburtsdatum)
         VALUES ('$lastid','$geburtsdatum')");
       }

      if($tags){
          mysqli_query($link, "insert into tags_kontakte (id,tags)
         VALUES ('$lastid','$tags')");

      }

        mysqli_commit($link);
    }
    catch (mysqli_sql_exception $exception) {
        $resultat=false;
        mysqli_rollback($link);

    }
    mysqli_free_result($result);
    mysqli_close($link);
    return $resultat;
}
