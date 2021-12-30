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

            $daten = ['eventData' => $eventData,
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
            $eventID = $_POST['eventID'];
            teilnehmerEntfernen($_POST['eventID'],$_POST['TeilnehmerID']);
          $eventData = ausgewaehtlesevent($eventID);
          $userList = teilnehmerDesEvents($eventID);
          $daten = ['eventData' => $eventData,
              'userList' => $userList
            ];
            return view('Events.Event_bearbeiten',$daten);
        }else{
            header("Location: /");
        }
    }

    public function Kontakt_auswaehlen(){
        if(isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1){
            $eventID = $_POST['eventId'];
            $KontaktID = $_POST['kontaktID'];
            $eventData = ausgewaehtlesevent($eventID);
            $userList = teilnehmerDesEvents($eventID);
            $andereKontakte = nichtteilnehmerDesEvents($eventID,$_SESSION['email']);

            $ausgewaehtlerKontakt = getKontakt($KontaktID);
            $KontaktBeziehung = getBeziehungenImEvent($eventID,$KontaktID);
               // $KontaktBeziehung['Durchschnitt'] = 0;
            $daten = ['eventData' => $eventData,
                'userList' => $userList,
                'andereKontakte' => $andereKontakte,
                'KontaktBeziehung' => $KontaktBeziehung,
                'ausgewaehtlerKontakt' => $ausgewaehtlerKontakt
            ];
            return view('Events.Teilnehmer_Hinzufuegen',$daten);
        }else{
            header("Location: /");
        }
    }

    public function Ausgewaehlten_Kontakt_Hinzufuegen(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $eventID = $_POST['eventId'];
            teilnehmerHinzufuegen($eventID,$_POST['kontaktID']);
            echo $eventID."<br>";
            echo $_POST['kontaktID'];
            $eventData = ausgewaehtlesevent($eventID);
            $userList = teilnehmerDesEvents($eventID);
            $andereKontakte= nichtteilnehmerDesEvents($eventID,$_SESSION['email']);

            $daten = ['eventData' => $eventData,
                'userList' => $userList,
                'andereKontakte' => $andereKontakte,
            ];
            return view('Events.Teilnehmer_Hinzufuegen',$daten);
        }else{
            header("Location: /");
        }
    }
}
