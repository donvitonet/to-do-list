<?php

class TasksController extends BaseController
{
  private $statusMap = array(
    'complete' => TaskModel::STATUS_COMPLETE,
    'uncomplete' => TaskModel::STATUS_UNCOMPLETE
  );

  public function run($request)
  {
    $criteria = array(
      'orderBy' => array(),
      'where' => array()
    );

    if (array_key_exists('sort', $request->query)) {
      $criteria['orderBy'] = explode(',', $request->query['sort']);
    }

    if (array_key_exists('status', $request->query)) {
      $taskStatus = strtolower($request->query['status']);
      $criteria['where']['done'] = $this->statusMap[$taskStatus];
    }

    $this->render('ajax', array(
      'content' => $this->taskModel->findAll($criteria)
    ));
  }
}