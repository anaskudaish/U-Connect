<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kontakt</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet"  href="../css/kontakt_hinzufuegen.css">
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

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/kontakt_hinzufuegen" method="post" onsubmit="sendURL()" enctype="multipart/form-data">
                            <h3>Neuer Kontakt</h3>
                            <div class="form__input-error-message">@if(isset($resultatfehler)){{$resultatfehler}} @endif</div>
                            <div class="form__message form__message--success">@if(isset($resultatok)){{$resultatok}} @endif</div>
                            <br>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vorname</h6>
                                </div>

                                <div class="col-sm-9 text-secondary">
                                    <input type="text"  name="vorname" class="form-control"  required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nachname</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="nachname" class="form-control"  required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telefonnummer</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="telefonnummer" class="form-control"  required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Instagram Link</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="instagram" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Facebook Link</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="facebook" class="form-control" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Twitter Link</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text"  name="twitter" class="form-control" >

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Eigene Links</h6>
                                </div>
                                <div class="col-sm-9 text-secondary" id="contactURL">
                                    <input type="hidden" name="customURL" >
                                    <button type="button" onclick="addURLInput();" class="">+</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Straße</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="strasse"  class="form-control" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">PLZ</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="plz" class="form-control" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Stadt</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="stadt" class="form-control" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Land</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="land" class="form-control" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tags</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    @if(isset($tags))<p>Vorhandene Tags</p>
                                    @foreach(array_slice($tags,0,5) as $value)
                                        <input type="checkbox" name="tags[]" id="{{$value}}" value="{{$value}}"> <label for="{{$value}}">{{$value}}</label>
                                    @endforeach
                                    @endif

                                    @if(isset($tags))
                                        <input type='text' oninput='onInput()' id='input'  list='dlist' placeholder="Vorhandene Tags durchsuchen" class="textDatalist" style="width: 300px; height: 20px;margin: 10px;"/>
                                        <datalist id='dlist'>
                                            @foreach($tags as $value)
                                                <option value='{{$value}}'>{{$value}}</option>
                                            @endforeach
                                        </datalist>
                                    @endif
                                    <input  type="text" name="neu_tag"  autofocus placeholder="Neue Tags">
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
                                    <input type="date" name="geburtsdatum" class="form-control"  >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Erinnerungsinterval</h6>
                                </div>

                                <div class="col-sm-9 text-secondary">
                                    <select id="Interval" name="erinnerungsinterval">
                                        <option value="1 Day">  Tag     </option>
                                        <option value="3 Day">  3 Tage   </option>
                                        <option value="1 week"> Woche   </option>
                                        <option value="2 week"> 2 Wochen </option>
                                        <option value="1 month"> Monat  </option>
                                        <option value="3 month"> 3 Monate </option>
                                        <option value="6 month"> 6 Monate </option>
                                        <option value="9 month"> 9 Monate </option>
                                        <option value="1 year" selected> Jahr</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Bild :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input id="Bild" type="file" name="bild">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-9 text-secondary">

                                    <input type="submit" name="submit" class="btn btn-primary px-4" value="Speichern">
                                    <input type="hidden" name="submitted" value="1" >
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="row">
                            <div class="col-sm-9 text-secondary">
                                <form method="post" action="\beziehungenhinzufuegen" >
                                    <input  type="submit" name="submit" class="btn btn-primary px-4" value="Beziehungen hinzufügen">
                                    <input type="hidden" name="id_kontakt" value="{{$kontakt['id']}}">
                                    <input type="hidden" name="beziehungen_verwalten" value="2" >
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-9 text-secondary">
                                <form method="post" action="\" >
                                    <input  type="submit" name="submit" class="btn btn-primary px-4" value="Abbrechen">
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


<script>
    function onInput() {
        var val = document.getElementById("input").value;
        var opts = document.getElementById('dlist').childNodes;
        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === val) {
                if(document.getElementsByName('neu_tag')[0].value.slice(-1) == ',' || document.getElementsByName('neu_tag')[0].value.slice(-1) == '')
                    document.getElementsByName('neu_tag')[0].value += opts[i].value;
                else
                    document.getElementsByName('neu_tag')[0].value += "," + opts[i].value;
                document.getElementById("input").value = "";
                break;
            }
        }
    }

    var urlArray =[];

    function addURLInput() {
        var br = document.createElement("br");
        var container = document.getElementById("contactURL");
        var input = document.createElement("input");
        input.type = "url";
        input.placeholder = "Eigene URL";
        input.className = "form-control";
        urlArray.push(input);
        container.appendChild(br);
        container.appendChild(input);
    }

    function sendURL() {
        var custom = document.getElementsByName('customURL');
        var tmp = [];
        for(var i =0;i < urlArray.length;i++) {
            if(urlArray[i] != "")
                tmp.push(urlArray[i].value.replaceAll(',',''));
        }
        custom[0].value = tmp.filter(Boolean).join(',');
    }
</script>




</body>
</html>
