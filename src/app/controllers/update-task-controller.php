<?php

class UpdateTaskController extends BaseController
{
  public function run(Request $request)
  {
    $data = array_merge(
      array('id' => $request->params->id),
      $request->body
    );

    $this->validatorSchema->validate(
      $data,
      $this->getValidationRules()['rules'],
      $this->getValidationRules()['required']
    );

    $task = $this->taskModel->findById($data['id']);
    if (!$task) {
      throw new Exception('Task not found');
    }

    $this->taskModel->updateById($data);

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
      ),
      'required' => array(
        'id',
        'task'
      )
    );
  }
}