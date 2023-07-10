<?php

class DetailTaskController extends BaseController
{
  public function run(Request $request)
  {
    $id = $request->params->id;

    $this->validatorSchema->validate(
      array('id' => $id),
      $this->getValidationRules()['rules'],
      $this->getValidationRules()['required']
    );

    $task = $this->taskModel->findById($id);
    if (!$task) {
      throw new Exception('Task not found');
    }

    $this->render('ajax', array(
      'content' => $task
    ));
  }

  private function getValidationRules()
  {
    return array(
      'rules' => array(
        'id' => array(
          'filter' => FILTER_VALIDATE_INT,
          'flags' => FILTER_NULL_ON_FAILURE,
          'options' => array(
            'min_range' => 1,
            'max_range' => PHP_INT_MAX,
          )
        )
      ),
      'required' => array(
        'id'
      )
    );
  }
}