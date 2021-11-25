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

<form method="post" action="">
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="../img/unknown.jpg" alt="Admin" class="rounded-circle p-1 bg-primary" width="210">
                        </div>
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
                                <h6 class="mb-0">Vorname</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text"  name="vorname" class="form-control" value="{{$kontakt['vorname']}}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nachname</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="nachname" class="form-control" value="{{$kontakt['nachname']}}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Telefonnummer</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="telefonnummer" class="form-control" value="{{$kontakt['telefonnummer']}}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Instagram Link</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="instagram" class="form-control" value="{{$kontakt['instagram']}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Facebook Link</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="facebook" class="form-control" value="{{$kontakt['facebook']}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Twitter Link</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text"  name="twitter" class="form-control" value="{{$kontakt['twitter']}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Straße</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="strasse"  class="form-control" value="{{$kontakt['strasse']}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">PLZ</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="plz" class="form-control" value="{{$kontakt['plz']}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Stadt</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="stadt" class="form-control" value="{{$kontakt['stadt']}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Land</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="land" class="form-control" value="{{$kontakt['land']}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Textfeld</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <textarea  type="text" name="textfeld" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Geburtsdatum</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="date" name="geburtsdatum" class="form-control"  value="{{$kontakt['geburtsdatum']}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Erinnerungsinterval</h6>
                            </div>

                            <div class="col-sm-9 text-secondary">
                                <select id="Interval" name="erinnerungsinterval">
                                    <option value="1 Day"    @if($kontakt['erinnerungsinterval']=="1 Day") selected @endif> Tag   </option>
                                    <option value="3 Day"    @if($kontakt['erinnerungsinterval']=="3 Day") selected @endif>  3 Tage   </option>
                                    <option value="1 week"   @if($kontakt['erinnerungsinterval']=="1 week") selected @endif> Woche   </option>
                                    <option value="2 week"   @if($kontakt['erinnerungsinterval']=="2 week") selected @endif> 2 Wochen </option>
                                    <option value="1 month"  @if($kontakt['erinnerungsinterval']=="1 month") selected @endif> Monat  </option>
                                    <option value="3 month"  @if($kontakt['erinnerungsinterval']=="3 month") selected @endif> 3 Monate </option>
                                    <option value="6 month"  @if($kontakt['erinnerungsinterval']=="6 month") selected @endif> 6 Monate </option>
                                    <option value="9 month"  @if($kontakt['erinnerungsinterval']=="9 month") selected @endif> 9 Monate </option>
                                    <option value="1 year"   @if($kontakt['erinnerungsinterval']=="1 year") selected @endif> Jahr</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Neues Bild</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input id="Bild" type="file" name="bild">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input   type="submit" name="submit" class="btn btn-primary px-4" value="Speichern">
                                <input  type="hidden" name="submitted" value="1" >
                                <a id="bz" class="btn btn-primary px-4"   href="/beziehungen">Beziehungen verwalten</a>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

</form>







</body>
</html>