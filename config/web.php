<?php
session_start();

return array(


    '/'                                      =>       'IndexController@index',
    '/Neuer_Kontakt'             =>       'IndexController@Neuer_Kontakt',
    '/kontakt_hinzufuegen'                   =>       'kontakt_hinzufuegenController@kontakt_hinzufuegen',

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