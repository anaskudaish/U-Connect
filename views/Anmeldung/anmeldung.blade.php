<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Anmeldung</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/anmeldung.css">
</head>
<body>
<div class="background" >
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form method="POST" action="/anmeldung_verifizierung">
    <h3>Login Here</h3>

    <div class="form__message form__message--error">@if(!empty($fehler)){{$fehler}} @endif</div>
    <label for="email">Username</label>
    <input type="email"  id = "email" class="form__input" name="email" value="@if(!empty($valueEmail)){{$valueEmail}}@endif" autofocus placeholder="Email" required>


    <label for="password">Password</label>
    <input type="password" class="form__input" id="password" name="passwort" autofocus placeholder="Password" required>

    <button class="form__button" type="submit">Anmelden</button>
    <input type="hidden" name="submitted" value="1" >
    <p class="form__text">
        <a href="/passwort_vergessen" class="form__link">Passwort vergessen?</a>
    </p>
    <p class="form__text">
        <a class="form__link" href="/registrierung" >haben Sie kein Konto? Jetzt Registrieren</a>
    </p>

</form>
</body>
</html>
