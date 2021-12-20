<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teilnehmer Hinzufuegen</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/beziehungen.css">

</head>
<body>
<?php
$kontakt['id'] = $_POST['id_kontakt'];

echo '<pre>';
//var_dump($test_result2);
echo '</pre>';
echo '<pre>';
//var_dump($names2);
echo '</pre>';
?>
<a href="/"><img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo"></a>

<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <h3>neuen Teilnehmer zu <b>{{$eventData['eventname']}}</b> hinzufuegen</h3>
                    <label>Kontaktliste:</label>
                    <div id="teilnehmer">
                            <form method="post" action="/">
                                <select id="nichtTeilnehmerListeKontakt" name="nichtTeilnehmerListeKontakt" size="4" onchange="document.getElementById('outputName').text = document.getElementById('nichtTeilnehmerListeKontakt').options[document.getElementById('nichtTeilnehmerListeKontakt').selectedIndex].text;">
                                    @foreach($andereKontakte as $value)
                                        @if($value['id'] !== $kontakt['id'])
                                            <option value="{{$value['id']}}"> {{$value['vorname']}} {{$value['nachname']}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="row">
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" name="submit" class="btn btn-primary px-4" value="Auswählen">
                                        <input type="hidden" name="submitted" value="1" >
                                        <input type="hidden" name="eventId" value="{{$eventData['id']}}">
                                        <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                    </div>
                                </div>

                            </form>
                            <h5>Ausgewählter Kontakt:@if(isset($_POST['nichtTeilnehmerListeKontakt']) && isset($kontakt_hinzufügen[0])){{$kontakt_hinzufügen[0]['vorname'] . '  ' . $kontakt_hinzufügen[0]['nachname']}} @else {!! '<a id=\'outputName\'>...</a>' !!} @endif</h5>


                    </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>