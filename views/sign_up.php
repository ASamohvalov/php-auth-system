<?php
session_start();

require_once '../utils/functions.php';

ob_start();
?>

<main>
  <div class="mx-auto bg-dark p-5 shadow text-white" style="width: 500px; margin-top: 10%">
    <div class="fs-4 text-center mb-4 text-while">Регистрация</div>
    <form action="../requests/sign_up_request.php" method="post">
      <input 
        type="email" 
        class="form-control <?= get_error_msg('email') == '' ? '' : 'is-invalid' ?>" 
        placeholder="почта" 
        name="email"
      >
      <div class="text-danger mb-3"><?= get_error_msg('email') ?></div>
      <input type="password" 
        class="form-control <?= get_error_msg('password') == '' ? '' : 'is-invalid' ?>" 
        placeholder="пароль" 
        name="password"
      >
      <div class="text-danger mb-3"><?= get_error_msg('password') ?></div>
      <input 
        type="text" 
        class="form-control <?= get_error_msg('name') == '' ? '' : 'is-invalid' ?>" 
        placeholder="имя" 
        name="name"
      >
      <div class="text-danger mb-3"><?= get_error_msg('name') ?></div>
      <input 
        type="text" 
        class="form-control <?= get_error_msg('surname') == '' ? '' : 'is-invalid' ?>" 
        placeholder="фамилия" 
        name="surname"
      >
      <div class="text-danger mb-3"><?= get_error_msg('surname') ?></div>
      <div class="text-danger mb-3"><?= get_error_msg('global') ?></div>
      <button type="submit" class="btn btn-primary">войти</button>
    </form>
  </div>
</main>

<?php
$content = ob_get_clean();
$page_title = 'регистрация';

require_once 'layouts/base_layout.php';

if (isset($_SESSION['msg']['error'])) {
  unset($_SESSION['msg']['error']);
}
?>
