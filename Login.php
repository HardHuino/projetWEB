
<!DOCTYPE html>
<?php
session_start();
include 'dbconnect.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Connexion
        $username = mysqli_real_escape_string($bdd, $_POST['username']);
        $password = $_POST['password'];

        $query = "SELECT password FROM accounts WHERE username = '$username'";
        $result = mysqli_query($bdd, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                header("Location: Welcome.php");
                exit();
            } else {
                $error = "Mot de passe incorrect.";
            }
        } else {
            $error = "Utilisateur non trouvé.";
        }
    } elseif (isset($_POST['newEmail']) && isset($_POST['newUsername']) && isset($_POST['newPassword'])) {
        // Inscription
        $email = mysqli_real_escape_string($bdd, $_POST['newEmail']);
        $username = mysqli_real_escape_string($bdd, $_POST['newUsername']);
        $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

        $query = "INSERT INTO accounts (email, username, password) VALUES ('$email', '$username', '$password')";
        if (mysqli_query($bdd, $query)) {
            $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        } else {
            $error = "Erreur lors de l'inscription: " . mysqli_error($bdd);
        }
    }
}
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="icon" type="image/png" href="img/logo.png"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href="Style.css" rel="stylesheet"/>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg py-2" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand fs-2" href="Welcome.php">
                    <img src="img/logo.png" alt="Logo" width="10%" height="10%" class="d-inline-block align-text-top me-2">
                    <h1>King'O'Quiz</h1>
                </a>
            </div>
        </nav>
        
        <?php if ($error): ?>
        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
        <div class="alert alert-success text-center"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <!-- LOGIN -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                <div class="container d-flex justify-content-center align-items-center min-vh-100">
                    <div class="card form-card">
                        <div class="card-header">
                            <h2 class="text-center">Connexion</h2>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" METHOD="POST" action="Login.php" novalidate>
                                <div class="mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Entrer votre nom d'utilisateur" required>
                                        <label for="username" class="form-label">Nom d'utilisateur</label>
                                        <div class="invalid-feedback">
                                            Veuillez entrer votre nom d'utilisateur.
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrer votre mot de passe" required>
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <div class="invalid-feedback">
                                            Veuillez entrer votre mot de passe.
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="Se connecter" class="btn btn-success w-100" id="loginButton">
                                <p class="text-center mt-2">Tu n'as pas de compte ? <a href="#" id="showRegister" onclick="toggleForms()">Inscris-toi</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- REGISTER -->
            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                <div class="container d-flex justify-content-center align-items-center min-vh-100">
                    <div class="card form-card">
                        <div class="card-header">
                            <h2 class="text-center">Inscription</h2>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" METHOD="POST" action="Login.php" novalidate>
                                <div class="mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="Entrez votre e-mail" required>
                                        <label for="newEmail" class="form-label">E-mail</label>
                                        <div class="invalid-feedback">
                                            Veuillez entrer votre e-mail.
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="newUsername" name="newUsername" placeholder="Choisissez un nom d'utilisateur" required>
                                        <label for="newUsername" class="form-label">Nom d'utilisateur</label>
                                        <div class="invalid-feedback">
                                            Veuillez choisir un nom d'utilisateur.
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Choisissez un mot de passe" required>
                                        <label for="newPassword" class="form-label">Mot de passe</label>
                                        <div class="invalid-feedback">
                                            Veuillez choisir un mot de passe.
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="S'inscrire" class="btn btn-success w-100" id="registerButton">
                                <p class="text-center mt-2">Tu as déjà un compte ? <a href="#" id="showLogin" onclick="toggleForms()">Connecte-toi</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="Code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>