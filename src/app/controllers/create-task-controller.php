<?php

class CreateTaskController extends BaseController
{
  private function getRules()
  {
    return array(
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
    $inputs = filter_var_array($request->payload, $this->getRules(), true);
    if (array_search(null, $inputs) !== false) {
      throw new Exception('Bad Request');
    }

    $id = $this->taskModel->create($request->payload);
    $task = $this->taskModel->findById($id);

    $this->render('ajax', array(
      'content' => $task
    ));
  }
}