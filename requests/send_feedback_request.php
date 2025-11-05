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
  htmlspecialchars($_POST['title']),
  htmlspecialchars($_POST['message']),
  $_POST['type'],
  $_POST['rating'],
  $_SESSION['user']['id']
);

$feedback->save();

foreach ($_POST['liked_arr'] as $feedback_like) {
  $feedback_like = new FeedbackLike(null, $feedback->id, $feedback_like);
  $feedback_like->save();
}

$_SESSION['msg']['success'] = 'сообщение успешно отправлено';

header('Location: ../index.php');
