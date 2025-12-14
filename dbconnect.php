<?php

    // Configuration de la base de données
$host = "localhost";
$user = "root";
$pass = "root";
$base = "WEBgame";

// Connexion à la base de données (sans sélectionner de BDD d'abord)
$bdd = mysqli_connect($host,$user,$pass,$base);
if (!$bdd) {
    die('Echec de connexion au serveur de base de données: ' . mysqli_connect_error() . ' ' . mysqli_connect_errno());
}
?>