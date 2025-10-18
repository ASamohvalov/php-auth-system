<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../views/sign_in.php');
  exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
  $_SESSION['msg']['error']['email'] = 'почта должна быть заполнена';
  $_SESSION['msg']['error']['password'] = 'пароль должен быть заполнен';
  header('Location: ../views/sign_in.php');
  exit;
}



