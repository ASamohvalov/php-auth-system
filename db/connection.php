<?php

/**
* @throw PDOException
* @return PDO
*/
function get_connection() : PDO
{
  static $conn = null;
  if ($conn === null) {
    $host = 'localhost';
    $port = 3306;
    $name = 'php_auth_system';
    $user = 'root';
    $password = '';

    $conn = new PDO(
      "mysql:host=$host;port=$port;dbname=$name", 
      $user, 
      $password
    );
  }
  return $conn;
}
