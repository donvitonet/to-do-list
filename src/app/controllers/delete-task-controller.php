<?php

class DeleteTaskController extends BaseController
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

    $this->taskModel->deleteById($request->query);

    $this->render('ajax', array(
      'content' => array()
    ));
  }
}