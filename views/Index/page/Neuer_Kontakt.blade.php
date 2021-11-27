
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Neuer Kontakt</title>
    <meta charset="UTF-8">


    <link rel="stylesheet"  href="../css/kontakt_hinzufuegen.css">


</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

<a href="/" class="previous">&laquo; Hauptseite</a>
<div class="container">

    <form id="contact" action="/kontakt_hinzufuegen" method="post" enctype="multipart/form-data">
        <h3>Neuer Kontakt</h3>
        <div class="form__input-error-message">@if(isset($resultatfehler)){{$resultatfehler}} @endif</div>
        <div class="form__message form__message--success">@if(isset($resultatok)){{$resultatok}} @endif</div>


        <fieldset>
            <input  type="text" name="vorname" required autofocus placeholder="Vorname">
            <input  type="text" name="nachname" required autofocus placeholder="Nachname">
        </fieldset>
        <fieldset>
            <input  type="tel" name="telefonnummer" required placeholder="Telefonnummer">
        </fieldset>

        <fieldset>
            <input type="url" name="instagram"  placeholder="Instagram Link" >
            <input type="url" name="facebook"  placeholder="Facebook Link" >
            <input type="url" name="twitter"  placeholder="Twitter Link" >
        </fieldset>
        <fieldset>
            <input type="text" name="strasse"  placeholder="Straße" >
            <input type="text" name="plz"  placeholder="PLZ" >
            <input type="text" name="stadt"  placeholder="Stadt" >
            <input type="text" name="land"  placeholder="Land" >
        </fieldset>
        <fieldset>
            <textarea  name="textfeld" placeholder="Textfeld"></textarea>
        </fieldset>
        <fieldset  class="tags">
            @if(isset($tags))<p>Vorhandene Tags</p>
               @foreach($tags as $value)
                <input type="checkbox" name="tags[]" id="{{$value}}" value="{{$value}}"> <label for="{{$value}}">{{$value}}</label>
                @endforeach
            @endif

            <input  type="text" name="neu_tag"  autofocus placeholder="Neue Tags">

        </fieldset>
        <fieldset>
            <label for="Geburtsdatum"> Geburtsdatum : </label>
            <input id="Geburtsdatum" type="date" name="geburtsdatum">

        </fieldset>
        <fieldset>

            <label for="Interval"> Erinnerungsinterval : </label>
            <select id="Interval" name="erinnerungsinterval">
                <option value="1 Day">  Tag     </option>
                <option value="3 Day">  3 Tage   </option>
                <option value="1 week"> Woche   </option>
                <option value="2 week"> 2 Wochen </option>
                <option value="1 month"> Monat  </option>
                <option value="3 month"> 3 Monate </option>
                <option value="6 month"> 6 Monate </option>
                <option value="9 month"> 9 Monate </option>
                <option value="1 year" selected> Jahr</option>
            </select>
        </fieldset>
        <fieldset>
            <label for="Bild"> Bild : </label>
            <input id="Bild" type="file" name="bild">
        </fieldset>
        <fieldset>
            <button name="submit" type="submit">Speichern</button>
        </fieldset>
        <input type="hidden" name="submitted" value="1" >
    </form>


</div>

</body>
</html>