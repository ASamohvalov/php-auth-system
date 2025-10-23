<?php

function int_rating_to_str(int $rating) : string
{
  switch ($rating) {
  case 5:
    return 'Отлично';
  case 4:
    return 'Хорошо';
  case 3:
    return 'Средне';
  case 2:
    return 'Плохо';
  default:
    return '';
  }
}

function en_request_type_to_ru(string $req_type) : string
{
  switch ($req_type) {
  case 'question':
    return 'Вопрос';
  case 'complaint':
    return 'Жалоба';
  case 'suggestion':
    return 'Предложение';
  default:
    return '';
  }
}
