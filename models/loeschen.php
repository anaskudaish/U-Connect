<?php

function kontakt_loeschen_model($kontakt_id) : bool{
    $link = connectdb();
    $result = mysqli_query($link, "delete from kontakte where id='$kontakt_id'");
    if($result){
        return true;
    }
    else{
        return false;
    }
}
