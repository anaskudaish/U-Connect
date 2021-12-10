<?php



function events($email){

$link  = connectdb();

$events =null;

$resultat=  mysqli_query($link,"select id from nutzer where email='{$email}'");
$date = mysqli_fetch_assoc($resultat);
$nutzer_id=$date['id'];


$result=mysqli_query($link,"select EventName from events where nutzer_id= '{$nutzer_id}' ");
while($daten = mysqli_fetch_assoc($result)) {

$events []= $daten;

}

return $events;
}