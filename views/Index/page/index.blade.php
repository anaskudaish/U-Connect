<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hauptseite</title>
    <link rel="stylesheet" href="../css/index.css">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<a href="/"><img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo"></a>
<nav>
    <div class="navicon">
        <div></div>
    </div>
    <div class="dropdown-content">
        <a href="/" class="active"> <img src="../img/home.png" width="25" height="25"> </a>
        <a href="/Events_planen">Event erstellen</a>
        <a href="/Profil" >Profil</a>
        <a href="/Neuer_Kontakt">Neuer Kontakt</a>
        <a href="/abmeldung">Abmelden</a>
    </div>

</nav>

<div class="container">
    @if(!empty($kontakte) || !empty($resultat))
        <p class="result">@if(!empty($resultat)){{$resultat}} @endif</p>
        <div class="search">
        <form method="Post" action="/kontakt_suchen">
            <span><b>Suche nach</b></span>
            <input id="vorname" name="wahl" type="radio" value="1" checked>
            <label for="vorname">Vorname</label>
            <input id="nachname" name="wahl" type="radio" value="2">
            <label for="nachname">Nachname</label>
            <input id="tag" name="wahl" type="radio" value="3">
            <label for="tag">Tag</label>
            <input id="search_text" type="text" name="search_text" value="{{$search_text}}">
            <input type="submit" value="Suchen">
            <input type="hidden" name="submitted" value="1" >
        </form>
    @endif
        </div>
    <div class="main-body">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 gutters-sm">


            @if(!empty($kontakte))
            @foreach($kontakte as $value)
            <div class="col mb-3">
                <div class="card">
                    <img src="../img/{{$value['bildname']}}" alt="Cover" class="card-img-top">
                    <div class="card-body text-center">
                        <form method="post" action="/kontakt">
                      <button type="submit" class="btn btn-light btn-sm bg-white has-icon btn-block"><h5 class="card-title">{{$value['vorname'] .' ' .$value['nachname']}}</h5></button>
                        <input type="hidden" name="id_kontakt" value="{{$value['id']}}">

                        <input type="hidden" name="submitted" value="1" >
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>


</body>



</html>
