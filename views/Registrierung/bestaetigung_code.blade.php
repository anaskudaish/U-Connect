<!DOCTYPE html>
<html lang="de">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Registering</title>
    <link rel="stylesheet" href="../css/bestaetigung_code.css">
</head>

<body>

<div class="container">
    <form class="form"  method="POST" action="/bestaetigung_code_verifizierung">

        <h1 class="form__title">Bestätigungscode</h1>
        <div class="form__message"> wir haben einen Code an die gegebene E-Mail gesandt.</div>


        <div class="form__input-group">
            <input type="text" class="form__input" name="code"  autofocus placeholder="Code eintragen " required>
            <div class="form__input-error-message">@if(!empty($fehler)){{$fehler}} @endif</div>
        </div>

        <button class="form__button" type="submit">Bestätigen</button>
        <input type="hidden" name="submitted" value="1" >
        <p class="form__text">
            <a class="form__link" href="/neuer_code" >Neuer Code</a>
        </p>
    </form>
</div>
</body>
</html>

