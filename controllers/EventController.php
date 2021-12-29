<?php
require_once('../models/eventsListe.php');
//require_once('../models/kontaktenzeigen.php');

class EventController
{
    public function Events_planen()// Anzeige Events
    {
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $email=$_SESSION['email'];
            $events= events($email);
            $selected = null;
            $daten=[ 'events' => $events,
                     'selected' => $selected];
            return view('Events.Events_planen', $daten);
        }
        else {
            header("Location: /");
        }
    }
    public function Event_bearbeiten()// ausgewähltes Event bearbeiten
    {
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            if(!empty($_POST['submitted'])){
                updateEvent($_SESSION['email'],$_POST['eventId'],$_POST['Eventname'],$_POST['date'],$_POST['time']);
                header("Location: /Events_planen");
            }
            $eventData = ausgewaehtlesevent($_POST['eventId']);
            $userList = teilnehmerDesEvents($_POST['eventId']);
            $daten = ['eventData' => $eventData,
                      'userList' => $userList
                ];
            return view('Events.Event_bearbeiten',$daten);
        }
        else {
            header("Location: /");
        }
    }
    public function neues_Event()// ausgewähltes Event bearbeiten
    {
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $daten = [];
            return view('Events.neues_Event',$daten);
        }
        else {
            header("Location: /");
        }
    }

    public function event_hinzufuegen(){
        $eventname              = $_POST['Eventname'];
        $date             = $_POST['date'];
        $time = $_POST['time'];
        $email=$_SESSION['email'];
        $contacts = [];
        createEvent($email,$eventname,$date,$time,$contacts);

        header("Location: /Events_planen");
    }

    public function Teilnehmer_Hinzufuegen(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $eventData = ausgewaehtlesevent($_POST['eventId']);
            $userList = teilnehmerDesEvents($_POST['eventId']);
            $andereKontakte= nichtteilnehmerDesEvents($_POST['eventId'],$_SESSION['email']);

            $daten = ['eventData' => 1,
                'userList' => $userList,
                'andereKontakte' => $andereKontakte
            ];
            return view('Events.Teilnehmer_Hinzufuegen',$daten);
        }else{
            header("Location: /");
        }
    }

    public function Teilnehmer_Entfernen(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            // TO DO REMOVE SELECTED CONTACT
            header("Location: /Event_bearbeiten");
        }else{
            header("Location: /");
        }
    }
}
