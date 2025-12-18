<?php
    // Récupérer les paramètres GET
    if (isset($_COOKIE["displayName"]) && isset($_COOKIE["roomCode"])) {
                $displayName = $_COOKIE['displayName'];
                $roomCode = $_COOKIE['roomCode'];
            }

    include 'dbconnect.php';

    // echo "Connecté à la base de données<br>";

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
        // echo("Bienvenu Nouveau Joueur"); // Mis en commentaire car source d'erreur (logo qui s'affiche pas dans la barre de navigation)
    }

    //Si c'est un nouveau joueur pour cette salle
    if($playerExists==false){
        //L'INSERT INTO ne marchais pas car il faut une sintaxe particulière pour les variables de chaines de caractères
        $query = "INSERT INTO `players`(`displayName`, `roomCode`) VALUES ('".$displayName."','".$roomCode."')";
        if(mysqli_query($bdd,$query)){
            // echo("Bienvenu Nouveau Joueur");
        }
    }

    //A rajouter : récupérer les reponses précédents de ce joueur

    //A REVOIR pour quand est-ce qu'une question change
    $query="SELECT questionText FROM rooms WHERE roomCode='".$roomCode."';";

    $result=mysqli_query($bdd,$query);
    $result=mysqli_fetch_assoc($result);
    $questionText = $result["questionText"];

    mysqli_close($bdd);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>King'O'Quiz</title>
        <link rel="icon" type="image/png" href="img/logo.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href="Style.css" rel="stylesheet"/>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg py-2 fixed-top" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand fs-2" href="Welcome.php">
                    <img src="img/logo.png" alt="Logo" width="10%" height="10%" class="d-inline-block align-text-top me-2">
                    <h1>King'O'Quiz</h1>
                </a>
                <h1 class="position-absolute start-50 translate-middle-x">Room: <?php echo $roomCode; ?></h1>
                <div class="d-flex gap-1">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#roomCreation">Créer une salle</button>
                        <div class="btn-group">
                            <button id="username" type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="#">Statistiques</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="logout.php" class="dropdown-item" href="#">Déconnexion</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <p>Nom : <strong><?php echo $displayName; ?></strong></p>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card form-card center w-75">
                <div class="card-header text-center">
                    <h2><?php echo($questionText); ?></h2>
                </div>
                <div class="card-body">
                    <form id="submitForm" class="needs-validation" method="POST" action="
                        <?php
                            
                            include 'dbconnect.php';
                            if (isset($_COOKIE["displayName"]) && isset($_COOKIE["roomCode"]) && isset($_POST["answerText"])) {
                                $displayName = $_COOKIE['displayName'];
                                $roomCode = $_COOKIE['roomCode'];
                                $answerText = $_POST['answerText'];
                                $query = "INSERT INTO `answers`(`displayName`,`answerText`,`roomCode`,`timeSent`) VALUES ('".$displayName."','".$answerText."','".$roomCode."',CURRENT_TIMESTAMP)";
                                mysqli_query($bdd,$query);
                                header('Location: /projetWEB/Results.php');
                            }
                        ?> 
                        " novalidate>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="validationAnswer" name="answerText" placeholder="Votre réponse ici" required>
                            <label for="validationAnswer" class="form-label">Votre réponse ici</label>
                            <div class="invalid-feedback">
                                Donnez une réponse valide
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="displayName" value="<?php echo htmlspecialchars($displayName); ?>">
                        <button class="btn btn-success w-100" type="submit" name="submitA">Valider</button>
                    </form>
                </div>
            </div>
        </div>
        <?php 
        
        ?> 

        <footer class="text-center py-4 fixed-bottom">
            <p>© 2025 King'O'Quiz. Tous droits réservés.</p>
            <a href="https://www.vecteezy.com/vector-art/7384712-medieval-landscape-background">Medieval Vectors by Vecteezy</a>
        </footer>
        <script src="Code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>
