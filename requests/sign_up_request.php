<?php
session_start();

require_once '../db/sql_executor.php';

function validation(string $email, string $password, 
    string $name, string $surname) : void
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
  if (empty($name)) {
    $_SESSION['msg']['error']['name'] = 'имя должно быть заполнено';
    $is_error = true;
  }
  if (empty($surname)) {
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

$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];

validation($email, $password, $name, $surname);

// check email unique
$sql_select = 'select count(*) from users where email = :email';
if (!empty(perfom_and_get($sql_select, ['email' => $email]))) {
  $_SESSION['msg']['error']['email'] = 'данная почта уже занята';
  header('Location: ../views/sign_up.php');
  exit;
}

// create user
$sql_insert = 'insert into users (email, password, name, surname) values (:email, :password, :name, :surname)';
perfom($sql_insert, [
  'email' => $email,
  'password' => password_hash($password, PASSWORD_DEFAULT),
  'name' => $name,
  'surname' => $surname
]);

// redirect to login page
header('Location: ../views/sign_in.php');
