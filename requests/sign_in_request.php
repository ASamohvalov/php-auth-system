<?php
session_start();

require_once '../db/sql_executor.php';

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

$email = $_POST['email'];
$password = $_POST['password'];

validation($email, $password);

$sql_select = 'select * from users where email = :email';
$result_array = perfom_and_get($sql_select, ['email' => $email]);
if (empty($result_array[0]) || !password_verify($password, $result_array[0]['password'])) {
  $_SESSION['msg']['error']['global'] = 'неправильная почта или пароль';
  header('Location: ../views/sign_in.php');
  exit;
}

// corect data
$_SESSION['user']['id'] = $result_array['id'];
$_SESSION['user']['email'] = $result_array['email'];
$_SESSION['user']['name'] = $result_array['name'];
$_SESSION['user']['surname'] = $result_array['surname'];

header('Location: ../index.php');
