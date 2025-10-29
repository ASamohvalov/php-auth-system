<?php
session_start();

require_once '../models/user.php';

function validation(User $user) : void
{
  $is_error = false;
  if (empty($user->email)) {
    $_SESSION['msg']['error']['email'] = 'почта должна быть заполнена';
    error_log('12312');
    $is_error = true;
  }
  if (empty($user->password)) {
    $_SESSION['msg']['error']['password'] = 'пароль должен быть заполнен';
    error_log('12312');
    $is_error = true;
  }
  if (empty($user->name)) {
    $_SESSION['msg']['error']['name'] = 'имя должно быть заполнено';
    error_log('12312');
    $is_error = true;
  }
  if (empty($user->surname)) {
    $_SESSION['msg']['error']['surname'] = 'фамилия должна быть заполнена';
    error_log('12312');
    $is_error = true;
  }
  if ($is_error) {
    error_log('loc');
    header('Location: ../views/sign_up.php');
    exit;
  }  
}

// main
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../views/sign_up.php');
  exit;
}

$user = new User(
  null,
  $_POST['email'],
  $_POST['password'],
  $_POST['name'],
  $_POST['surname']
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
