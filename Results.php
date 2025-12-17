<?php
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


        
        <?php foreach ($answers as $answer): ?>
        <div class="card text-center m-3 w-25 mx-auto">
            <div class="card-header">
                <h2><?php echo htmlspecialchars($answer['displayName']); ?></h2>
            </div>
            <div class="card-body">
                <p><?php echo htmlspecialchars($answer['answerText']); ?></p>
            </div>
            <div class="card-footer text-muted">
                Répondu à : <?php echo htmlspecialchars($answer['timeSent']); ?>
            </div>
        </div>
        <?php endforeach; ?>



        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card form-card center w-75">
                <div class="card-header text-center">
                    <h2><?php echo htmlspecialchars($question); ?></h2>
                </div>
                <div class="card-body">
                    <h3>Réponses des joueurs :</h3>
                    <?php if (count($answers) > 0): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Joueur</th>
                                    <th>Réponse</th>
                                    <th>Heure</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($answers as $answer): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($answer['displayName']); ?></td>
                                        <td><?php echo htmlspecialchars($answer['answerText']); ?></td>
                                        <td><?php echo htmlspecialchars($answer['timeSent']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Aucune réponse pour le moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <script src="Code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>