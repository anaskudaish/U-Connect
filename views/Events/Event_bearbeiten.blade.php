<!DOCTYPE html>
<html lang="de">
<head>
    <title>Event Bearbeiten</title>
    <meta charset="UTF-8">


    <link rel="stylesheet"  href="../css/Events_planen.css">
    <link rel="stylesheet"  href="../css/neues_event.css">


</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

<a href="/Events_planen" class="previous">&laquo;Events planen</a>
<div class="container">
    <div class="main-body">
        <form id="contact" action="/event_hinzufuegen" method="post" enctype="multipart/form-data">
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

            <label>Teilnehmer Liste:</label>
            <div id="teilnehmer">
                @if(!empty($userList))
                    <select name="test" size="10">
                    @foreach($userList as $value)
                        <option id="kontaktInEvent">{{$value['vorname'] }}</option>
                    @endforeach
                    </select>
                @endif
            </div>
            <button name="submit" type="submit">Neuen Teilnehmer hinzufügen</button>
            <button name="submit" type="submit">Ausgewählten Teilnehmer entfernen</button>
        </form>
    </div>
</div>
</body>
</html>