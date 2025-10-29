<?php
session_start();

require_once 'config.php';
require_once 'requests/get_user_feedback.php';
require_once 'utils/functions.php';

config_init();

if (!isset($_SESSION['user'])) {
  header('Location: views/sign_in.php');
  exit;
}

$feedback_array = get_user_feedback();

ob_start();
?>

<div class="container mt-5 text-white">
  <h2>Форма обратной связи</h2>
  <form action="requests/send_feedback_request.php" method="post">
    <div class="mb-3">
      <label for="name" class="form-label">Тема обращения</label>
      <input type="text" class="form-control" id="name" name="title" required>
    </div>

    <div class="mb-3">
      <label for="message" class="form-label">Сообщение</label>
      <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Что понравилось на сайте</label><br>
      <input class="form-check-input" type="checkbox" name="like_design"> Дизайн
      <input class="form-check-input" type="checkbox" name="like_speed"> Скорость работы 
      <input class="form-check-input" type="checkbox" name="like_content"> Контент 
      <input class="form-check-input" type="checkbox" name="like_convenience"> Удобство навигации
    </div>

    <div class="mb-3">
      <label class="form-label">Тип обращения</label><br>
      <input type="radio" name="type" value="question" required> Вопрос
      <input type="radio" name="type" value="complaint" required> Жалоба
      <input type="radio" name="type" value="suggestion" required> Предложение
    </div>

    <div class="mb-3">
      <label for="rating" class="form-label">Оцените сайт</label>
      <select class="form-select" name="rating" id="rating">
        <option value="5">Отлично</option>
        <option value="4">Хорошо</option>
        <option value="3">Средне</option>
        <option value="2">Плохо</option>
      </select>
    </div>


    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" id="consent" name="consent" required>
      <label class="form-check-label" for="consent">Согласен с обработкой данных</label>
    </div>

    <button type="reset" class="btn btn-secondary">Сбросить</button>
    <button type="submit" class="btn btn-primary">Отправить</button>
  </form>

  <div class="text-success mt-4" style="width: 500px">
    <?= isset($_SESSION['msg']['success']) ? $_SESSION['msg']['success'] : '' ?>
  </div>

  <div class="mt-5">
    <h2>Оставленные формы</h2>
    <?php foreach ($feedback_array as $feedback): ?>
    <div class="mt-3 border border-secondary rounded-4 p-3 text-break">
      <div class="h4"><?= $feedback->title ?></div>
      <div class="mb-2"><?= $feedback->message ?></div>
      <div>
        <span class="text-secondary">Тип обращения - </span>
        <?= en_request_type_to_ru($feedback->request_type) ?>
      </div>
      <div>
        <span class="text-secondary">Оценка сайта - </span>
        <?= int_rating_to_str($feedback->rating) ?>
      </div>
    </div>   
    <?php endforeach; ?> 
  </div>
</div>

<?php
$content = ob_get_clean();
$page_title = 'обратная связь';

require_once 'views/layouts/base_layout.php';

if (isset($_SESSION['msg'])) {
  unset($_SESSION['msg']);
}
?>
