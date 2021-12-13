<?php

require_once('../models/erinnerung.php');
require_once('../models/geburtstage_erinnerung.php');
require_once('../models/helfer.php');
require_once('../models/kontaktenzeigen.php');
require_once('../models/kontakt_bearbeiten.php');


class IndexController
{

    public function index()
    {

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {

            $email=$_SESSION['email'];
            $kontakte= kontakte($email);
            $daten=[ 'kontakte' => $kontakte

            ];

            return view('Index.page.index', $daten);

        } else {
            header("Location: /anmeldung");
        }
    }


    public function kontakt()// ausgewählte Kontakt anzeigen
    {

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {

            if ($_POST['submitted']) {

                $kontakt_id = $_POST['id_kontakt'];
                $kontakt= kontaktdaten($kontakt_id);
                $daten=[ 'kontakt' => $kontakt

                ];
                return view('Index.page.kontakt', $daten);
            }
            else{
                header("Location: /");
            }


        } else {
            header("Location: /anmeldung");
        }
    }
    public function kontakt_bearbeiten()// ausgewählte Kontakt anzeigen bearbeiten
    {

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {

            if(isset($_POST['bearbeiten'])) {
                if ($_POST['bearbeiten']) {

                    $kontakt_id = $_POST['id_kontakt'];
                    $kontakt = kontaktdaten($kontakt_id);
                    $daten = ['kontakt' => $kontakt

                    ];
                    return view('Index.page.kontakt_bearbeiten', $daten);
                } else {
                    header("Location: /");
                }
            }
            else if(!empty($_POST)){
                kontakt_bearbeiten();
                header("Location: /");
            }
            else {
                header("Location: /anmeldung");
            }

        }
        else {
            header("Location: /anmeldung");
        }
    }

    public function Neuer_Kontakt()
    {

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $email_nutzer = $_SESSION['email'];

            $daten = ['tags' => tags_export($email_nutzer)];

            return view('Index.page.Neuer_Kontakt', $daten);

        } else {
            header("Location: /anmeldung");
        }

    }

    public function Profil()
    {

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {

            $email = $_SESSION['email'];

            $var = [
                'Email' => $email];


            return view('Index.page.profil', $var);
        } else {
            header("Location: /anmeldung");
        }

    }


}
