<?php

class UncompleteTaskController extends BaseController
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
    $data = $request->query;
    $inputs = filter_var_array($data, $this->getRules(), true);
    if (array_search(null, $inputs) !== false) {
      throw new Exception('Bad Request');
    }

    $data['done'] = false;
    $this->taskModel->updateById($data);

    $this->render('ajax', array(
      'content' => array()
    ));
  }
}