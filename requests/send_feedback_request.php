<?php

require_once '../models/feedback.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../index.php');
  exit;
}

$feedback = new Feedback(
  null,
  $_POST['title'],
  $_POST['message'],
  $_POST['type'],
  $_POST['rating'],
  $_SESSION['user']['id']
);

$feedback->save();

$_SESSION['msg']['success'] = 'сообщение успешно отправлено';

header('Location: ../index.php');
