<?php
    date_default_timezone_set('Europe/Paris');

    if (isset($_COOKIE["roomCode"])) {
        $roomCode = $_COOKIE['roomCode'];
    } else {
        die("Code de salle manquant");
    }

    include 'dbconnect.php';

    // Récupérer la question
    $query = "SELECT questionText FROM rooms WHERE roomCode='$roomCode'";
    $result = mysqli_query($bdd, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $question = mysqli_fetch_assoc($result)['questionText'];
    } else {
        die("Salle introuvable");
    }

    // Récupérer les réponses
    $query = "SELECT displayName, answerText, timeSent FROM answers WHERE roomCode='$roomCode' ORDER BY timeSent";
    $result = mysqli_query($bdd, $query);
    $answers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $answers[] = $row;
    }

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
                <h1 class="position-absolute start-50 translate-middle-x">Résultats - Room: <?php echo $roomCode; ?></h1>
                <div class="d-flex gap-1">
                    <a href="Room.php" class="btn btn-outline-light">Retour à la salle</a>
                </div>
            </div>
        </nav>
        
        <br><br><br><br>

        <div class="card bg-success m-auto">
            <h2 class="text-center fs-1 text-white">Question : <?php echo htmlspecialchars($question); ?></h2>
        </div>

        <div class="container-fluid  py-4">
            <?php if (count($answers) > 0): ?>
                <div class="row row-cols-md-4 g-4">
                    <?php foreach ($answers as $answer): ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="fs-4"><?php echo htmlspecialchars($answer['displayName']); ?></h2>
                                </div>
                                <div class="card-body">
                                    <p class="card-text "><?php echo htmlspecialchars($answer['answerText']); ?></p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($answer['timeSent'])); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center">Aucune réponse pour le moment.</p>
            <?php endif; ?>
        </div>

        <footer class="text-center py-4 fixed-bottom">
            <p>© 2025 King'O'Quiz. Tous droits réservés.</p>
            <a href="https://www.vecteezy.com/vector-art/7384712-medieval-landscape-background">Medieval Vectors by Vecteezy</a>
        </footer>
        <script src="Code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>