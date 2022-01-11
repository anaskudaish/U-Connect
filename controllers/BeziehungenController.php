<?php
require_once('../models/beziehungen.php');
require_once('../models/kontakt_suchen.php');
require_once('../models/kontaktenzeigen.php');
class BeziehungenController
{
    function beziehungenVerwalten(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1){
            $email=$_SESSION['email'];
            if(isset($_POST['beziehungen_zu_id'])){
                $beziehung_zu = $_POST['beziehungen_zu_id'];
                $zu_bearebiten = $_POST['beziehungen_zu_id'];
                $kontakt_bearbeiten = get_zu_bearbeitenden_name($zu_bearebiten);
            }
            if(isset($_POST['beziehungen_hinzufügen'])){
                $zu_bearebiten = $_POST['beziehungen_hinzufügen'];
                $kontakt_hinzufügen = get_zu_bearbeitenden_name($zu_bearebiten);
            }
            if(isset($_POST['bewertung'])){
                $ergebnis = beziehung_hinzufügen($_POST['id_kontakt'],$_POST['beziehungen_hinzufügen'],$_POST['bewertung']);
            }
            if(isset($_POST['submit_entfernen'])){
                $id = $_POST['id_kontakt'];
                $beziehung_zu2 = $_POST['beziehung_zu'];
                beziehung_entfernen($id,$beziehung_zu2);
            }
            if(isset($_POST['submit_update'])){
                $id = $_POST['id_kontakt'];
                $beziehung_zu2 = $_POST['beziehung_zu'];
                $ergebnis = beziehung_hinzufügen($id,$beziehung_zu2,$_POST['update_entfernen']);
            }
            $kontakt_wo_beziehungen_bearebitet_werden = name_vom_kontakt($_POST['id_kontakt']);
            //$daten = [ 'names' => $names];


                /*$email = $_SESSION['email'];
                $search_text = isset($_POST['search_text']) ? trim($_POST['search_text']) : "";
                $show = null;

                    $vornamen = vorname_suchen($email, $search_text);
                    foreach ($vornamen as $value) {
                        if (stripos($value['vorname'], $search_text) !== false) {

                            $show[] = $value;
                        }
                    }*/
            if ($_POST['submitted'] == 5) {
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
            }

            if(!empty($show)){
                $kontakte=  kontakte_ergebnisse($show);
                $resultat= "Suchergebnisse";

            }
            else{
                $kontakte= kontakte($email);
                $resultat= "Ihre Suche ergab keine Treffer";
            }
            $names = kontakt_name($_POST['id_kontakt']);
            foreach ($names as $key){
                $names2[] = get_name_zu_beziehung($key['id_beziehung']);
            }
            //$test_result = $names.array_merge($names2);
            //$names2 = get_name_zu_beziehung($names['Beziehungs_wert']);
            $counter = 0;
            $test_result2 = [];
            foreach ($names as $key2){
                if($counter < count($names)){
                    $key2["vorname"] = $names2[$counter][0]['vorname'];
                    $key2["nachname"] = $names2[$counter][0]['nachname'];

                    $test_result2[] = $key2;
                    $counter++;
                }
            }
            $daten=[
                'names' => $names,
                'kontakte' => $kontakte,
                'resultat' => $resultat,
                'search_text' => $search_text,
                'kontakt_bearebiten' => $kontakt_bearbeiten ?? [],
                'kontakt_hinzufügen' => $kontakt_hinzufügen ?? [],
                'ergebnis' => $ergebnis ?? false,
                'kontakt_wo_beziehungen_bearebitet_werden' => $kontakt_wo_beziehungen_bearebitet_werden,
                'names2' => $names2 ?? [],
                'test_result2' => $test_result2,
                'beziehung_zu' => $beziehung_zu ?? 0
            ];

            return view('Beziehungen.beziehungen', $daten);
        }
        else {
            header("Location: /");
        }
    }

    // funktion ist das gleiche wie oben nix geändert,
    function beziehungen_hinzufuegen(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1){
            if(isset($_POST['beziehungen_zu_id'])){
                $beziehung_zu = $_POST['beziehungen_zu_id'];
                $zu_bearebiten = $_POST['beziehungen_zu_id'];
                $kontakt_bearbeiten = get_zu_bearbeitenden_name($zu_bearebiten);
            }
            if(isset($_POST['beziehungen_hinzufügen'])){
                $zu_bearebiten = $_POST['beziehungen_hinzufügen'];
                $kontakt_hinzufügen = get_zu_bearbeitenden_name($zu_bearebiten);
            }
            if(isset($_POST['bewertung'])){
                $ergebnis = beziehung_hinzufügen($_POST['id_kontakt'],$_POST['beziehungen_hinzufügen'],$_POST['bewertung']);
            }
            if(isset($_POST['submit_entfernen'])){
                $id = $_POST['id_kontakt'];
                $beziehung_zu2 = $_POST['beziehung_zu'];
                beziehung_entfernen($id,$beziehung_zu2);
            }
            if(isset($_POST['submit_update'])){
                $id = $_POST['id_kontakt'];
                $beziehung_zu2 = $_POST['beziehung_zu'];
                $ergebnis = beziehung_hinzufügen($id,$beziehung_zu2,$_POST['update_entfernen']);
            }
            $kontakt_wo_beziehungen_bearebitet_werden = name_vom_kontakt($_POST['id_kontakt']);
            //$daten = [ 'names' => $names];


            /*$email = $_SESSION['email'];
            $search_text = isset($_POST['search_text']) ? trim($_POST['search_text']) : "";
            $show = null;

                $vornamen = vorname_suchen($email, $search_text);
                foreach ($vornamen as $value) {
                    if (stripos($value['vorname'], $search_text) !== false) {

                        $show[] = $value;
                    }
                }*/
            if ($_POST['submitted'] == 5) {
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
            }

            if(!empty($show)){
                $kontakte=  kontakte_ergebnisse($show);
                $resultat= "Suchergebnisse";

            }
            else{
                $kontakte= kontakte($email);
                $resultat= "Ihre Suche ergab keine Treffer";
            }
            $names = kontakt_name($_POST['id_kontakt']);
            foreach ($names as $key){
                $names2[] = get_name_zu_beziehung($key['id_beziehung']);
            }
            //$test_result = $names.array_merge($names2);
            //$names2 = get_name_zu_beziehung($names['Beziehungs_wert']);
            $counter = 0;
            $test_result2 = [];
            foreach ($names as $key2){
                if($counter < count($names)){
                    $key2["vorname"] = $names2[$counter][0]['vorname'];
                    $key2["nachname"] = $names2[$counter][0]['nachname'];

                    $test_result2[] = $key2;
                    $counter++;
                }
            }
            $daten=[
                'names' => $names,
                'kontakte' => $kontakte,
                'resultat' => $resultat,
                'search_text' => $search_text,
                'kontakt_bearebiten' => $kontakt_bearbeiten ?? [],
                'kontakt_hinzufügen' => $kontakt_hinzufügen ?? [],
                'ergebnis' => $ergebnis ?? false,
                'kontakt_wo_beziehungen_bearebitet_werden' => $kontakt_wo_beziehungen_bearebitet_werden,
                'names2' => $names2 ?? [],
                'test_result2' => $test_result2,
                'beziehung_zu' => $beziehung_zu ?? 0
            ];

            return view('Beziehungen.beziehungen_hinzufuegen', $daten);
        }
        else {
            header("Location: /");
        }

    }
}