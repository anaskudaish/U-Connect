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
<body>
<a href="/" class="previous">&laquo; Hauptseite</a>

<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <h2>Beziehungen Verwalten</h2>
                    <div class="card-body">

                        <div class="first">
                            <form method="Post" action="">
                                <label for="Beziehungen"><h5>Vorhandene Beziehungen</h5></label>
                                <select id="Beziehungen" name="beziehungen_zu_id" multiple="multiple">
                                    @foreach($names as $key)
                                        <option value="{{$key['id']}}" >  {{$key['vorname']}}  {{$key['nachname']}} </option>
                                    @endforeach
                                </select>
                                <div class="row">
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" name="submit" class="btn btn-primary px-4" value="Auswählen">
                                        <input type="hidden" name="submitted" value="1" >
                                        <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{$kontakt_bearebiten['vorname']}}

                        @foreach($kontakt_bearebiten as $key)
                            {{$key['vorname']}}
                        @endforeach
                        <div class="second">
                            <h5>Beziehung zu @if(isset($_POST['beziehungen_zu_id'])) {{$kontakt_bearebiten['vorname']}} @else {{'...'}} @endif bearbeiten</h5>
                            <form oninput="numerisch.value=auswertung.value">
                                <input type="range" name="auswertung" min="-5" max="5" value="0" >
                                Punkte: <output name="numerisch">0</output>
                                <input type="submit" name="submit" class="btn btn-primary px-4" value="Update">
                                <input type="submit" name="submit" class="btn btn-primary px-4" value="Entfernen">
                            </form>
                        </div>



                        <div class="third">
                            @if(!empty($kontakte) || !empty($resultat))
                            <form method="Post" action="/beziehungenVerwalten">
                                <label for="search_text"><h5>Kontakt suchen</h5></label><br>
                                <input id="search_text" type="text" name="search_text" value="{{$search_text}}">   <!-- hidden value="<?php $_GET['search_text']; ?> -->
                                <input type="submit" value="Suchen" class="btn btn-primary px-4">
                            </form>
                            @endif



                            <select id="Beziehungen" name="beziehungen" multiple="multiple">
                                @foreach($kontakte as $value)
                                    <option value="{{$value['id']}}" >  {{$value['vorname']}}  {{$value['nachname']}} </option>
                                @endforeach
                            </select>



                            <h5>Beziehung Hinzufügen von: </h5>
                            <form method="Post" action="" oninput="numerisch.value=auswertung.value">
                                <input type="range" name="auswertung" min="-5" max="5" value="0" >
                                Punkte: <output name="numerisch">0</output>
                                <input type="submit" name="submit" class="btn btn-primary px-4" value="Speichern">
                            </form>
                        </div>

                        <form method="post" action="" method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" name="submit" class="btn btn-primary px-4" value="Speichern">
                                    <input type="hidden" name="submitted" value="1" >
                                    <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>