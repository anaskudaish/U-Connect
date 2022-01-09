
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Neuer Kontakt</title>
    <meta charset="UTF-8">


    <link rel="stylesheet"  href="../css/kontakt_hinzufuegen.css">
    <link rel="stylesheet" href="../css/logo-swe.css">

</head>
<body>
<a href="/"><img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo"></a>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

<div class="container">

    <form id="contact" action="/kontakt_hinzufuegen" method="post" enctype="multipart/form-data">
        <h3>Neuer Kontakt</h3>
        <div class="form__input-error-message">@if(isset($resultatfehler)){{$resultatfehler}} @endif</div>
        <div class="form__message form__message--success">@if(isset($resultatok)){{$resultatok}} @endif</div>


        <fieldset>
            <input  type="text" name="vorname" required autofocus placeholder="Vorname">
            <input  type="text" name="nachname"  placeholder="Nachname">
        </fieldset>
        <fieldset>
            <input  type="tel" name="telefonnummer" placeholder="Telefonnummer">
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
               @foreach(array_slice($tags,0,5) as $value)
                <input type="checkbox" name="tags[]" id="{{$value}}" value="{{$value}}"> <label for="{{$value}}">{{$value}}</label>
                @endforeach
            @endif

                @if(isset($tags))
                    <input type='text' oninput='onInput()' id='input'  list='dlist' placeholder="Vorhandene Tags durchsuchen" class="textDatalist" style="width: 300px; height: 20px;margin: 10px;"/>
                    <datalist id='dlist'>
                @foreach($tags as $value)
                            <option value='{{$value}}'>{{$value}}</option>
                @endforeach
                    </datalist>
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

    <fieldset>
        <form  method="post" action="\beziehungenVerwalten" >
            <button name="submit" type="submit" value="Beziehungen ">Beziehungen verwalten</button>
            <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
            <input type="hidden" name="beziehungen" value="1" >
        </form>
    </fieldset>

    <form id="contact" action="/" method="post">
        <button name="submit" type="submit">Abbrechen</button>

    </form>

</div>
<script>
    function onInput() {
        var val = document.getElementById("input").value;
        var opts = document.getElementById('dlist').childNodes;
        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === val) {
                if(document.getElementsByName('neu_tag')[0].value.slice(-1) == ',' || document.getElementsByName('neu_tag')[0].value.slice(-1) == '')
                    document.getElementsByName('neu_tag')[0].value += opts[i].value;
                else
                    document.getElementsByName('neu_tag')[0].value += "," + opts[i].value;
                document.getElementById("input").value = "";
                break;
            }
        }
    }
</script>
</body>
</html>
