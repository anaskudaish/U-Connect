<?php

require_once('../models/erinnerung.php');
require_once('../models/geburtstage_erinnerung.php');
require_once('../models/helfer.php');
require_once('../models/kontaktenzeigen.php');
require_once('../models/kontakt_bearbeiten.php');
require_once('../models/kontakt_suchen.php');
require_once('../models/loeschen.php');


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

    public function kontakt_suchen(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {

            if ($_POST['submitted']) {
                $email=$_SESSION['email'];
                $search_text = trim($_POST['search_text']);
                $show=null;
                if($_POST['wahl']==1){
                    $vornamen= vorname_suchen($email,$search_text);
                    foreach ($vornamen as $value) {
                        if (stripos($value['vorname'], $search_text) !== false) {

                            $show[] = $value;
                        }
                    }
                }
                elseif ($_POST['wahl']==2){
                    $nachnamen= nachname_suchen($email,$search_text);
                    foreach ($nachnamen as $value) {
                        if (stripos($value['nachname'], $search_text) !== false) {

                            $show[] = $value;
                        }
                    }
                }
                else{
                    $tags= tags_suchen($email,$search_text);
                    foreach ($tags as $value) {
                        if (stripos($value['tags'], $search_text) !== false) {

                            $show[] = $value;
                        }
                    }
                }
                      if(!empty($show)){
                          $kontakte=  kontakte_ergebnisse($show);
                          $resultat= "Suchergebnisse";

                      }
                      else{
                          $kontakte= kontakte($email);
                          $resultat= "Ihre Suche ergab keine Treffer";
                      }
                    $daten=['kontakte' => $kontakte,
                           'resultat' => $resultat,
                           'search_text' => $search_text ];

                return view('Index.page.index', $daten);
            }
            else{
                header("Location: /");
            }
        }
        else {
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
    public function kontakt_loeschen()
    {

        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            if (isset($_POST['loeschen'])) {
                if($_POST['loeschen']){
                    $kontakt_id = $_POST['id_kontakt'];
                    $bool = kontakt_loeschen_model($kontakt_id);
                    $daten = ['loeschen_bool' => $bool
                    ];
                    header("Location: /");
                }
                else {
                    header("Location: /kontakt");
                }
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /anmeldung");
        }
    }
}
