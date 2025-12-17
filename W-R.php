<?php
    // Récupérer les paramètres GET
    if (isset($_GET["displayName"]) && isset($_GET["roomCode"])) {
        $displayName = $_GET['displayName'];
        $roomCode = $_GET['roomCode'];
    }
    else{
        die;
    }
    include 'dbconnect.php';
     //Verifie si la salle existe
    $query="SELECT roomCode FROM rooms;";
    $roomRows = mysqli_query($bdd,$query); //Tout les roomCodes
    $currentRoom = mysqli_fetch_assoc($roomRows);//Le roomCode de la preière salle que retourne la requête
    $roomExists = false;
    //Pour le rapport : J'avais eu un peu de soucis a verifier si la salle existais car je ne savais pas que mysqli_fetch_assoc renvoiyait 
    //que une ligne de la requete et il fallait l'appeler à nouveau pour qu'il prenne la prochaine ligne

    while($currentRoom!=null) {     
        if($currentRoom["roomCode"] == $roomCode){
            $roomExists = true;
            break;
        }
        $currentRoom = mysqli_fetch_assoc($roomRows); //Le prochain roomCode 
    }

    if($roomExists==false){
        setcookie(error, true , time() + (86400), "/"); // 86400 = 1 day
        header('Location: /projetWEB/Welcome.php');
    } else {
        setcookie(displayName, $displayName , time() + (86400), "/"); // 86400 = 1 day
        setcookie(roomCode, $roomCode , time() + (86400), "/"); // 86400 = 1 day
        
        header('Location: /projetWEB/Room.php');
    }
?>