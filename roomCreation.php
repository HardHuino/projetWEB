<?php

include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["displayName"]) && isset($_GET["roomCode"]) && isset($_GET["question"])) {
        $displayName = $_GET['displayName'];
        $roomCode = $_GET['roomCode'];
        $question = $_GET['question'];
    }
    $query = "INSERT INTO rooms (roomCode, questionText) VALUES ('$roomCode', '$question')";
    if (mysqli_query($bdd, $query)) {
        echo "Salle créée avec succès.<br>";
    } else {
        die("Erreur lors de la création de la salle : " . mysqli_error($bdd));
    }
    $query = "INSERT INTO players (displayName, roomCode) VALUES ('$displayName', '$roomCode')";
    if (mysqli_query($bdd, $query)) {
        echo "Joueur ajouté avec succès.<br>";
        header("Location: Room.php?displayName=" . urlencode($displayName) . "&roomCode=" . urlencode($roomCode));
        exit();
    } else {
        die("Erreur lors de l'ajout du joueur : " . mysqli_error($bdd));
    }
    header("Location: Room.php?displayName=" . urlencode($displayName) . "&roomCode=" . urlencode($roomCode));
    exit();
    mysqli_close($bdd);
}