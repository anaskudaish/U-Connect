<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kontakt</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/kontakt.css">
        <link rel="stylesheet" href="../css/logo-swe.css">


</head>
<body>
<a href="/"><img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo"></a>

<header>
    <ul>
        <li> <a href="/" class="active"> <img src="../img/home0.png" width="25" height="25"> </a></li>
        <li> <a href="/Events_planen">Events planen</a></li>
        <li><a href="/Profil" >Profil</a></li>
        <li> <a href="/Neuer_Kontakt">Neuer Kontakt</a></li>
        <li><a href="/abmeldung">Abmelden</a></li>


    </ul>
</header>

    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="../img/{{$kontakt['bildname']}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="210">
                            </div>
                           <h3 class="card-title">{{$kontakt['vorname'] . ' ' . $kontakt['nachname']}}</h3>
                            <hr class="my-4">

                            <ul class="list-group list-group-flush">
                                @if(!empty($kontakt['instagram']))
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg><a href="{{$kontakt['instagram']}}" target="_blank">Instagram</a></h6>
                                    </li>
                                @endif
                                @if(!empty($kontakt['facebook']))
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg><a href="{{$kontakt['facebook']}}" target="_blank">Facebook</a></h6>

                                    </li>
                                @endif
                                @if(!empty($kontakt['twitter']))
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg><a href="{{$kontakt['twitter']}}" target="_blank">Twitter</a></h6>
                                    </li>
                                @endif
                                @if(!empty($kontakt['url']))
                                    @foreach(explode(",",$kontakt['url']) as $key)
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 -32 576 576" fill="black" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M288 32Q350 32 402 63 453 93 483 145 512 196 512 256 512 318 482 370 451 421 400 451 348 480 288 480 226 480 175 450 123 419 94 368 64 316 64 256 64 194 95 143 125 91 177 62 228 32 288 32ZM272 83Q235 95 218 151 245 158 272 160L272 83ZM304 160Q331 158 358 151 341 95 304 83L304 160ZM367 98Q380 118 387 141 403 133 411 128 392 111 367 98ZM189 141Q197 117 209 98 185 110 166 129L189 141ZM463 240Q460 193 432 153 412 166 396 172 403 205 404 240L463 240ZM180 172Q165 166 145 153 118 191 113 240L172 240Q173 205 180 172ZM272 192Q238 189 210 182 205 208 204 240L272 240 272 192ZM372 240Q371 208 366 182 338 189 304 192L304 240 372 240ZM113 272Q118 321 145 359 159 349 180 340 173 307 172 272L113 272ZM204 272Q205 304 210 330 238 323 272 320L272 272 204 272ZM304 320Q338 323 366 330 371 304 372 272L304 272 304 320ZM396 340Q411 346 431 359 458 321 463 272L404 272Q403 307 396 340ZM304 429Q341 417 358 361 331 354 304 352L304 429ZM272 352Q245 354 218 361 235 417 272 429L272 352ZM189 371Q176 376 166 383 185 401 208 413 195 391 189 371ZM387 371Q380 394 367 413 390 403 410 383L387 371Z"></path></svg><a href="{{$key}}" target="_blank">{{parse_url($key)['host']}}</a></h6>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telefonnummer :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <a href="tel:{{$kontakt['telefonnummer']}}">{{$kontakt['telefonnummer']}}</a>
                                </div>
                            </div>
                            <br>

                            @if(!empty($kontakt['geburtsdatum']))
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Geburtsdatum</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div>{{$kontakt['geburtsdatum']}}</div>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($kontakt['alter']))
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Alter</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div>{{$kontakt['alter']}} Jahre alte</div>
                                    </div>
                                </div>
                            @endif
                            <br>


                            @if(!empty($kontakt['strasse']))
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Straße</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div>{{$kontakt['strasse']}}</div>
                                </div>
                            </div>
                            @endif

                            @if(!empty($kontakt['plz']))
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">PLZ</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div>{{$kontakt['plz']}}</div>
                                </div>
                            </div>
                            @endif

                            @if(!empty($kontakt['stadt']))
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Stadt</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div>{{$kontakt['stadt']}}</div>

                                </div>
                            </div>
                            @endif

                            @if(!empty($kontakt['land']))
                                <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Land</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div>{{$kontakt['land']}}</div>

                                </div>
                            </div>
                            @endif

                            @if(!empty($kontakt['tags']))
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tags</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div>{{str_replace(",",", ",$kontakt['tags'])}}</div>

                                    </div>
                                </div>
                            @endif

                            @if(!empty($kontakt['textfeld']))
                                <br>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Textfeld</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div>{{$kontakt['textfeld']}}</div>
                                    </div>
                                </div>
                            @endif

                            @if(!empty($kontakt['erinnerungsinterval']))

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Erinnerungsinterval</h6>
                                </div>

                                <div class="col-sm-9 text-secondary">

                                        @if($kontakt['erinnerungsinterval']=="1 Day") <div>  Täglich  </div>@endif
                                            @if($kontakt['erinnerungsinterval']=="3 Day") <div>   Alle 3 Tage  </div>@endif
                                            @if($kontakt['erinnerungsinterval']=="1 week") <div>   Wöchentlich  </div>@endif
                                            @if($kontakt['erinnerungsinterval']=="2 week") <div>   Alle 2 Wochen</div>@endif
                                            @if($kontakt['erinnerungsinterval']=="1 month") <div>   monatlich </div>@endif
                                            @if($kontakt['erinnerungsinterval']=="3 month") <div>  Alle 3 Monaten  </div>@endif
                                            @if($kontakt['erinnerungsinterval']=="6 month") <div>   Alle 6 Monaten  </div>@endif
                                            @if($kontakt['erinnerungsinterval']=="9 month") <div>   Alle 9 Monaten  </div>@endif
                                            @if($kontakt['erinnerungsinterval']=="1 year") <div>   Jährlich  </div>@endif
                                </div>
                            </div>
                            @endif


                            <div class="row mb-3">
                                <div class="col-sm-9 text-secondary">
                                    <form  method="post" action="/kontakt_bearbeiten" >
                                    <input type="submit" name="submit" class="btn btn-primary px-4" value="Bearbeiten">
                                    <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                    <input type="hidden" name="bearbeiten" value="1" >
                                    </form>
                                </div>
                            </div>



                                <div class="row mb-3">
                                <div class="col-sm-9 text-secondary">
                                        <form  method="post" action="\beziehungenVerwalten" >
                                        <input type="submit" name="submit" class="btn btn-primary px-4" value="Beziehungen">
                                        <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                        <input type="hidden" name="beziehungen" value="1" >
                                            <input type="hidden" name="beziehungen_verwalten" value="1" >
                                        </form>
                                </div>
                                </div>

                            <div class="row mb-3">
                                <div class="col-sm-9 text-secondary">
                                    <form  method="post" action="\kontakt_loeschen" >

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Löschen
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ACHTUNG!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Sind Sie sich sicher, den Kontakt endgültig zu löschen?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbruch</button>
                                                        <button type="submit" class="btn btn-primary">Endgültig löschen</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                        <input type="hidden" name="loeschen" value="1" >
                                    </form>
                                    <br>
                                    <div>
                                        <form method="post" action="/">
                                            <input type="submit" name="zurück" class="btn btn-primary px-4" value="Zurück">
                                            <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                            <input type="hidden" name="submitted" value="1" >
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>









</body>
</html>
