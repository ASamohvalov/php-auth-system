<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('Location: views/sign_in.php');
}

ob_start();
?>

<h1>content!!!</h1>

<?php
$content = ob_get_clean();
$bootstrap_path = 'assets/bootstrap/css/bootstrap.min.css';

require_once "views/layouts/base_layout.php";
?>
