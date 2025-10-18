<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../views/sign_up.php');
  exit;
}

$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];

if (empty($email) || empty($password)) {
  $_SESSION['msg']['error']['email'] = 'почта должна быть заполнена';
  $_SESSION['msg']['error']['password'] = 'пароль должен быть заполнен';
  $_SESSION['msg']['error']['name'] = 'имя должно быть заполнено';
  $_SESSION['msg']['error']['surname'] = 'фамилия должна быть заполнена';
  header('Location: ../views/sign_up.php');
  exit;
}



