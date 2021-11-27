<!DOCTYPE html>
<html lang="de">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Anmeldung</title>
    <link rel="stylesheet" href="../css/anmeldung.css">
</head>

<body>
<!--<div id="title" >Adressbuch</div>-->
<div class="container">

    <form class="form"  method="POST" action="/anmeldung_verifizierung">
        <h1 class="form__title">Anmeldung</h1>
        <div class="form__message form__message--error">@if(!empty($fehler)){{$fehler}} @endif</div>
        <div class="form__input-group">
            <input type="email" class="form__input" name="email" value="@if(!empty($valueEmail)){{$valueEmail}}@endif" autofocus placeholder="Email" required>
        </div>
        <div class="form__input-group">
            <input type="password" class="form__input" name="passwort" autofocus placeholder="Password" required>
        </div>
        <button class="form__button" type="submit">Anmelden</button>
        <input type="hidden" name="submitted" value="1" >
        <p class="form__text">
            <a href="/passwort_vergessen" class="form__link">Passwort vergessen?</a>
        </p>
        <p class="form__text">
            <a class="form__link" href="/registrierung" >haben Sie kein Konto? Jetzt Registrieren</a>
        </p>
    </form>
</div>
</body>
</html>