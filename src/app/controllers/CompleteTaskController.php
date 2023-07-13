<?php

namespace app\controllers;

use infra\http\Request;
use infra\http\Response;

class CompleteTaskController extends BaseController
{
  public function run(Request $request)
  {
    $data = array('id' => $request->params->id);

    try {
      $this->validatorSchema->validate(
        $data,
        $this->getValidationRules()['rules'],
        $this->getValidationRules()['required']
      );
    } catch (\Throwable $th) {
      Response::sendStatus(400);
      return;
    }

    try {
      $data['complete'] = 1;
      $this->taskModel->updateById($data);
    } catch (\Throwable $th) {
      Response::sendStatus(500);
      return;
    }

    Response::sendStatus(204);
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