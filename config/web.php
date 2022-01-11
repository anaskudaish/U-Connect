<?php
session_start();

return array(


    '/'                                      =>       'IndexController@index',
    '/Neuer_Kontakt'             =>       'IndexController@Neuer_Kontakt',
    '/kontakt_hinzufuegen'                   =>       'kontakt_hinzufuegenController@kontakt_hinzufuegen',
    '/kontakt'                      =>     'IndexController@kontakt',
    '/kontakt_bearbeiten'                      =>     'IndexController@kontakt_bearbeiten',
    '/kontakt_suchen'                                      =>       'IndexController@kontakt_suchen',

    '/Events_planen'                           =>     'EventController@Events_planen',
    '/Event_bearbeiten'                           =>     'EventController@Event_bearbeiten',
    '/neues_Event'                           =>     'EventController@neues_Event',
    '/event_hinzufuegen'                     =>     'EventController@event_hinzufuegen',
    '/Teilnehmer_Hinzufuegen'                 => 'EventController@Teilnehmer_Hinzufuegen',
    '/Ausgewaehlten_Kontakt_Hinzufuegen' => 'EventController@Ausgewaehlten_Kontakt_Hinzufuegen',
    '/Kontakt_auswaehlen'                => 'EventController@Kontakt_auswaehlen',
    '/Kontakt_suchen_fuer_auswahl' => 'EventController@Kontakt_suchen_fuer_auswahl',
    '/Teilnehmer_Entfernen'                 => 'EventController@Teilnehmer_Entfernen',

    '/beziehungenVerwalten'                =>      'BeziehungenController@beziehungenVerwalten',
    '/beziehungenhinzufuegen'                =>      'BeziehungenController@beziehungen_hinzufuegen',

    '/kontakt_loeschen'                     =>     'IndexController@kontakt_loeschen',

    '/anmeldung'                             =>       'AnmeldungController@anmeldung',
    '/anmeldung_verifizierung'               =>       'AnmeldungController@anmeldung_verifizierung',
    '/passwort_zuruecksetzen'                =>        'Passwoert_ZuruecksetzenController@passwort_zuruecksetzen',
    '/passwort_zuruecksetzen_verifizierung'  =>         'Passwoert_ZuruecksetzenController@passwort_zuruecksetzen_verifizierung',

    '/Profil'                                =>       'IndexController@Profil',
    '/profil_update'                     =>       'ProfilController@profil_update',

    '/abmeldung'                         =>       'AbmeldungController@abmeldung',

    '/registrierung'                     =>      'RegistrierungController@registrierung',
    '/registrierung_verifizierung'       =>      'RegistrierungController@registrierung_verifizierung',
    '/bestaetigung_code'                 =>      'RegistrierungController@bestaetigung_code',
    '/bestaetigung_code_verifizierung'   =>      'RegistrierungController@bestaetigung_code_verifizierung',
    '/neuer_code'                        =>      'RegistrierungController@neuer_code',

    '/passwort_vergessen'                =>    'Passwort_VergessenController@passwort_vergessen',
    '/passwort_vergessen_verifizierung'  =>  'Passwort_VergessenController@passwort_vergessen_verifizierung'
);
