<?php
    // Récupérer les paramètres GET
    if (isset($_GET["displayName"]) && isset($_GET["roomCode"])) {
        $displayName = $_GET['displayName'];
        $roomCode = $_GET['roomCode'];
    }
    else{
        die;
    }
    setcookie(displayName, $displayName , time() + (86400), "/"); // 86400 = 1 day
    setcookie(roomCode, $roomCode , time() + (86400), "/"); // 86400 = 1 day
    header('Location: /projetWEB/Room.php');
?>