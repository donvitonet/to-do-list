<?php

class DetailTaskController extends BaseController
{
  private function getRules()
  {
    return array(
      'id' => array(
        'filter' => FILTER_VALIDATE_INT,
        'flags' => FILTER_NULL_ON_FAILURE,
        'options' => array(
          'min_range' => 1,
          'max_range' => PHP_INT_MAX,
        )
      )
    );
  }

  public function run($request)
  {
    $inputs = filter_var_array($request->query, $this->getRules(), true);
    if (array_search(null, $inputs) !== false) {
      throw new Exception('Bad Request');
    }

    $id = $request->query['id'];
    $task = $this->taskModel->findById($id);
    if (!$task) {
      throw new Exception('Task not found');
    }

    $this->render('ajax', array(
      'content' => $task
    ));
  }
}