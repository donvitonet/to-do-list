<?php

namespace app\controllers;

use infra\http\Request;
use infra\http\Response;

class DeleteTaskController extends BaseController
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
      $this->taskModel->deleteById($data);
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