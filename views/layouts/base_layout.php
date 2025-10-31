<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page_title ?></title>
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/styles/style.css">
</head>
<body>

<header>
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= $base_path ?>">AuthSystem</a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <?php if (isset($_SESSION['user'])): ?>
              <li class="nav-item">
                <a class="nav-link active" href="/requests/logout_request.php">Выйти</a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link active" href="/views/sign_in.php">Авторизация</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="/views/sign_up.php">Регистрация</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
<?= $content ?>

</body>
</html>
