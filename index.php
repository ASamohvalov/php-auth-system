<?php
session_start();

require_once 'config.php';

config_init();

if (!isset($_SESSION['id'])) {
  header('Location: views/sign_in.php');
  exit;
}

ob_start();
?>

<h1>content!!!</h1>

<?php
$content = ob_get_clean();
$page_title = 'main';

require_once 'views/layouts/base_layout.php';
?>
