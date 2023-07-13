<?php

namespace app\controllers;

use infra\http\Request;
use infra\http\Response;

class DetailTaskController extends BaseController
{
  public function run(Request $request)
  {
    $id = $request->params->id;

    try {
      $this->validatorSchema->validate(
        array('id' => $id),
        $this->getValidationRules()['rules'],
        $this->getValidationRules()['required']
      );
    } catch (\Throwable $th) {
      Response::sendStatus(400);
      return;
    }

    $task = null;

    try {
      $task = $this->taskModel->findById($id);
    } catch (\Throwable $th) {
      Response::sendStatus(500);
      return;
    }

    if (!$task) {
      Response::send(array(
        'message' => 'Não encontrado.'
      ), 404);
      return;
    }

    Response::send($task);
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