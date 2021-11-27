<?php
require_once('../models/passwort_vergessen.php');
require_once('../models/helfer.php');



class Passwort_VergessenController
{


    public function passwort_vergessen(){

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            header("Location: /");
        } else {
            $var = [];
            return view('Passwort_Vergessen.passwort_vergessen', $var);
        }


    }

    /**
     * @throws Exception
     */
    public function passwort_vergessen_verifizierung ()
{

    if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            header("Location: /");
        }
        elseif ($_POST['submitted']) {// submitted
            $email = htmlspecialchars(trim($_POST['email']));
            $fehler=null;
            $resultat=null;

            if(nutzer_existiert($email)==true) {//send das temporäre Passwort
               $result= send_temporaerPasswort($email);
                if(!$result) {
                    $fehler = 'Leider ist ein fehler aufgetreten';
                }
                else {
                    $resultat = 'Passwort wurde an '."$email".' gesendet, Sie werden auf Startseite weitergeleitet';
                }
            }
            else{//nuter existiert nicht
                header("Location: /passwort_vergessen");


            }
            $var = [
                'fehler' => $fehler,
                'resultat' =>  $resultat];
            return view('Passwort_Vergessen.passwort_vergessen', $var);
        }
        else{
            header("Location: /passwort_vergessen");
        }

 }


}