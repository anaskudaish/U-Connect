<!DOCTYPE html>
<html lang="de">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Registrierung</title>
    <link rel="stylesheet" href="../css/registrierung.css">
</head>

<body>


<div class="container">
    <form class="form" id="createAccount" method="POST" action="/registrierung_verifizierung">
        <h1 class="form__title">Neues Konto</h1>
        <div class="form__input-group">
            <input type="text" class="form__input" name="email" autofocus placeholder="Email" value="{{$valueEmail}}" required>
            <!--<div class="form__input-error-message"></div>-->
        </div>
        <div class="form__input-group">
            <input type="password" class="form__input" name="passwort1" autofocus placeholder="Passwort" required>
            <!--<div class="form__input-error-message"></div>-->
        </div>
        <div class="form__input-group">
            <input type="password" class="form__input" name="passwort2" autofocus placeholder="Passwort wiederholen" required>
            <div class="form__input-error-message">@if(!is_null($fehler)){{$fehler}} @endif</div>

        </div>
        <button class="form__button" type="submit">Registrieren</button>
        <input type="hidden" name="submitted" value="1" >
        <p class="form__text">
            <a href="/passwort_vergessen" class="form__link">Passwort vergessen?</a>
        </p>
        <p class="form__text">
            <a class="form__link" href="/anmeldung" >Sie haben bereits ein Konto? Anmelden</a>
        </p>
    </form>
</div>
</body>
</html>