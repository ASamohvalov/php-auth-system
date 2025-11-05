<?php

require_once __DIR__ . '/../models/feedback.php';

function get_user_feedback() : array
{
  return Feedback::get_user_feedbacks($_SESSION['user']['id']); 
}
