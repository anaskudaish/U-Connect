<?php
require_once('../models/anmeldung.php');
require_once('../models/helfer.php');


class AnmeldungController
{

    public function anmeldung()
    {


        if ($_SESSION['login_ok'] == 1) {
            header("Location: /");
        } else {
            $var = [];
            return view('Anmeldung.anmeldung', $var);
        }


    }

    public function anmeldung_verifizierung()
    {
        if ($_SESSION['login_ok'] == 1) {
            header("Location: /");
        } elseif ($_POST['submitted']) {
            $email = htmlspecialchars(trim($_POST['email']));
            $passwort = $_POST['passwort'];
            $hashpasswort = hashpasswort($passwort);

            $resultat = anmeldung($email, $hashpasswort);
            // resultat = 0 Passwort oder email falsch, login failed
            // resultat = 1 Es handelt sich um nicht temporäres Passwort , login ok
            // resultat = 2 Es handelt sich um  temporäres Passwort, noch ein Schritt muss ein neues Passwort
            if ($resultat == 1) {
                $_SESSION['login_ok'] = 1;
                $_SESSION['email'] = $email;
                header("Location: /");
            } elseif ($resultat == 2) {
                $_SESSION['login_ok'] = 2;
                $_SESSION['email'] = $email;
                header("Location: /passwort_zuruecksetzen");
            } else {// $resultat== 0
                $_SESSION['login_ok'] = 0;
                $var = [
                    'valueEmail' => $email,
                    'fehler' => 'E-Mail oder Passwort ist falsch'];

                return view('Anmeldung.anmeldung', $var);
            }
        } else {
            header("Location: /anmeldung");
        }
    }


}



