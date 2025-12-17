<?php

// Configuration de la base de données
$host = "localhost";
$user = "root";
$pass = "root";
$base = "WEBgame";

// Connexion à la base de données (sans sélectionner de BDD d'abord)
$bdd = mysqli_connect($host,$user,$pass,$base);
if (!$bdd) {
    $sqlFile = 'setup.sql';
    $conn = @mysqli_connect($host, $user, $pass);
    $sql = file_get_contents($sqlFile);
    mysqli_multi_query($conn, $sql);
}
?>