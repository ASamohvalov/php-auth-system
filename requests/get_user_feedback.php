<?php
session_start();

// костыль для обращения из index.php
require_once $_SESSION['config']['base_dir'] . 'models/feedback.php';

function get_user_feedback() : array
{
  return Feedback::get_user_feedbacks($_SESSION['user']['id']); 
}

