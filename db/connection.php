<?php

/**
* throw PDOException
*/
function get_connection() : PDO
{
  static $conn = null;
  if ($conn === null) {
    $conn = new PDO(
      "mysql:host=localhost;port=3306;dbname=php_auth_system", 
      "root", 
      ""
    );
  }
  return $conn;
}

