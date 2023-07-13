<?php

namespace app\controllers;

use infra\http\Request;
use infra\http\Response;

class UpdateTaskController extends BaseController
{
  public function run(Request $request)
  {
    $data = array_merge(
      array('id' => $request->params->id),
      $request->body
    );

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

    $task = null;

    try {
      $task = $this->taskModel->findById($data['id']);
    } catch (\Throwable $th) {
      Response::sendStatus(500);
      return;
    }

    if (!$task) {
      Response::sendStatus(404);
      return;
    }

    try {
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