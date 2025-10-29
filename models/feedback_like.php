<?php

require_once __DIR__ . '/../db/sql_executor.php';

class FeedbackLike
{
  public function __construct(
      public ?int $id,
      public int $feedback_id,
      public string $name) {}

  public function save() : void
  {
    $sql_insert = 'insert into feedback_likes (feedback_id, name) values (:feedback_id, :name)';
    perfom($sql_insert, [
      'feedback_id' => $this->feedback_id,
      'name' => $this->name
    ]); 
  } 

  public static function get_likes_by_feedback(int $feedback_id) : array 
  {
    $sql_select = 'select * from feedback_likes where feedback_id = :feedback_id';
    $result_array = perfom_and_get($sql_select, ['feedback_id' => $feedback_id]);
    $ret = [];
    foreach ($result_array as $feedback_like) {
      $ret[] = new FeedbackLike(
        $feedback_like['id'],
        $feedback_like['feedback_id'],
        $feedback_like['name']
      );
    }
    return $ret;
  }
}
