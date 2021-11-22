<!DOCTYPE html>
<html lang="de">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Passwort vergessen</title>
    <link rel="stylesheet" href="../css/passwort_vergessen.css">
</head>

<body>

<div class="container">
    <form class="form" id="login" method="POST" action="/passwort_vergessen_verifizierung">

        <h1 class="form__title">Probleme beim Anmelden?</h1>
        <div class="form__message">@if(is_null($resultat)) wir senden Ihnen ein neues Passwort, um wieder in Ihr Konto zu gelangen. @endif</div>
        <div class="form__message form__message--success">@if(!is_null($resultat)){{$resultat}} @endif</div>
        @if(!is_null($resultat)) {{header("Refresh:4; /anmeldung")}}@endif

        <div class="form__input-group">
            <input type="email" class="form__input" name="email"  autofocus placeholder="Email" required>
            <div class="form__input-error-message">@if(!is_null($fehler)){{$fehler}} @endif</div>
        </div>

        <button class="form__button" type="submit">Passwort senden</button>
        <input type="hidden" name="submitted" value="1" >
        <p class="form__text">
            <a class="form__link" href="/anmeldung">Sie haben bereits ein Konto? Anmelden</a>
        </p>
        <p class="form__text">
            <a class="form__link" href="/registrierung" >haben Sie kein Konto? Jetzt Registrieren</a>
        </p>
    </form>
</div>
</body>
</html>

