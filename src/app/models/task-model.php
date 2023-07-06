<?php

class TaskModel
{
  private $db;

  public function __construct($container = null)
  {
    $this->db = $container->get(DatabaseConnection::class);
  }

  public function findAll($criteria)
  {
    $orderBy = $this->parseOrderBy($criteria);
    $where = $this->parseWhere($criteria);

    $con = $this->db->openConnection();

    $stmt = $con->prepare("SELECT * FROM tasks $where $orderBy");
    $stmt->execute();

    $rows = $stmt->fetchAll();
    $this->db->closeConnection();

    return $rows;
  }

  public function findById($id)
  {
    $con = $this->db->openConnection();

    $stmt = $con->prepare("SELECT * FROM tasks WHERE id=? LIMIT 1");
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    $this->db->closeConnection();

    return $row;
  }

  public function create($data)
  {
    $con = $this->db->openConnection();

    $stmt = $con->prepare("INSERT INTO tasks (task) VALUES (:task)");
    $stmt->execute($data);

    $id = $con->lastInsertId();

    $this->db->closeConnection();

    return $id;
  }

  public function updateById($data)
  {
    $con = $this->db->openConnection();

    $assignmentList = array();

    if (array_key_exists('task', $data)) {
      $assignmentList[] = "task = :task";
    }

    if (array_key_exists('done', $data)) {
      $assignmentList[] = "done = :done";
    }

    if (empty($assignmentList)) {
      throw new Exception('Assignment list empty');
    }

    $assignmentList = implode(", ", $assignmentList);

    $stmt = $con->prepare("UPDATE tasks SET $assignmentList WHERE id = :id");
    $stmt->execute($data);

    $affected = $stmt->rowCount();

    $this->db->closeConnection();

    return $affected;
  }

  public function deleteById($data)
  {
    $con = $this->db->openConnection();

    $stmt = $con->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute($data);

    $affected = $stmt->rowCount();

    $this->db->closeConnection();

    return $affected;
  }

  private function parseOrderBy($criteria)
  {
    if (!array_key_exists('sort', $criteria)) {
      return "";
    }

    $orderBy = array();

    if ($criteria['sort'] === '+task') {
      $orderBy[] = "task ASC";
    }

    if ($criteria['sort'] === '-task') {
      $orderBy[] = "task DESC";
    }

    if (empty($orderBy)) {
      return "";
    }

    return "ORDER BY " . implode(',', $orderBy);
  }

  private function parseWhere($criteria)
  {
    $where = array();
    if (array_key_exists('status', $criteria)) {
      $value = $criteria['status'] === "true" ? 1 : 0;
      $where[] = "complete = $value";
    }

    if (empty($where)) {
      return "";
    }

    return "WHERE " . implode(" AND", $where);
  }
}