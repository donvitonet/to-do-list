<?php

class CreateTaskController extends BaseController
{
  public function run(Request $request)
  {
    $this->validatorSchema->validate(
      $request->body,
      $this->getValidationRules()['rules'],
      $this->getValidationRules()['required']
    );

    $id = $this->taskModel->create($request->body);
    $task = $this->taskModel->findById($id);

    $this->render('ajax', array(
      'content' => $task
    ));
  }

  private function getValidationRules()
  {
    return array(
      'rules' => array(
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
        'task'
      )
    );
  }
}