<?php
require_once('../models/eventsListe.php');
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
            $eventData = ausgewaehtlesevent(1);
            $userList = teilnehmerDesEvents(1);
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
            $eventData = ausgewaehtlesevent(1);
            $userList = teilnehmerDesEvents(1);
            $daten = ['eventData' => $eventData,
                'userList' => $userList
            ];
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
        $events= events($email);
        $selected = null;
        $daten=[ 'events' => $events,
            'selected' => $selected];
        return view('Events.Events_planen',$daten);
    }
}
