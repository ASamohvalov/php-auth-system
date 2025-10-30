<?php

require_once 'connection.php';

/**
* @desc queries without return result
* @throw RuntimeException
*/
function perfom(string $sql, array $params = []) : void
{
  try {
    $conn = get_connection();
    $stmt = $conn->prepare($sql);
    foreach ($params as $key => $value) {
      $stmt->bindValue($key, $value);
    }
    $stmt->execute();
  } catch (PDOException $e) {
    throw new RuntimeException($e->getMessage());
  }
}

/**
* @desc queries with return result
* @throw RuntimeException
*/
function perfom_and_get(string $sql, array $params = []) : array
{
  try {
    $conn = get_connection();
    $stmt = $conn->prepare($sql);
    foreach ($params as $key => $value) {
      $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    throw new RuntimeException($e->getMessage());
  }
}

/**
* @desc insert queries with return id
* @throw RuntimeException
*/
function insert(string $sql, array $params = []) : int
{
  try {
    $conn = get_connection();
    $stmt = $conn->prepare($sql);
    foreach ($params as $key => $value) {
      $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    return $conn->lastInsertId();
  } catch (PDOException $e) {
    throw new RuntimeException($e->getMessage());
  }
}

