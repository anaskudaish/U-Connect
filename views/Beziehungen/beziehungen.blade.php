<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beziehungen verwalten</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/beziehungen.css">

</head>
<?php
$kontakt['id'] = $_POST['id_kontakt'];

echo '<pre>';
//var_dump($test_result2);
echo '</pre>';
echo '<pre>';
//var_dump($names2);
echo '</pre>';
?>
@if($_POST['beziehungen_verwalten'] == 1)
<div>
    <form method="post" action="/kontakt">
        <input type="submit" name="zurück" class="btn btn-primary px-4" value="Zurück">
        <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
        <input type="hidden" name="submitted" value="1" >
    </form>
</div>
@else
<div class="col-sm-9 text-secondary">
    <form  method="post" action="/kontakt_bearbeiten" >
        <input type="submit" name="submit" class="btn btn-primary px-4" value="Zurück">
        <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
        <input type="hidden" name="bearbeiten" value="1" >
    </form>
</div>
@endif
<body>

<a href="/"><img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo"></a>

<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <h2>Beziehungen Verwalten von {{$kontakt_wo_beziehungen_bearebitet_werden['vorname']}} {{$kontakt_wo_beziehungen_bearebitet_werden['nachname']}}</h2>
                    <div class="card-body">

                        <div class="first">
                                <label for="Beziehungen"><h5>Vorhandene Beziehungen</h5></label>
                                <select id="Beziehungen" name="beziehungen_zu_id" size="8" onchange="document.getElementById('editR').text = document.getElementById('Beziehungen').options[document.getElementById('Beziehungen').selectedIndex].text.slice(0,-2);">
                                    @foreach($test_result2 as $key)
                                        <option value="{{$key['id_beziehung']}}" >{{$key['vorname']}} {{$key['nachname']}} {{$key['Beziehungs_wert']}} </option>
                                    @endforeach
                                    {{--<script>document.getElementById('Beziehungen').size = document.getElementById('Beziehungen').length;</script>--}}
                                </select>
                            {{--<form id="auswahl" method="post" action="/beziehungenVerwalten" onsubmit="document.getElementById('auswahl')['beziehung_zu'].value = document.getElementById('Beziehungen').value;">
                           <div class="row">
                               <div class="col-sm-9 text-secondary">
                                   <input type="submit" name="submit" class="btn btn-primary px-4" value="Auswählen">
                                   <input type="hidden" name="submitted" value="1" >
                                   <input type="hidden" name="beziehung_zu" value="" >
                                   <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                    </div>
                                </div>
                            </form>--}}
                        </div>

                        {{--var_dump($kontakt_bearbeiten)--}}
                        <div class="second">
                            <h5>Beziehung zu @if(isset($_POST['beziehungen_zu_id'])) {{$kontakt_bearbeiten[0]['vorname'] . ' ' . $kontakt_bearbeiten[0]['nachname']}} @else {!! '<a id=\'editR\'>...</a>'!!} @endif bearbeiten</h5>
                            <form id="update" method="post" action="/beziehungenVerwalten" oninput="numerisch.value=update_entfernen.value" onsubmit="document.getElementById('update')['beziehung_zu'].value = document.getElementById('Beziehungen').value;">

                                <input type="range" name="update_entfernen" min="-5" max="5" value="0" >
                                Punkte: <output name="numerisch">0</output>

                                <input type="submit" name="submit_update" class="btn btn-primary px-4" value="Update">
                                <input type="submit" name="submit_entfernen" class="btn btn-primary px-4" value="Entfernen">
                                <input type="hidden" name="beziehung_zu" value="">
                                <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                            </form>
                        </div>



                        <div class="third">
                            @if(!empty($kontakte) || !empty($resultat))
                            <form method="Post" action="/beziehungenVerwalten">

                                <label for="search_text"><h5>Kontakt suchen</h5></label><br>
                                <input id="vorname" name="wahl" type="radio" value="1" checked <?php if(isset($_POST['wahl']) && $_POST['wahl'] == 1) echo "checked" ?> >
                                <label for="vorname">Vorname</label>
                                <input id="nachname" name="wahl" type="radio" value="2" <?php if(isset($_POST['wahl']) && $_POST['wahl'] == 2) echo "checked" ?>>
                                <label for="nachname">Nachname</label>
                                <input id="tag" name="wahl" type="radio" value="3" <?php if(isset($_POST['wahl']) && $_POST['wahl'] == 3) echo "checked" ?>>
                                <label for="tag">Tag</label>
                                <input id="search_text" type="text" name="search_text" value="{{$search_text}}">   <!-- hidden value="<?php $_GET['search_text']; ?> -->
                                <input type="submit" value="Suchen" class="btn btn-primary px-4">
                                <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                <input type="hidden" name="submitted" value="5" >

                            </form>
                            @endif



                                <form method="post" action="/beziehungenVerwalten">

                                    <select id="beziehungen_hinzufügen" name="beziehungen_hinzufügen" size="4" onchange="document.getElementById('outputName').text = document.getElementById('beziehungen_hinzufügen').options[document.getElementById('beziehungen_hinzufügen').selectedIndex].text;">
                                        @foreach($kontakte as $value)
                                            @if($value['id'] !== $kontakt['id'])
                                                <option value="{{$value['id']}}"> {{$value['vorname']}} {{$value['nachname']}} </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {{--<div class="row">
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" name="submit" class="btn btn-primary px-4" value="Auswählen">
                                            <input type="hidden" name="submitted" value="1" >
                                            <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                        </div>
                                    </div> --}}

                                </form>


                                {{--@if($kontakt['id'] !== $kontakt_hinzufügen[0]['id']) {{'test'}} @else {{'Bitte einen anderen Kontakt auswählen'}} @endif--}}
                                <h5>Beziehung Hinzufügen von {{$kontakt_wo_beziehungen_bearebitet_werden['vorname']}} {{$kontakt_wo_beziehungen_bearebitet_werden['nachname']}} zu: @if(isset($_POST['beziehungen_hinzufügen']) && isset($kontakt_hinzufügen[0])){{$kontakt_hinzufügen[0]['vorname'] . '  ' . $kontakt_hinzufügen[0]['nachname']}} @else {!! '<a id=\'outputName\'>...</a>' !!} @endif</h5>

                                <form id="addRelationship" method="post" action="/beziehungenVerwalten"  oninput="numerisch.value=bewertung.value" onsubmit="document.getElementById('addRelationship')['beziehungen_hinzufügen'].value = document.getElementById('beziehungen_hinzufügen').value;">

                                    <input type="range" name="bewertung" min="-5" max="5" value="0" >
                                    Punkte: <output name="numerisch">0</output>

                                    <input type="hidden" name="beziehungen_hinzufügen" value="">
                                    <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                    <input type="submit" name="submit" class="btn btn-primary px-4" value="Speichern">
                                </form>

{{-- <form method="Post" action="/kontakt">

    <input type="submit" value="Abbrechen" class="btn btn-primary px-4">
    <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
    <input type="hidden" name="submitted" value="1" >

</form>--}}

</div>
</div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>