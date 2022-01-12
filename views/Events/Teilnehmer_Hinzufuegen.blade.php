<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teilnehmer Hinzufuegen</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/teilnehmerliste.css">

</head>
<body>

<a href="/"><img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo"></a>
<header >
    <ul>
        <li> <a href="/" class="active"> <img src="../img/home0.png" width="25" height="25"> </a></li>
        <li> <a href="/Events_planen">Events planen</a></li>
        <li><a href="/Profil" >Profil</a></li>
        <li> <a href="/Neuer_Kontakt">Neuer Kontakt</a></li>
        <li><a href="/abmeldung">Abmelden</a></li>


    </ul>
</header>
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <h3>neuen Teilnehmer zu <b>{{$eventData['eventname']}}</b> hinzufuegen</h3>
                    <form method="Post" action="/Kontakt_suchen_fuer_auswahl">
                        <span><b>Suche nach</b></span>
                        <input type="hidden" name="eventId" value="{{$eventData['id']}}">
                        <input id="vorname" name="wahl" type="radio" value="1" checked>
                        <label for="vorname">Vorname</label>
                        <input id="nachname" name="wahl" type="radio" value="2">
                        <label for="nachname">Nachname</label>
                        <input id="tag" name="wahl" type="radio" value="3">
                        <label for="tag">Tag</label>
                        <input id="search_text" type="text" name="search_text" value="{{$search_text=''}}">
                        <input type="submit" value="Suchen">
                        <input type="hidden" name="submitted" value="1" >
                    </form>
                    <div class="float-container">
                            <div class="float-child"><form method="post" action="/Kontakt_auswaehlen">
                                    <b>Kontaktliste:</b><br>
                                <select id="nichtTeilnehmerListeKontakt" name="kontaktID" size="4" onchange="document.getElementById('outputName').text = document.getElementById('nichtTeilnehmerListeKontakt').options[document.getElementById('nichtTeilnehmerListeKontakt').selectedIndex].text;">
                                    @foreach($andereKontakte as $value)
                                        @if($value['id'] !== $kontakt['id'])
                                            <option value="{{$value['id']}}"> {{$value['vorname']}} {{$value['nachname']}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="row">
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" name="submit" class="btn btn-primary px-4">Auswählen</button>
                                        <input type="hidden" name="eventId" value="{{$eventData['id']}}">
                                        <input type="hidden" name="sus_kontakt" value="{{$kontakt['id']}}">
                                    </div>
                                </div>
                            </form>
                            </div>
                        <div id="float-child">
                            <b>5/5:</b>
                            <form method="post" action="/Kontakt_auswaehlen">
                                <select id="nichtTeilnehmerListeKontakt" name="kontaktID" size="4" onchange="document.getElementById('outputName').text = document.getElementById('nichtTeilnehmerListeKontakt').options[document.getElementById('nichtTeilnehmerListeKontakt').selectedIndex].text;">
                                    @foreach($besteKontakte as $value)
                                        @if($value['id'] !== $kontakt['id'])
                                            <option value="{{$value['id']}}"> {{$value['vorname']}} {{$value['nachname']}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="row">
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" name="submit" class="btn btn-primary px-4">Auswählen</button>
                                        <input type="hidden" name="eventId" value="{{$eventData['id']}}">
                                        <input type="hidden" name="sus_kontakt" value="{{$kontakt['id']}}">
                                    </div>
                                </div>
                            </form></div>
                            @if( isset($ausgewaehtlerKontakt['vorname']) & isset($KontaktBeziehung['Durchschnitt']))
                            <h5>Ausgewählter Kontakt:{{$ausgewaehtlerKontakt['vorname']}} {{$ausgewaehtlerKontakt['nachname']}}</h5>
                            <div>   Durchschnittliche Beziehung zu Teilnehmern: {{$KontaktBeziehung['Durchschnitt']}}/5<br>
                                    Beste Beziehung zu: {{$KontaktBeziehung['besteName']}} <br>
                                    mit:                {{$KontaktBeziehung['besteWertung']}} /5<br>
                                    schlechteste Beziehung zu: {{$KontaktBeziehung['schlechtesteName']}} <br>
                                    mit: {{$KontaktBeziehung['schlechtesteWertung']}} /5<br>
                                <form method="post" action="/Ausgewaehlten_Kontakt_Hinzufuegen">
                                <input type="hidden" name="kontaktID" value="{{$ausgewaehtlerKontakt['id']}}">
                                    <input type="hidden" name="eventId" value="{{$eventData['id']}}">
                                    <button type="submit">Kontakt Hinzufügen</button>
                                </form>
                            </div> @else Wählen Sie einen Kontakt aus @endif
                    </div>
                    <form id="contact" action="/Event_bearbeiten" method="post">
                        <input type="hidden" name="eventId" value="{{$eventData['id']}}">
                        <button class="btn btn-primary px-4" name="submit" type="submit">Zurück zum Event</button>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
