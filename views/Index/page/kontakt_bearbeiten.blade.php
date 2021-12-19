<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kontakt</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/kontakt_bearbeiten.css">
    <link rel="stylesheet" href="../css/logo-swe.css">


</head>
<body>
<a href="/"><img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo"></a>


<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex flex-column align-items-center text-center">

                            <img src="../img/{{$kontakt['bildname']}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="210">
                        </div>
                        <hr class="my-4">


                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="" method="post" enctype="multipart/form-data">
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
                                    <h6 class="mb-0">Tags</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="tags" class="form-control" value="{{$kontakt['tags']}}">
                                </div>
                            </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Textfeld</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <textarea  type="text" name="textfeld" class="form-control">{{$kontakt['textfeld']}}</textarea>
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

                            <div class="col-sm-9 text-secondary">
                                <input type="submit" name="submit" class="btn btn-primary px-4" value="Speichern">
                                <input type="hidden" name="submitted" value="1" >
                                <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                            </div>
                        </div>
                     </form>
<br>
                        <div class="row">
                            <div class="col-sm-9 text-secondary">
                                <form method="post" action="\beziehungenVerwalten" >
                                    <input  type="submit" name="submit" class="btn btn-primary px-4" value="Beziehungen verwalten">
                                    <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                    <input type="hidden" name="beziehungen_verwalten" value="1" >
                                </form>
                            </div>
                        </div>
<br>
                        <div class="row">
                            <div class="col-sm-9 text-secondary">
                                <form method="post" action="\kontakt" >
                                    <input  type="submit" name="submit" class="btn btn-primary px-4" value="Abbrechen">
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







</body>
</html>
