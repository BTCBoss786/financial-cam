<?php
class DB {

  private static $_instance = null;
  private $_pdo,
          $_stmt,
          $_results,
          $_count = 0,
          $_error = false;

  private function __construct() {
    try {
      $this->_pdo = new PDO("mysql:host=".Config::get("mysql/host").";dbname=".Config::get("mysql/db"), Config::get("mysql/user"), Config::get("mysql/pass"));
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public static function getInstance() {
    if (!isset(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  public function query($sql, $params = []) {
    $this->_error = false;
    if ($this->_stmt = $this->_pdo->prepare($sql)) {
      if (count($params)) {
        $i = 1;
        foreach ($params as $param) {
          $this->_stmt->bindValue($i, $param);
          $i++;
        }
      }
      if ($this->_stmt->execute()) {
        $this->_results = $this->_stmt->fetchAll(PDO::FETCH_OBJ);
        $this->_count = $this->_stmt->rowCount();
      } else {
        $this->_error = true;
      }
    }
    return $this;
  }

  private function action($action, $table, $where = []) {
    if (count($where) == 3) {
      $operators = ["=", ">", "<", ">=", "<="];
      $field = $where[0];
      $operator = $where[1];
      $value = $where[2];
      if (in_array($operator, $operators)) {
        $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
        if (!$this->query($sql, array($value))->error()) {
          return $this;
        }
      }
    }
    return false;
  }

  public function get($table, $where) {
    return $this->action("SELECT *", $table, $where);
  }

  public function delete($table, $where) {
    return $this->action("DELETE", $table, $where);
  }

  public function insert($table, $fields = []) {
    $keys = array_keys($fields);
    $values = null;
    $i = 1;
    foreach ($fields as $field) {
      $values .= "?";
      if ($i < count($fields)) {
        $values .= ', ';
      }
      $i++;
    }
    $sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES ({$values})";
    if (!$this->query($sql, $fields)->error()) {
      return true;
    }
    return false;
  }

  public function update($table, $id, $fields) {
    $set = "";
    $i = 1;
    foreach ($fields as $name => $value) {
      $set .= "{$name} = ?";
      if ($i < count($fields)) {
        $set .= ", ";
      }
      $i++;
    }
    $sql = "UPDATE {$table} SET {$set} WHERE `id` = {$id}";
    if (!$this->query($sql, $fields)->error()) {
      return true;
    }
    return false;
  }

  public function error() {
    return $this->_error;
  }

  public function count() {
    return $this->_count;
  }

  public function results() {
    return $this->_results;
  }

  public function first() {
    return $this->results()[0];
  }

}
