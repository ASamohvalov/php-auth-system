<?php

require_once '../db/sql_executor.php';

class Feedback
{
  public function __construct(
      public ?int $id,
      public string $title,
      public string $message,
      public string $request_type,
      public int $rating,
      public int $user_id) {}

  public function save() : void
  {
    $sql_insert = 'insert into feedback (title, message, request_type, rating, user_id)' 
      . 'values (:title, :message, :request_type, :rating, :user_id)';
    perfom($sql_insert, [
      'title' => $this->title,
      'message' => $this->message,
      'request_type' => $this->request_type,
      'rating' => $this->rating,
      'user_id' => $this->user_id
    ]); 
  } 

  public static function get_user_feedbacks(int $user_id) : Feedback 
  {
    $sql_select = 'select * from feedback where user_id = :user_id';
    $result_array = perfom_and_get($sql_select, ['user_id' => $user_id]);
    return new Feedback(
      $result_array[0]['id'],
      $result_array[0]['titile'],
      $result_array[0]['message'],
      $result_array[0]['request_type'],
      $result_array[0]['rating'],
      $result_array[0]['user_id']
    );
  }
}


