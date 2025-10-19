<?php

require_once 'connection.php';

/**
* @desc queries without return result
*/
function perfom(string $sql, array $params = []) : void
{
  $conn = get_connection();
  $stmt = $conn->prepare($sql);
  foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
  }

}
