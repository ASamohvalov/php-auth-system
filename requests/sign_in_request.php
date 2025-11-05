<?php
session_start();

require_once '../models/user.php';
require_once '../utils/functions.php';

function validation(string $email, string $password) : void
{
  $is_error = false;
  if (empty($email)) {
    $_SESSION['msg']['error']['email'] = 'почта должна быть заполнена';
    $is_error = true;
  }
  if (empty($password)) {
    $_SESSION['msg']['error']['password'] = 'пароль должен быть заполнен';
    $is_error = true;
  }
  if ($is_error) {
    header('Location: ../views/sign_in.php');
    exit;
  }  
}

// main
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../views/sign_in.php');
  exit;
}

if (!is_db_connected()) {
  $_SESSION['msg']['error']['global'] = 'ошибка подключения к базе данных, импортируйте бд из файла assets/db/php_auth_system и скорректируйте данные о подключении к бд из файла db/connection.php';
  header('Location: ../views/error.php');
  exit;
}

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

validation($email, $password);

$user = User::get_by_email($email);
if ($user == null || !$user->validate_password($password)) {
  $_SESSION['msg']['error']['global'] = 'неправильная почта или пароль';
  header('Location: ../views/sign_in.php');
  exit;
}

$_SESSION['user']['id'] = $user->id;
$_SESSION['user']['email'] = $user->email;
$_SESSION['user']['name'] = $user->name;
$_SESSION['user']['surname'] = $user->surname;

header('Location: ../index.php');