<?php
// Configuration de la base de données
$host = "localhost";
$user = "root";
$pass = "root";
$base = "WEBgame";

// Connexion sans sélectionner de BDD
$bdd = mysqli_connect($host, $user, $pass);
if (!$bdd) {
    die('Erreur de connexion: ' . mysqli_connect_error());
}

// Vérifier si la BDD existe déjà
$result = mysqli_query($bdd, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$base'");
if (mysqli_num_rows($result) == 0) {
    // La base n'existe pas, exécuter setup.sql
    $sqlFile = file_get_contents('setup.sql');
    if ($sqlFile) {
        $queries = explode(';', $sqlFile);
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                if (!mysqli_query($bdd, $query)) {
                    // Ignorer les erreurs d'INSERT si les données existent déjà
                    if (strpos(mysqli_error($bdd), 'Duplicate') === false) {
                        // echo "Erreur SQL: " . mysqli_error($bdd) . "<br>";
                    }
                }
            }
        }
    }
}

mysqli_close($bdd);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Bienvenu</title>
        <link href="Style.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body>
        <h1>Bienvenu au jeu!</h1>

        <form class="needs-validation" METHOD="GET" action="Room.php" novalidate>
            <div class="mb-3">
                <label for="roomCode" class="form-label">Code de la salle</label>
                <input type="text" class="form-control" id="roomCode" name="roomCode" placeholder="Entrer le code de la salle à rejoindre" required>
                <div class="invalid-feedback">
                    Donnez un code de salle valide
                </div>
            </div>
        

            <div class="accordion" id="dropboxDisplayName">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            Je n'ai pas de compte
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#dropboxDisplayName">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <label for="displayName" class="form-label">Nom d'affichage</label>
                                <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Entrer un nom d'affichage que les autres joueurs verront">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <input type="submit" value="Rejoindre une salle" class="btn btn-primary">
        </form>
        <script src="Code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script>
            document.querySelector('form').addEventListener('submit', function(e) {
                const displayName = document.getElementById('displayName').value;
                if (!displayName || displayName.trim() === '') {
                    document.getElementById('displayName').value = 'Joueur_' + Math.floor(Math.random() * 10000);
                }
            });
        </script>
    </body>
</html>
