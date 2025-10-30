<?php

require_once __DIR__ . '/../db/sql_executor.php';

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
    $this->id = insert($sql_insert, [
      'title' => $this->title,
      'message' => $this->message,
      'request_type' => $this->request_type,
      'rating' => $this->rating,
      'user_id' => $this->user_id
    ]); 
  } 

  public static function get_user_feedbacks(int $user_id) : array 
  {
    $sql_select = 'select * from feedback where user_id = :user_id';
    $result_array = perfom_and_get($sql_select, ['user_id' => $user_id]);
    $ret = [];
    foreach ($result_array as $feedback) {
      $ret[] = new Feedback(
        $feedback['id'],
        $feedback['title'],
        $feedback['message'],
        $feedback['request_type'],
        $feedback['rating'],
        $feedback['user_id']
      );
    }
    return $ret;
  }
}


