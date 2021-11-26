<?php
require_once('../models/registrierung.php');
require_once('../models/helfer.php');



class RegistrierungController
{
    public function registrierung()
    {

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            header("Location: /");
        } else {
            $var = [];

            return view('Registrierung.registrierung', $var);
        }

    }

    public function registrierung_verifizierung()
    {
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            header("Location: /");
        }
        elseif ($_POST['submitted']){// submitted
            $fehler = null;
            $email = htmlspecialchars(trim($_POST['email']));
            $passwort1 = $_POST['passwort1'];
            $passwort2 = $_POST['passwort2'];

            if (nutzer_existiert($email) == false) {

                if ($passwort1 == $passwort2) {
                    $_SESSION['email'] = $email;
                    $_SESSION['passwort'] = $passwort1;
                    $code= code_senden($email);
                    if (!$code) {
                        $fehler = 'Leider ist ein fehler aufgetreten';
                    } else {
                        $_SESSION['code'] = $code;
                        header("Location: /bestaetigung_code");
                    }

                } else {
                    $fehler = 'Passwörter stimmen nicht überein';
                }
            } elseif (nutzer_existiert($email) == true) {

                header("Location: /registrierung");
            }
            $var = [
                'valueEmail' => $email,
                'fehler' => $fehler];

            return view('Registrierung.registrierung', $var);

        }
        else{
            header("Location: /registrierung");
        }
    }



    public function bestaetigung_code()
    {
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            header("Location: /");
        } else {
            $var = [];

            return view('Registrierung.bestaetigung_code', $var);

        }


    }
    public function neuer_code(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            header("Location: /");
        }
        elseif($_SESSION['code']){

            $email=  $_SESSION['email'];
            $fehler=null;
            $code= code_senden($email);
            if (!$code) {
                $fehler = 'Leider ist ein fehler aufgetreten';
            }else{
                $_SESSION['code'] = $code;
            }
            $var = [
                'fehler' => $fehler,
            ];

            return view('Registrierung.bestaetigung_code', $var);

        }
        else{
            header("Location: /registrierung");
        }

    }

    public function bestaetigung_code_verifizierung()
    {
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            header("Location: /");
        }
        elseif ($_POST['submitted']) {

            $code=trim($_POST['code']);
            $fehler=null;

            if($_SESSION['code']==$code){
                $passwort=$_SESSION['passwort'];
                $email= $_SESSION['email'];
                $hashpasswort= hashpasswort($passwort);
                if(registrierung($email,$hashpasswort)==true){
                    unset($_SESSION['passwort']);
                    unset($_SESSION['code']);

                    $_SESSION['login_ok']=1;

                    header("Location: /");
                }
                else{
                    $fehler=  'Leider ist ein fehler aufgetreten';
                }
            }
            else{
                $fehler=  'Der Code ist falsch';
            }
            $var = [

                'fehler' => $fehler,
            ];
            return view('Registrierung.bestaetigung_code', $var);

        }
        else{
            header("Location: /registrierung");
        }


    }


}

