<?php
require_once('../models/eventsListe.php');
class EventController
{
    public function Events_planen()// ausgewählte Kontakt anzeigen bearbeiten
    {
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $email=$_SESSION['email'];
            $events= events($email);
            //if(!empty($events))
             //   $daten = [];
           // else
            $daten=[ 'events' => $events];

            return view('Events.Events_planen', $daten);
        }
        else {
            header("Location: /");
        }
    }
}
