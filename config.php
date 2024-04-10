<?php
$kasutaja = "jolana";
$dbserver = "localhost";
$andmebaas = "tickets";
$pw = "Jeleena88";

$yhendus = mysqli_connect($dbserver, $kasutaja, $pw, $andmebaas);

if(!$yhendus){
    die("Sa jÃ¤lle ebaÃµnnestusid!");
}
?>