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
            if(isset($_POST['deleteEvent'])){
                deleteEvent($_POST['eventId']);
                header("Location: /Events_planen");
                return ;
            }
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
        $eventID = createEvent($email,$eventname,$date,$time,$contacts);
        if(isset($_POST['submit']))
        if($_POST['submit']=='add_Teilnehmer'){
            $eventData = ausgewaehtlesevent($eventID);
            $userList = teilnehmerDesEvents($eventID );
            if(isset($_POST['BeziehungsWertMax'])) {
                $BeziehungsWertMax = $_POST['BeziehungsWertMax'];
                if(isset($_POST['comparator'])){
                    $comparator = $_POST['comparator'];
                }
            }else{
                $BeziehungsWertMax = 5;
            }
            $andereKontakte= nichtteilnehmerDesEvents($eventID ,$_SESSION['email']);
            $besteKontakte = besteTeilnehmer($eventID,$BeziehungsWertMax,$comparator);
            $daten = ['eventData' => $eventData,
                'userList' => $userList,
                'andereKontakte' => $andereKontakte,
                'besteKontakte' => $besteKontakte,
                'comparator' =>  $comparator
            ];
            return view('Events.Teilnehmer_Hinzufuegen',$daten);
        }else{
            header("Location: /Events_planen");
        }
    }

    public function Teilnehmer_Hinzufuegen(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $eventData = ausgewaehtlesevent($_POST['eventId']);
            $userList = teilnehmerDesEvents($_POST['eventId']);
            $comparator = "greater";
            if(isset($_POST['BeziehungsWertMax'])) {
                $BeziehungsWertMax = $_POST['BeziehungsWertMax'];
                if(isset($_POST['comparator'])){
                    $comparator = $_POST['comparator'];
                }
            }else{
                $BeziehungsWertMax = 5;
            }
            echo $comparator;
            $andereKontakte= nichtteilnehmerDesEvents($_POST['eventId'],$_SESSION['email']);
            $besteKontakte = besteTeilnehmer($_POST['eventId'],$BeziehungsWertMax,$comparator);
            $daten = ['eventData' => $eventData,
                'userList' => $userList,
                'andereKontakte' => $andereKontakte,
                'besteKontakte' => $besteKontakte,
                'BeziehungsWertMax' => $BeziehungsWertMax,
                'comparator' =>  $comparator
            ];
            return view('Events.Teilnehmer_Hinzufuegen',$daten);
        }else{
            header("Location: /");
        }
    }

    public function Teilnehmer_Entfernen(){
      if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
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

    public function Kontakt_suchen_fuer_auswahl(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $email=$_SESSION['email'];
            $search_text = trim($_POST['search_text']);
            $andereKontakte=null;
            $comparator = "greater";
            if(isset($_POST['BeziehungsWertMax'])) {
                $BeziehungsWertMax = $_POST['BeziehungsWertMax'];
                if(isset($_POST['comparator'])){
                    $comparator = $_POST['comparator'];
                }
            }else{
                $BeziehungsWertMax = 5;
            }
            $eventData = ausgewaehtlesevent($_POST['eventId']);
            $userList = teilnehmerDesEvents($_POST['eventId']);
            $besteKontakte = besteTeilnehmer($_POST['eventId'],$BeziehungsWertMax,$comparator);
            if($search_text==""){
                $andereKontakte= nichtteilnehmerDesEvents($_POST['eventId'],$_SESSION['email']);
                $daten = ['eventData' => $eventData,
                    'userList' => $userList,
                    'andereKontakte' => $andereKontakte,
                    'BeziehungsWertMax' => $BeziehungsWertMax,
                    'comparator' =>  $comparator
                ];
                return view('Events.Teilnehmer_Hinzufuegen',$daten);
            }
            if($_POST['wahl']==1){//Vorname
                $andereKontakte= Suche_NichtTeilnehmer($email,$_POST['eventId'],"vorname",$search_text);
            }else{
                if($_POST['wahl']==2){//Nachname
                    $andereKontakte = Suche_NichtTeilnehmer($email,$_POST['eventId'],"nachname",$search_text);
                }else{//Tags
                    $andereKontakte = Suche_NichtTeilnehmer($email,$_POST['eventId'],"tags",$search_text);
                }
            }
            $FilteredbesteKontakte = getMatching($besteKontakte,$andereKontakte);
            $daten = ['eventData' => $eventData,
                'userList' => $userList,
                'andereKontakte' => $andereKontakte,
                'besteKontakte' => $FilteredbesteKontakte,
                'BeziehungsWertMax' => $BeziehungsWertMax,
                'comparator' =>  $comparator
            ];
        }
        return view('Events.Teilnehmer_Hinzufuegen',$daten);
    }

    public function Kontakt_auswaehlen(){
        if(isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1){
            $eventID = $_POST['eventId'];
            $KontaktID = $_POST['kontaktID'];
            $eventData = ausgewaehtlesevent($eventID);
            $userList = teilnehmerDesEvents($eventID);
            $comparator = "greater";
            $isEmpty=false;
            if($userList==[]){
                $isEmpty=true;
            }
            if(isset($_POST['BeziehungsWertMax'])) {
                $BeziehungsWertMax = $_POST['BeziehungsWertMax'];
                if(isset($_POST['comparator'])){
                    $comparator = $_POST['comparator'];
                }
            }else{
                $BeziehungsWertMax = 5;
            }
            $andereKontakte = nichtteilnehmerDesEvents($eventID,$_SESSION['email']);
            $ausgewaehtlerKontakt = getKontakt($KontaktID);
            $KontaktBeziehung = getBeziehungenImEvent($eventID,$KontaktID,$isEmpty);
            $besteKontakte = besteTeilnehmer($eventID,$BeziehungsWertMax,$comparator);
            $daten = ['eventData' => $eventData,
                'userList' => $userList,
                'andereKontakte' => $andereKontakte,
                'KontaktBeziehung' => $KontaktBeziehung,
                'ausgewaehtlerKontakt' => $ausgewaehtlerKontakt,
                'besteKontakte' => $besteKontakte,
                'BeziehungsWertMax' => $BeziehungsWertMax,
                'comparator' =>  $comparator
            ];
            //var_dump($KontaktBeziehung['listeWarnungPers']);
            return view('Events.Teilnehmer_Hinzufuegen',$daten);
        }else{
            header("Location: /");
        }
    }

    public function Ausgewaehlten_Kontakt_Hinzufuegen(){
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == 1) {
            $eventID = $_POST['eventId'];
            $comparator = "greater";
            if(!IstTeilnehmer($eventID,$_POST['kontaktID'])){
            teilnehmerHinzufuegen($eventID,$_POST['kontaktID']);
            }
            if(isset($_POST['BeziehungsWertMax'])) {
                $BeziehungsWertMax = $_POST['BeziehungsWertMax'];
                if(isset($_POST['comparator'])){
                    $comparator = $_POST['comparator'];
                }
            }else{
                $BeziehungsWertMax = 5;
            }
            $eventData = ausgewaehtlesevent($eventID);
            $userList = teilnehmerDesEvents($eventID);
            $andereKontakte= nichtteilnehmerDesEvents($eventID,$_SESSION['email']);
            $besteKontakte = besteTeilnehmer($eventID,$BeziehungsWertMax,$comparator);
            $daten = ['eventData' => $eventData,
                'userList' => $userList,
                'andereKontakte' => $andereKontakte,
                'besteKontakte' => $besteKontakte,
                'BeziehungsWertMax' => $BeziehungsWertMax,
                'comparator' =>  $comparator
            ];
            return view('Events.Teilnehmer_Hinzufuegen',$daten);
        }else{
            header("Location: /");
        }
    }
}
