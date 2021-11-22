<?php

require_once('../models/passwort_zuruecksetzen.php');
require_once('../models/helfer.php');


class Passwoert_ZuruecksetzenController
{




    public  function passwort_zuruecksetzen(){
        if ($_SESSION['login_ok'] == 1) {
            header("Location: /");
        }
        elseif($_SESSION['login_ok'] == 2){
            $var = [];
            return view('Passwort_Zuruecksetzen.passwort_zuruecksetzen',$var);
        }
        else{
            header("Location: /passwort_vergessen");
        }

    }


    public  function passwort_zuruecksetzen_verifizierung(){
        if ($_SESSION['login_ok'] == 1) {
            header("Location: /");
        }
        elseif($_SESSION['login_ok'] == 2){
            $fehler= null;
            if($_POST['submitted']){
                $email=$_SESSION['email'];
                $passwort1 = $_POST['passwort1'];
                $passwort2 = $_POST['passwort2'];
                if ($passwort1 == $passwort2) {
                    $hashpasswort = hashpasswort($passwort1);
                    passwort_zuruecksetzen($email,$hashpasswort);
                    $_SESSION['login_ok']=1;
                    header("Location: /");
                }
                else{
                    $fehler = 'Passwörter stimmen nicht überein';
                }
            }
            $var = [
                'fehler' => $fehler
            ];
            return view('Passwort_Zuruecksetzen.passwort_zuruecksetzen',$var);
        }
        else{
            header("Location: /passwort_vergessen");
        }

    }








}