<?php
session_start();

require_once '../models/user.php';
require_once '../utils/functions.php';

function validation(User $user) : void
{
  $is_error = false;
  if (empty($user->email)) {
    $_SESSION['msg']['error']['email'] = 'почта должна быть заполнена';
    $is_error = true;
  }
  if (empty($user->password)) {
    $_SESSION['msg']['error']['password'] = 'пароль должен быть заполнен';
    $is_error = true;
  }
  if (empty($user->name)) {
    $_SESSION['msg']['error']['name'] = 'имя должно быть заполнено';
    $is_error = true;
  }
  if (empty($user->surname)) {
    $_SESSION['msg']['error']['surname'] = 'фамилия должна быть заполнена';
    $is_error = true;
  }
  if ($is_error) {
    header('Location: ../views/sign_up.php');
    exit;
  }  
}

// main
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../views/sign_up.php');
  exit;
}

if (!is_db_connected()) {
  $_SESSION['msg']['error']['global'] = 'ошибка подключения к базе данных, импортируйте бд из файла assets/db/php_auth_system\nи скорректируйте данные о подключении к бд из файла db/connection.php';
  header('Location: ../views/error.php');
  exit;
}

$user = new User(
  null,
  htmlspecialchars($_POST['email']),
  htmlspecialchars($_POST['password']),
  htmlspecialchars($_POST['name']),
  htmlspecialchars($_POST['surname'])
);
validation($user);

// check email unique
if ($user->exists_by_email()) {
  $_SESSION['msg']['error']['email'] = 'данная почта уже занята';
  header('Location: ../views/sign_up.php');
  exit;
}
$user->save();

// redirect to login page
header('Location: ../views/sign_in.php');