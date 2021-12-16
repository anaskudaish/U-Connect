<?php
require_once('../models/beziehungen.php');
require_once('../models/kontakt_suchen.php');
require_once('../models/kontaktenzeigen.php');
class BeziehungenController
{
    function beziehungenVerwalten(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1){
            $names = kontakt_name($_POST['id_kontakt']);
            foreach ($names as $key){
                $names2[] = get_name_zu_beziehung($key['id_beziehung']);
            }
            //$names2 = get_name_zu_beziehung($names['Beziehungs_wert']);

            if(isset($_POST['beziehungen_zu_id'])){
                $zu_bearebiten = $_POST['beziehungen_zu_id'];
                $kontakt_bearebiten = get_zu_bearbeitenden_name($zu_bearebiten);
            }
            if(isset($_POST['beziehungen_hinzufügen'])){
                $zu_bearebiten = $_POST['beziehungen_hinzufügen'];
                $kontakt_hinzufügen = get_zu_bearbeitenden_name($zu_bearebiten);
            }
            if(isset($_POST['bewertung'])){
                $ergebnis = beziehung_hinzufügen($_POST['id_kontakt'],$_POST['beziehungen_hinzufügen'],$_POST['bewertung']);
            }
            $kontakt_wo_beziehungen_bearebitet_werden = name_vom_kontakt($_POST['id_kontakt']);
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
                'kontakt_bearebiten' => $kontakt_bearebiten,
                'kontakt_hinzufügen' => $kontakt_hinzufügen,
                'ergebnis' => $ergebnis,
                'kontakt_wo_beziehungen_bearebitet_werden' => $kontakt_wo_beziehungen_bearebitet_werden,
                'names2' => $names2
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