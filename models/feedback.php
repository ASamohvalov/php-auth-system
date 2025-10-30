<?php

require_once __DIR__ . '/../db/sql_executor.php';
require_once __DIR__ . '/feedback_like.php';

class Feedback
{
  public array $feedback_likes = [];
  
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
    $sql_select = <<<EOT
      select 
        feedback.*,
        group_concat(feedback_likes.id) as like_ids,
        group_concat(feedback_likes.name) as like_names
      from feedback
      left join feedback_likes on feedback.id = feedback_likes.feedback_id
      where feedback.user_id = :user_id 
      group by feedback.id
    EOT;

    $result_array = perfom_and_get($sql_select, ['user_id' => $user_id]);
    $ret = [];
    foreach ($result_array as $feedback) {
      $feedback_entity = new Feedback(
        $feedback['id'],
        $feedback['title'],
        $feedback['message'],
        $feedback['request_type'],
        $feedback['rating'],
        $feedback['user_id']
      );
      if (!empty($feedback['like_ids'])) {
        $like_ids = explode(',', $feedback['like_ids']);
        $like_names = explode(',', $feedback['like_names']);

        for ($i = 0; $i < count($like_ids); $i++) {
          $feedback_entity->feedback_likes[] = new FeedbackLike(
            $like_ids[$i], 
            $feedback['id'], 
            $like_names[$i]
          );
        }
      }
      $ret[] = $feedback_entity;
    }
    return $ret;
  }
}


