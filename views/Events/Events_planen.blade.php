<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events planen</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/Events_planen.css">
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
<br>
    <div class="container">
        <div class="main-body">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Anstehende Events:</h6>
                                </div>
                            @if(!empty($events))
                                    <select name="eventId" size="10" form="edit_event">
                                    @foreach($events as $value)
                                            <option selected="selected" value="{{$value['id'] }}">{{$value['EventName'] }}</option>
                                    @endforeach
                                    </select>
                            @endif
                        </div>
                            <br>
                            <div class="row mb-3">
                                <div class="col-sm-9 text-secondary">
                                    <form  method="post" action="/neues_Event" >
                                    <input   type="submit" name="submit" class="btn btn-primary px-4" value="Neues Event planen">
                                    </form>
                                </div>
                            </div>
                                <div class="row mb-3">
                                <div class="col-sm-9 text-secondary">
                                        <form  id="edit_event" method="post" action="/Event_bearbeiten" >
                                        <input  type="submit" name="submit" class="btn btn-primary px-4" value="Ausgew??hltes Event bearbeiten">
                                            <br><br>
                                        <input  type="submit" name="deleteEvent" class="btn btn-primary px-4" value="Ausgew??hltes Event loeschen">
                                        </form>
                                </div>
                                </div>
                            <div class="row">
                                <div class="col-sm-9 text-secondary">
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
