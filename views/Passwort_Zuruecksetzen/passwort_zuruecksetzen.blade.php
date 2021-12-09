<!DOCTYPE html>
<html lang="de">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Passwort zurücksetzen</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/anmeldung.css">
</head>

<body>
<div class="background" >
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<div class="container">

    <form class="form"  method="POST" action="/passwort_zuruecksetzen_verifizierung">
        <h1 class="form__title">Neues Passwort</h1>
        <div class="form__message form__message--error">@if(!empty($fehler)){{$fehler}} @endif</div>
        <div class="form__input-group">
            <input type="password" class="form__input" name="passwort1"  autofocus placeholder="Neues Passwort" required>
        </div>
        <div class="form__input-group">
            <input type="password" class="form__input" name="passwort2" autofocus placeholder="Passwort wiederholen" required>
        </div>
        <button class="form__button" type="submit">Speichern</button>
        <input type="hidden" name="submitted" value="1" >

    </form>
</div>
</body>
</html>
