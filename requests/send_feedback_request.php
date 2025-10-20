<?php
session_start();

require_once '../db/sql_executor.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../index.php');
  exit;
}

$title = $_POST['title'];
$message = $_POST['message'];
$request_type = $_POST['type'];
$rating = $_POST['rating'];

$sql_insert = 'insert into feedback (title, message, request_type, rating, user_id)' 
    . 'values (:title, :message, :request_type, :rating, :user_id)';
perfom($sql_insert, [
  'title' => $title,
  'message' => $message,
  'request_type' => $request_type,
  'rating' => $rating,
  'user_id' => $_SESSION['user']['id']
]);

header('Location: ../index.php');
