<?php
session_start();

require_once '../utils/functions.php';

ob_start();
?>

<main>
  <div class="text-center mt-5 text-warning"><?= get_error_msg('global') ?></div>
</main>

<?php
$content = ob_get_clean();
$page_title = 'ошибка';

require_once 'layouts/base_layout.php';

if (isset($_SESSION['msg'])) {
  unset($_SESSION['msg']);
}
?>