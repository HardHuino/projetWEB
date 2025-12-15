<?php 
    session_start(); 
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
        

        <nav class="navbar navbar-expand-lg py-2" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand fs-2">
                    <img src="img/logo.png" alt="Logo" width="10%" height="10%" class="d-inline-block align-text-top me-2">
                    <h1>King'O'Quiz</h1>
                </a>
                <div class="d-flex gap-1">
                    <?php if (isset($_SESSION['username'])): ?>
                        <button class="btn btn-success">Créer une salle</button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="#">Statistiques</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="logout.php" class="dropdown-item danger" href="#">Déconnexion</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a class="btn btn-success" role="button" id="login" href="Login.php">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <form class="needs-validation" METHOD="GET" action="Room.php" novalidate>
            <div class="card form-card">
                <div class="card-header">
                    <h2 class="text-center">Rejoindre une salle</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control " id="roomCode" name="roomCode" placeholder="Entrer le code de la salle à rejoindre" required>
                            <label for="roomCode" class="form-label">Code de la salle</label>
                            <div class="invalid-feedback">
                                Donnez un code de salle valide
                            </div>
                        </div>
                    </div>
                

                    <div class="accordion" id="dropboxDisplayName">
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Je n'ai pas de compte
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#dropboxDisplayName">
                                <div class="accordion-body">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Entrer un nom d'affichage que les autres joueurs verront">
                                        <label for="displayName" class="form-label">Nom d'affichage</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <input type="submit" value="Rejoindre une salle" class="btn btn-success w-100" id="joinRoom">
                </div>
            </div>
        </form>
        <script src="Code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>