<?php

class AbmeldungController
{

    public function abmeldung()
    {

        if ($_SESSION['login_ok'] == 1) {
            session_destroy();
        }
        header("Location: /anmeldung");
    }

}