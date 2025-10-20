<?php
session_start();

require_once '../db/sql_executor.php';


function get_user_feedbacks() : array
{
  $sql_select = 'select * from feedback where user_id = :user_id';
  $result_array = perfom_and_get($sql_select, [
    'user_id' => $_SESSION['user']['id']
  ]);
  return $result_array;
}

function send_feedback() : void
{
}
