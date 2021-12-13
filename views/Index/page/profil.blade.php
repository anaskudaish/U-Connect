<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="../css/profil.css">
        <link rel="stylesheet" href="../css/logo-swe.css">
</head>
<body>
<a href="/" class="previous">&laquo; Hauptseite</a>
<img src="../img/logo-swe.png" class="sweLogo" alt="sweLogo">
<h2 class=""> Account </h2>

<p>Angemeldet als <span >{{$Email}}</span></p><br>


        <form class="cl" method="post"  action="/profil_update">

            <hr>
            <h3> E-Mail ändern </h3>
            <div class="error">@if(isset($fehler_email)){{$fehler_email}} @endif</div>
            <div class="error">@if(isset($fehler_code)){{$fehler_code}} @endif</div>
            <div class="success">@if(isset($mitteilung)){{$mitteilung}} @endif</div>


            <p>
                @if(empty($mitteilung))
                    <input type="email"  id="input01" name="email" placeholder="Neue E-Mail">
                @else
                    <input type="text"  id="input01" name="code" placeholder="Code eingeben">

                @endif

            </p>

            <hr>
            <h3> Passwort ändern </h3>
            <div class="error">@if(isset($fehler_passwort)){{$fehler_passwort}} @endif</div>
            <div class="success">@if(isset($resultat)){{$resultat}} @endif</div>

            <p>
                <input type="password" name="passwort1" placeholder="Neues Passwort">
            </p>

            <p>
                <input type="password" name="passwort2"  placeholder="Passwort wiederholen" >
            </p>

            <hr>
            <div class="error">@if(isset($fehler_akt_passwort)){{$fehler_akt_passwort}} @endif</div>
               <p>
            <input type="password" name="passwort" required placeholder="Aktuelles Passwort">

              </p>
            <button type="submit" name="submit" class="">Update Account</button>
            <input type="hidden" name="submitted" value="1" >

        </form>

</body>
</html>
