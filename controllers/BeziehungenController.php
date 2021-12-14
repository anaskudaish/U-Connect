<?php
require_once('../models/beziehungen.php');
require_once('../models/kontakt_suchen.php');
require_once('../models/kontaktenzeigen.php');
class BeziehungenController
{
    function beziehungenVerwalten(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1){
            $names = kontakt_name();


            if(isset($_POST['beziehungen_zu_id'])){
                $zu_bearebiten = $_POST['beziehungen_zu_id'];
                $kontakt_bearebiten = get_zu_bearbeitenden_name($zu_bearebiten);
            }

            //$daten = [ 'names' => $names];

            //if ($_POST['submitted'] == 1) {
                $email = $_SESSION['email'];
                $search_text = trim($_POST['search_text']);
                $show = null;

                    $vornamen = vorname_suchen($email, $search_text);
                    foreach ($vornamen as $value) {
                        if (stripos($value['vorname'], $search_text) !== false) {

                            $show[] = $value;
                        }
                    }
            //}
            if(!empty($show)){
                $kontakte=  kontakte_ergebnisse($show);
                $resultat= "Suchergebnisse";

            }
            else{
                $kontakte= kontakte($email);
                $resultat= "Ihre Suche ergab keine Treffer";
            }
            $daten=[
                'names' => $names,
                'kontakte' => $kontakte,
                'resultat' => $resultat,
                'search_text' => $search_text,
                'kontakt_bearebiten' => $kontakt_bearebiten
            ];

            return view('Beziehungen.beziehungen', $daten);
        }
        else {
            header("Location: /");
        }
    }

    function beziehung_hinzufügen(){

    }
}