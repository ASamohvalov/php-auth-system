<?php

ob_start();
?>

sign in page

<?php
$content = ob_end_clean();
$bootstrap_path = '../assets/bootstrap/css/bootstrap.min.css';

require_once 'layouts/base_layout.php';
?>
