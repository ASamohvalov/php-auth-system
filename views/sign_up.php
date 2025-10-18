<?php
session_start();

ob_start();
?>

<main>
  <div class="mx-auto bg-dark p-5 shadow" style="width: 500px; margin-top: 10%">
    <div class="fs-4 text-center mb-4">Регистрация</div>
    <form action="../requests/sign_up_request.php" method="post">
      <input 
        type="email" 
        class="form-control <?= isset($_SESSION['msg']['error']['email']) ? 'is-invalid' : '' ?>" 
        placeholder="почта" 
        name="email"
      >
      <div class="text-danger mb-3"><?= $_SESSION['msg']['error']['email'] ?></div>
      <input type="password" 
        class="form-control <?= isset($_SESSION['msg']['error']['email']) ? 'is-invalid' : '' ?>" 
        placeholder="пароль" 
        name="password"
      >
      <div class="text-danger mb-3"><?= $_SESSION['msg']['error']['password'] ?></div>
      <input 
        type="text" 
        class="form-control <?= isset($_SESSION['msg']['error']['name']) ? 'is-invalid' : '' ?>" 
        placeholder="имя" 
        name="name"
      >
      <div class="text-danger mb-3"><?= $_SESSION['msg']['error']['name'] ?></div>
      <input 
        type="text" 
        class="form-control <?= isset($_SESSION['msg']['error']['surname']) ? 'is-invalid' : '' ?>" 
        placeholder="фамилия" 
        name="surname"
      >
      <div class="text-danger mb-3"><?= $_SESSION['msg']['error']['surname'] ?></div>
      <button type="submit" class="btn btn-primary">войти</button>
    </form>
  </div>
</main>

<?php
$content = ob_get_clean();

require_once 'layouts/base_layout.php';

unset($_SESSION['msg']['error']);
?>
