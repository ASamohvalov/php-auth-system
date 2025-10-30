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
  $_SESSION['user']['id'],
  null
);

$feedback->save();

if ($_POST['like_design']) {
  $feedback_like = new FeedbackLike(null, $feedback->id, 'Дизайн');
  $feedback_like->save();
}
if ($_POST['like_speed']) {
  $feedback_like = new FeedbackLike(null, $feedback->id, 'Скорость работы');
  $feedback_like->save();
}
if ($_POST['like_content']) {
  $feedback_like = new FeedbackLike(null, $feedback->id, 'Контент');
  $feedback_like->save();
}
if ($_POST['like_convenience']) {
  $feedback_like = new FeedbackLike(null, $feedback->id, 'Удобство навигации');
  $feedback_like->save();
}

$_SESSION['msg']['success'] = 'сообщение успешно отправлено';

header('Location: ../index.php');
