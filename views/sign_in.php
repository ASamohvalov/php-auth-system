<?php

ob_start()
?>

login page

<?php
$content = ob_get_clean();
$bootstrap_path = '../assets/bootstrap/css/bootstrap.min.css';

require_once 'layouts/base_layout.php';
?>
