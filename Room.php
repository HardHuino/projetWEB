<?php
// Récupérer les paramètres GET
if (isset($_GET["displayName"]) && isset($_GET["roomCode"])) {
            $displayName = $_GET['displayName'];
            $roomCode = $_GET['roomCode'];
        }

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

//Verifie si la salle existe
$query="SELECT questionText FROM questions ORDER BY RAND() LIMIT 1;";
$roomRows = mysqli_fetch_assoc(mysqli_query($bdd,$query));
$roomExists = false;
foreach ($roomRows as $value) {     //ATTENTION BUG ICI $value N'EST PAS UN STRING JE PENSE
    if($value == $roomCode){
        $roomExists = false;
        break;
    }
}
/*if($roomExists==false){
    die("Echec de connexion au serveur : La salle n'existe pas");
}*/

echo "Connecté à la base de données<br>";

//remplir la base de données avec le nom du joueur et choisir une question à afficher 
$query="INSERT INTO players (displayName,roomCode) VALUES($displayName,$roomCode)";

mysqli_query($bdd,$query); //ATENTION NE VERIFIE PAS SI LE JOUEUR EXISTE DEJA POUR CETTE SALLE

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
                    <button class="btn btn-primary" type="submit">Valider</button>
                </div>
            </form>
        </div>

        <script src="Code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>
