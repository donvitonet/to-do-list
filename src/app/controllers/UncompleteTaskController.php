<?php

namespace app\controllers;

use infra\http\Request;

class UncompleteTaskController extends BaseController
{
  public function run(Request $request)
  {
    $data = array('id' => $request->params->id);
    $this->validatorSchema->validate(
      $data,
      $this->getValidationRules()['rules'],
      $this->getValidationRules()['required']
    );

    $data['complete'] = 0;
    $this->taskModel->updateById($data);

    $this->render('ajax', array(
      'content' => array()
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