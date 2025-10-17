<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Page Title</title>
    <link rel="stylesheet" href="<?= $bootstrap_path ?>">
</head>
<body>

<div class="container">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">AuthSystem</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="">Авторизация</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Регистрация</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>

<?= $content ?>

</body>
</html>
