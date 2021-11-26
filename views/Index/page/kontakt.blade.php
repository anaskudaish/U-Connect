<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kontakt</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/kontakt.css">



</head>
<body>


    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="../img/unknown.jpg" alt="Admin" class="rounded-circle p-1 bg-primary" width="210">
                            </div>
                           <h3 class="card-title">{{$kontakt['vorname'] . ' ' . $kontakt['nachname']}}</h3>
                            <hr class="my-4">

                            <ul class="list-group list-group-flush">
                                @if(!empty($kontakt['instagram']))
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg><a href="{{$kontakt['instagram']}}">Instagram</a></h6>
                                    </li>
                                @endif
                                @if(!empty($kontakt['facebook']))
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg><a href="{{$kontakt['facebook']}}">Facebook</a></h6>

                                    </li>
                                @endif
                                @if(!empty($kontakt['twitter']))
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg><a href="{{$kontakt['twitter']}}">Twitter</a></h6>
                                    </li>
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

                            @if(!empty($kontakt['textfeld']))

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
                                    <input   type="submit" name="submit" class="btn btn-primary px-4" value="Bearbeiten">
                                    <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                    <input type="hidden" name="bearbeiten" value="1" >
                                    </form>
                                </div>
                            </div>



                                <div class="row mb-3">
                                <div class="col-sm-9 text-secondary">
                                        <form  method="post" action="" >
                                        <input  type="submit" name="submit" class="btn btn-primary px-4" value="Beziehungen">
                                        <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                        <input type="hidden" name="beziehungen" value="1" >
                                        </form>
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