<?php


function anmeldung($email, $hashpasswort): int
{
         $link = connectdb();

    // resultat = 0 Passwort oder email falsch, login failed
    // resultat = 1 Es handelt sich um nicht temporäres Passwort , login ok
    // resultat = 2 Es handelt sich um  temporäres Passwort, noch ein Schritt muss ein neues Passwort



    $resultat=0;


         $stmt=  mysqli_stmt_init($link);
         mysqli_stmt_prepare($stmt, "select id from nutzer where email=(?) ");
         mysqli_stmt_bind_param($stmt, 's', $email);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
         $date1= mysqli_fetch_assoc($result);
         mysqli_free_result($result);

             if ($date1 != null) {// email existiert
                 $id=$date1['id'];

                 $result=  mysqli_query($link,"select passwort_zurueck from nutzer where id ='{$id}'");
                 $date2= mysqli_fetch_assoc($result);
                 mysqli_free_result($result);
                 $passwort_zurueck=$date2['passwort_zurueck'];


                   if($passwort_zurueck ==1){//Es handelt sich um temporäres Passwort

                       $result= mysqli_query($link, "select ablauf_zeit from temporaeres_passwort where id='{$id}'");
                       $date3 = mysqli_fetch_assoc($result);
                       mysqli_free_result($result);


                       $aktuelleZeit=date("Y-m-d-H-i");
                       $ablauf_zeit = $date3['ablauf_zeit'];

                       if($ablauf_zeit >= $aktuelleZeit){// temporäres Passwort ist noch gültig
                           $result=  mysqli_query($link,"select * from temporaeres_passwort where id = '{$id}'and passwort='{$hashpasswort}'");
                           $date4 = mysqli_fetch_assoc($result);
                           mysqli_free_result($result);


                           if ($date4!= null) {//email  und temporäres Passwort richtig
                               $resultat= 2;
                           }
                           else
                               goto checkLogin;
                       }
                       else{// temporäres Passwort ist nicht mehr gültig
                           mysqli_query($link, "delete from temporaeres_passwort where id ='{$id}'");
                           mysqli_query($link, "update nutzer set passwort_zurueck=0 where id ='{$id}'");
                           $passwort_zurueck =0;
                       }
                   }
                   if ($passwort_zurueck ==0){//Es handelt sich um nicht temporäres Passwort
                       checkLogin:

                       $result=  mysqli_query($link,"select id from nutzer where email ='{$email}' and passwort='{$hashpasswort}'");
                       $date5= mysqli_fetch_assoc($result);
                       mysqli_free_result($result);



                       if ($date5 != null) {//email und Passwort richtig
                           $resultat = 1;
                       }
                       if($passwort_zurueck != 0)
                           mysqli_query($link, "update nutzer set passwort_zurueck=0 where id ='{$id}'");
                   }
             }

    mysqli_close($link);
    return $resultat;

}

