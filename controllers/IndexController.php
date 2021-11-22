<?php

require_once('../models/erinnerung.php');
require_once('../models/geburtstage_erinnerung.php');
require_once('../models/helfer.php');

class IndexController
{

    public function index(RequestData $rd)
    {

        if ($_SESSION['login_ok'] == 1) {


            $daten = [];
            return view('Index.page.index', $daten);

        } else {
            header("Location: /anmeldung");
        }
    }

    public function Neuer_Kontakt()
    {

        if ($_SESSION['login_ok'] == 1) {
            $email_nutzer = $_SESSION['email'];

            $daten = ['tags' => tags_export($email_nutzer)];

            return view('Index.page.Neuer_Kontakt', $daten);

        } else {
            header("Location: /anmeldung");
        }

    }

    public function Profil()
    {

        if ($_SESSION['login_ok'] == 1) {

            $email = $_SESSION['email'];

            $var = [
                'Email' => $email];


            return view('Index.page.profil', $var);
        } else {
            header("Location: /anmeldung");
        }

    }


}
