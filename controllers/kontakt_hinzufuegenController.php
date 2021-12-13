<?php
require_once ('../models/neuer_kontakt.php');
require_once('../models/helfer.php');

class kontakt_hinzufuegenController
{



    public  function kontakt_hinzufuegen(){

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $email_nutzer=$_SESSION['email'];

            if ($_POST['submitted']) {


                $vorname              = $_POST['vorname'];
                $nachname             = $_POST['nachname'];

                $erinnerungsinterval  = $_POST['erinnerungsinterval'];

                $telefonnummer        = $_POST['telefonnummer'];

                $instagram           = $_POST['instagram'];
                $facebook            = $_POST['facebook'] ;
                $twitter             = $_POST['twitter'] ;

                $strasse             = $_POST['strasse'];
                $plz                 = $_POST['plz'];
                $stadt               = $_POST['stadt'] ;
                $land                = $_POST['land'] ;

                $textfeld            = $_POST['textfeld'];

                $geburtsdatum        = $_POST['geburtsdatum'];
                $bildname = null;
                   if (!$_FILES['bild']['error']){

                       $bildname = $_FILES['bild']['name'];
                       $bildtmp = $_FILES['bild']['tmp_name'];

                       $bildExt = explode('.', $bildname);
                       $bildActualExt = strtolower(end($bildExt));

                       $bildnameNew = uniqid('', true) . "." . $bildActualExt;
                       $bildspeichern =  "img\\". $bildnameNew;

                       move_uploaded_file($bildtmp, $bildspeichern);
                       $bildname = $bildnameNew;

                   }


                $tags=null;
                if(!empty($_POST['tags'])){
                    $tags=implode(",",$_POST['tags']);
                    if(!empty($_POST['neu_tag'])){
                        $neu_tag=trim($_POST['neu_tag']);
                        $tags=$tags.','.$neu_tag;
                        tags_import($email_nutzer,$neu_tag);// für nutzer
                    }
                }
                elseif(!empty($_POST['neu_tag'])){
                    $neu_tag=trim($_POST['neu_tag']);
                    $tags=$neu_tag;
                    tags_import($email_nutzer,$neu_tag);//für nutzer
                }

                $resultatok =null;
                $resultatfehelr=null;
                $resultat= kontakt_hinzufuegen
                ($email_nutzer,$vorname,$nachname,$bildname,$erinnerungsinterval,$telefonnummer,$instagram,$facebook,$twitter,$strasse,$plz,$stadt,$land,$textfeld,$geburtsdatum,$tags);
                if($resultat==true){
                    $resultatok  ='Kontakt hinzugefügt';
                }
                else{
                    $resultatfehelr ='Fehler ist aufgetreten';
                }
                $daten = [

                    'resultatfehler' => $resultatfehelr,
                    'resultatok' => $resultatok,
                    'tags' => tags_export($email_nutzer)
                ];
                return view('Index.page.Neuer_Kontakt', $daten);
            }
            else{

                header("Location: /Neuer_Kontakt");
            }
        }
        else {
            header("Location: /anmeldung");
        }

}

















}