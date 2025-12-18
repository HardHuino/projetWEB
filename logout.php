<!-- Destruction de session lors de la deconnexion -->
<?php
session_start();
session_unset();
session_destroy();

header("Location: Welcome.php");
exit();
?>