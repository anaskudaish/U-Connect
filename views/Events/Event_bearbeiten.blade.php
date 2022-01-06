<!DOCTYPE html>
<html lang="de">
<head>
    <title>Event Bearbeiten</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/logo-swe.css">
    <link rel="stylesheet"  href="../css/Events_planen.css">
    <link rel="stylesheet"  href="../css/neues_event.css">
</head>
<a href="/"><img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo"></a>
<body>
<div class="container">
    <div class="main-body">
        <form id="contact" action="/Event_bearbeiten" method="post">
            <h3>Event Bearbeiten</h3>
            <div class="form__input-error-message">@if(isset($resultatfehler)){{$resultatfehler}} @endif</div>
            <div class="form__message form__message--success">@if(isset($resultatok)){{$resultatok}} @endif</div>
            <fieldset>
                <input  type="text" name="Eventname" required autofocus value="{{$eventData['eventname']}}">
            </fieldset>
            <fieldset>
                <label for="date"> Datum: </label>
                <input id="date" type="date" name="date" value="{{$eventData['Datum']}}">
            </fieldset>
            <fieldset>
                <label for="time"> Uhrzeit: </label>
                <input id ="time"    type="time" name="time" value="{{$eventData['Uhrzeit']}}">
            </fieldset>
            <fieldset>
                <button name="submit" type="submit">Event speichern</button>
            </fieldset>
            <input type="hidden" name="submitted" value="1" >
            <input type="hidden" name="eventId" value={{$eventData['id']}} >
        </form>
            <form id="contact" action="/Teilnehmer_Entfernen" method="post">
                <label>Teilnehmer Liste:</label>
                <div id="teilnehmer">
                    @if(!empty($userList)) <? $i = 0; ?>
                        <select name="TeilnehmerID" size="10" width="100" style="width: 100px">
                            @foreach($userList as $value)
                                <option style="border: 100px" id="kontaktInEvent" value="{{$value['id']}}">{{$value['vorname'] }} {{$value['nachname'] }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <button name="submit" type="submit">Ausgewählten Teilnehmer entfernen</button>
                <input type="hidden" name="eventID" value={{$eventData['id']}} >
            </form>
        <form id="contact" action="/Teilnehmer_Hinzufuegen" method="post">
            <button name="submit" type="submit">Neuen Teilnehmer hinzufügen</button>
            <input type="hidden" name="eventId" value={{$eventData['id']}} >
        </form>
            <form id="contact" action="/Events_planen" method="post">
                <!--<button name="submit" type="submit">Abbrechen</button> -->
            </form>
</div>
</div>
</body>
</html>
