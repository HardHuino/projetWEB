<?php
    session_start();
    $error = false;
    if (isset($_COOKIE['error'])) {
        $error = $_COOKIE['error'];
        setcookie('error', '', time() - 3600, "/"); // Supprimer le cookie
    }
    include 'dbconnect.php';
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
                <div class="d-flex gap-1">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#roomCreation">Créer une salle</button>
                        <div class="btn-group">
                            <button id="username" type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="stats.php">Statistiques</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="logout.php" class="dropdown-item">Déconnexion</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a class="btn btn-success" role="button" id="login" href="Login.php">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <!-- Room Creation Modal -->
        <div class="modal fade" id="roomCreation" tabindex="-1" aria-labelledby="roomCreationLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="needs-validation" METHOD="GET" action="roomCreation.php" novalidate>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="roomCreationLabel">Creation de salle</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="roomCode" name="roomCode" placeholder="Code de la salle" required>
                                    <label for="roomCode" class="form-label">Code de la salle</label>
                                    <div class="invalid-feedback">
                                        Donnez un code de salle valide
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="question" name="question" placeholder="Question" required>
                                    <label for="question" class="form-label">Question</label>
                                    <div class="invalid-feedback">
                                        Donnez une question valide
                                    </div>
                                </div>
                            </form>
                            <input type="hidden" name="displayName" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success" id="createRoom">Créer la salle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card form-card center w-50">
                <div class="card-header text-center">
                    <h2>Rejoindre une salle</h2>
                </div>
                <div class="card-body">
                    <form class="needs-validation" METHOD="GET" action="W-R.php" novalidate>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="roomCode" name="roomCode" placeholder="Code de la salle" required>
                            <label for="roomCode" class="form-label">Code de la salle</label>
                            <div class="invalid-feedback">
                                Donnez un code de salle valide
                            </div>
                        </div>
                        <?php if ($error): ?>
                            <div class="alert alert-danger text-center mt-2">La salle n'existe pas.</div>
                        <?php endif; ?>
                        <?php if (!(isset($_SESSION['username']))): ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Entrer un nom" required>
                                <label for="displayName" class="form-label">Entrer un nom</label>
                                <div class="invalid-feedback">
                                    Donnez un nom valide
                                </div>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="displayName" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                        <?php endif; ?>
                        <br>
                        <input type="submit" value="Rejoindre une salle" class="btn btn-success w-100" id="joinRoom">
                    </form>
                </div>
            </div>
            
        </div>
        <footer class="text-center py-4 fixed-bottom">
            <p>© 2025 King'O'Quiz. Tous droits réservés.</p>
            <a href="https://www.vecteezy.com/vector-art/7384712-medieval-landscape-background">Medieval Vectors by Vecteezy</a>
        </footer>
        <script src="Code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>