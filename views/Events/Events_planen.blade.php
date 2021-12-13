<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events planen</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/Events_planen.css">



</head>
<body>
<a href="/" class="previous">&laquo;Hauptseite</a>


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
                                    <select name="test" size="10">
                                    @foreach($events as $value)
                                            <option value="{{$value['EventName'] }}">{{$value['EventName'] }}</option>
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
                                        <form  method="post" action="/Event_bearbeiten" >
                                        <input  type="submit" name="submit" class="btn btn-primary px-4" value="Ausgewähltes Event bearbeiten">
                                        <input type="hidden" name="id_kontakt" value="{{$Events['id']}}">
                                        <input type="hidden" name="beziehungen" value="1" >
                                        </form>
                                </div>
                                </div>
                            <div class="row mb-3">
                                <div class="col-sm-9 text-secondary">
                                    <form  method="post" action="/Events_planen" >
                                        <input  type="submit" name="submit" class="btn btn-primary px-4" value="Ausgewähltes Event löschen">
                                        <input type="hidden" name="id_kontakt" value="{{$Events['id']}}">
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
