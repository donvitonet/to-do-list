<?php

class UpdateTaskController extends BaseController
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
      ),
      'task' => array(
        'filter' => FILTER_CALLBACK,
        'flags' => FILTER_NULL_ON_FAILURE,
        'options' => function ($value) {
          if (strlen($value) >= 1 && strlen($value) <= 45 && !empty($value)) {
            return true;
          }

          return false;
        }
      )
    );
  }

  public function run($request)
  {
    $data = array_merge($request->query, $request->payload);
    $inputs = filter_var_array($data, $this->getRules(), true);
    if (array_search(null, $inputs) !== false) {
      throw new Exception('Bad Request');
    }

    $task = $this->taskModel->findById($data['id']);
    if (!$task) {
      throw new Exception('Task not found');
    }

    $data['done'] = $task['done'];
    $this->taskModel->updateById($data);

    $this->render('ajax', array(
      'content' => $task
    ));
  }
}