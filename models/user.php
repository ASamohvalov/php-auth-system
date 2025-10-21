<?php

require_once '../db/sql_executor.php';

class User
{
  public function __construct(
      public ?int $id,
      public string $email,
      public string $password,
      public string $name,
      public string $surname) {}

  public function save() : void
  {
    $sql_insert = 'insert into users (email, password, name, surname) values (:email, :password, :name, :surname)';
    perfom($sql_insert, [
      'email' => $this->email,
      'password' => password_hash($this->password, PASSWORD_DEFAULT),
      'name' => $this->name,
      'surname' => $this->surname
    ]);
  }

  public function validate_password(string $password) : bool
  {
    return password_verify($password, $this->password);
  }

  public function exists_by_email() : bool
  {
    $sql_select = 'select count(*) as cnt from users where email = :email';
    $result = perfom_and_get($sql_select, ['email' => $this->email]);
    return $result['0']['cnt'] > 0;
  }

  public static function get_by_email(string $email) : ?User
  {
    $sql_select = 'select * from users where email = :email';
    $result_array = perfom_and_get($sql_select, ['email' => $email]);
    if (empty($result_array[0])) {
      return null;
    }
    return new User(
      $result_array[0]['id'],
      $result_array[0]['email'],
      $result_array[0]['password'],
      $result_array[0]['name'],
      $result_array[0]['surname']
    );
  }
}
