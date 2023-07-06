<?php

class TasksController extends BaseController
{
  public function run($request)
  {
    $this->validatorSchema->validate(
      $request->query,
      $this->getValidationRules()['rules']
    );

    $results = $this->taskModel->findAll($request->query);

    $this->render('ajax', array(
      'content' => $results
    ));
  }

  private function getValidationRules()
  {
    return array(
      'rules' => array(
        'status' => array(
          'filter' => FILTER_CALLBACK,
          'flags' => FILTER_NULL_ON_FAILURE,
          'options' => function ($value) {
            if (empty($value)) {
              return false;
            }

            return in_array($value, array('true', 'false'));
          }
        ),
        'sort' => array(
          'filter' => FILTER_CALLBACK,
          'flags' => FILTER_NULL_ON_FAILURE,
          'options' => function ($value) {
            if (empty($value)) {
              return false;
            }

            return in_array($value, array('-task', '+task'));
          }
        )
      )
    );
  }
}