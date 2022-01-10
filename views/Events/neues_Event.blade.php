
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Neuer Kontakt</title>
    <meta charset="UTF-8">


    <link rel="stylesheet"  href="../css/Events_planen.css">
    <link rel="stylesheet"  href="../css/neues_event.css">
    <link rel="stylesheet" href="../css/logo-swe.css">


</head>
<body>
<a href="/"><img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo"></a>

<header id="header">
    <ul>
        <li> <a href="/" class="active"> <img src="../img/home0.png" width="25" height="25"> </a></li>
        <li> <a href="/Events_planen">Events planen</a></li>
        <li><a href="/Profil" >Profil</a></li>
        <li> <a href="/Neuer_Kontakt">Neuer Kontakt</a></li>
        <li><a href="/abmeldung">Abmelden</a></li>


    </ul>
</header>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

<div class="container">
    <div class="main-body">
    <form id="contact" action="/event_hinzufuegen" method="post" enctype="multipart/form-data">
        <h3>Neues Event</h3>
        <div class="form__input-error-message">@if(isset($resultatfehler)){{$resultatfehler}} @endif</div>
        <div class="form__message form__message--success">@if(isset($resultatok)){{$resultatok}} @endif</div>
        <fieldset>
            <input  type="text" name="Eventname" required autofocus placeholder="Eventname">
        </fieldset>
        <fieldset>
            <label for="date"> Datum: </label>
            <input id="date" type="date" name="date">
        </fieldset>
        <fieldset>
            <label for="time"> Uhrzeit: </label>
            <input id ="time"    type="time" name="time">
        </fieldset>
        <fieldset>
            <button name="submit" type="submit">Event speichern</button>
        </fieldset>
        <input type="hidden" name="submitted" value="1" >

        <label>Teilnehmer Liste:</label>
        <div id="teilnehmer">
        </div>
        <button name="submit" type="submit">Neuen Teilnehmer hinzufügen</button>
        <button name="submit" type="submit">Ausgewählten Teilnehmer entfernen</button>
    </form>
        <form id="contact" action="/Events_planen" method="post">
            <button name="submit" type="submit">Abbrechen</button>

        </form>
    </div>

</div>





</body>
</html>