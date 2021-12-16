<?php
require_once('../models/helfer.php');
require_once('../models/profil.php');
class ProfilController
{


    public function profil_update()
    {

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {


            $email=$_SESSION['email'];
            $var =null;

            if ($_POST['submitted']) {

                $passwort = $_POST['passwort'];
                $hashpasswort= hashpasswort($passwort);
                $resultat =  passwort_ok($email, $hashpasswort);// Aktuelles Passwort ok
                if($resultat== true) {

                    $mitteilung=null;
                    $result1=null; $result2=null; $result3=null; $result4=null; $result5= null;
                    if (!empty(trim($_POST['email']))) {

                        $neue_email = trim($_POST['email']);
                        $resultat = is_email_ok($email, $neue_email);

                        // resultat = 0 Diese E-Mail existiert bereits
                        // resultat = 1 Diese E-Mail existiert nicht bereits
                        // resultat = 2 die von Ihnen eingegebene E-Mail entspricht Ihre aktuelle E-Mail


                        if($resultat==0){
                            $result1='Bitte eine andere E-Mail verwenden';
                        }
                        elseif ($resultat==1) {// E-Mail existiert nicht bereits
                          $code=  code_senden($neue_email);
                            if (!$code) {
                                $result1= 'Leider ist ein fehler aufgetreten';
                            }
                            else {
                                $_SESSION['code'] = $code;
                                $mitteilung='wir haben einen Code an die gegebene E-Mail gesandt.';
                                $_SESSION['neue_email'] = $neue_email;
                            }
                        }
                        else{
                            $result1='Die eingegebene E-Mail entspricht aktuelle E-Mail';
                        }
                    }
                    if(!empty(trim($_POST['code']))){

                        $code=trim($_POST['code']);
                        $result2=null;
                        if($_SESSION['code']==$code) {

                            $neue_email= $_SESSION['neue_email'] ;
                            neue_email($email,$neue_email);

                            $_SESSION['email']=$neue_email;

                            unset($_SESSION['code']);
                            unset($_SESSION['neue_email']);
                        }
                        else{
                            $result2='Code ist falsch';

                        }
                    }
                    if (!empty($_POST['passwort1']) || !empty($_POST['passwort2'])) {

                        $passwort1 = trim($_POST['passwort1']);
                        $passwort2 = trim($_POST['passwort2']);
                        if ($passwort1 == $passwort2) {
                            if (!(preg_match("/[a-z]/", $passwort1)
                                && preg_match("/[A-Z]/", $passwort1)
                                && preg_match("/[0-9]/", $passwort1))) {
                                $result4  = "Das neues Passwort muss Kleinbuchstaben, Großbuchstaben und Zahlen enthalten.";
                            } else if (strlen($passwort1) < 8) {
                                $result4  = "Das neues Passwort muss mindestens 8 Zeichen lang sein.";
                            }
                            else {
                                $hashpasswort = hashpasswort($passwort1);
                                neues_passwort($email, $hashpasswort);
                                $result3 = 'Ihr Passwort wurde erfolgreich zurückgesetzt';
                            }
                        }
                        else {
                            $result4='Passwörter stimmen nicht überein';

                        }
                    }
                }
                else{

                     $result5='Aktuelles Passwort ist falsch';
                }

                $var = [
                    'Email' => $_SESSION['email'],
                    'mitteilung'  => $mitteilung,
                    'fehler_email' => $result1,
                    'fehler_code' => $result2,
                    'resultat'  => $result3,
                    'fehler_passwort' => $result4,
                    'fehler_akt_passwort' =>$result5

                ];
                return view('Index.page.profil', $var);
            }
            else{
                header("Location: /Profil");
            }
        }
        else{
            header("Location: /anmeldung");
        }

    }



}