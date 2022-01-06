<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hauptseite</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/logo-swe.css">


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
        <a href="/Events_planen">Events planen</a>
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
                    <div class="flip-card-container" style="--hue: 170">
                        <div class="flip-card">

                            <div class="card-front">
                                <figure>
                                    <div class="img-bg"></div>
                                    <img src="../img/{{$value['bildname']}}" alt="Image 2">
                                    <figcaption>{{$value['vorname'] .' ' .$value['nachname']}}</figcaption>
                                </figure>

                                <ul>
                                    @if(!empty($value['geburtsdatum']))<li>{{$value['geburtsdatum']}}</li>@endif
                                    @if(!empty($value['stadt']))<li>{{$value['stadt']}}</li>@endif
                                        @if(!empty($value['land']))<li>{{$value['land']}}</li>@endif
                                </ul>
                            </div>

                            <div class="card-back">
                                <figure>
                                    <div class="img-bg"></div>
                                    <img src="../img/{{$value['bildname']}}" alt="image-2">
                                </figure>
                                <form method="post" action="/kontakt">
                                <button type="submit">Anzeigen</button>
                                    <input type="hidden" name="id_kontakt" value="{{$value['id']}}">

                                    <input type="hidden" name="submitted" value="1" >
                                </form>
                                <div class="design-container">
                                    <span class="design design--1"></span>
                                    <span class="design design--2"></span>
                                    <span class="design design--3"></span>
                                    <span class="design design--4"></span>
                                    <span class="design design--5"></span>
                                    <span class="design design--6"></span>
                                    <span class="design design--7"></span>
                                    <span class="design design--8"></span>
                                </div>
                            </div>

                        </div>
                    </div>
            @endforeach
            @else <div style="width: 60px; background-color: #00b5ad; color: green; border: 2px solid #999;" class="container">

                <a href="/Neuer_Kontakt" class="text-light"> <p>Sie haben noch keine Kontakte!</p> Zum hinzufügen einfach klicken...</a>
          </div>
            @endif
        </div>
    </div>
</div>


</body>



</html>
