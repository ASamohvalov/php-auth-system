<?php
session_start();

require_once '../models/feedback.php';
require_once '../models/feedback_like.php';

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

// todo
// change save method in feedback
// set id in object after save
if ($_POST['like_design']) {
}
if ($_POST['like_speed']) {
}
if ($_POST['like_content']) {
}
if ($_POST['like_convenience']) {
}

$_SESSION['msg']['success'] = 'сообщение успешно отправлено';

header('Location: ../index.php');
