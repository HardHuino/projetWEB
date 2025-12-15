<?php
    // Récupérer les paramètres GET
    if (isset($_GET["displayName"]) && isset($_GET["roomCode"])) {
                $displayName = $_GET['displayName'];
                $roomCode = $_GET['roomCode'];
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
        die("Echec de connexion au serveur : La salle n'existe pas");
    }

    echo "Connecté à la base de données<br>";

    //Rempli la base de données avec le nom du joueur si il n'existe pas deja et choisir une question à afficher 

    $query="SELECT displayName FROM players;"; // WHERE roomCode=$roomCode
    $playerRows = mysqli_query($bdd,$query); //Tout les display names de cette salle
    //Le premier displayName des joueurs de cette salle
    $currentPlayer = mysqli_fetch_assoc($playerRows); 


    $playerExists = false;
    while($currentPlayer!=null) {     
        if($currentPlayer["displayName"] == $displayName){
            $playerExists = true;
            break;
        }
        $currentPlayer = mysqli_fetch_assoc($playerRows); //Le prochain displayName 
    }

    $query = "INSERT INTO `players`(`displayName`, `roomCode`) VALUES ('".$displayName."','".$roomCode."')";
    if(mysqli_query($bdd,$query)){
        echo("Bienvenu Nouveau Joueur");
    }

    //Si c'est un nouveau joueur pour cette salle
    if($playerExists==false){
        //L'INSERT INTO ne marchais pas car il faut une sintaxe particulière pour les variables de chaines de caractères
        $query = "INSERT INTO `players`(`displayName`, `roomCode`) VALUES ('".$displayName."','".$roomCode."')";
        if(mysqli_query($bdd,$query)){
            echo("Bienvenu Nouveau Joueur");
        }
    }

    //A rajouter : récupérer les reponses précédents de ce joueur

    $query="SELECT questionText FROM questions ORDER BY RAND() LIMIT 1;";

    $result=mysqli_query($bdd,$query);
    $questionText = mysqli_fetch_assoc($result);
    mysqli_close($bdd);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>King'O'Quiz</title>
        <link href="Style.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <h1>Room: <?php echo $roomCode; ?></h1>
            <p>Joueur: <strong><?php echo $displayName; ?></strong></p>
            <p>Code de room: <code><?php echo $roomCode; ?></code></p>

            <form class="row g-3 needs-validation" novalidate>
                <div class="mb-2">
                    <label for="validationAnswer" class="form-label"><?php echo($questionText["questionText"]); ?></label>
                    <input type="text" class="form-control" id="validationAnswer" name="answerText" placeholder="Entrez votre réponse ici" required>
                    <input type="hidden" name="displayName" value="<?php echo htmlspecialchars($displayName); ?>">
                    <div class="invalid-feedback">
                        Donnez une réponse valide
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" methode="GET" action="">Valider</button>
                </div>
            </form>
        </div>

        <script src="Code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>
