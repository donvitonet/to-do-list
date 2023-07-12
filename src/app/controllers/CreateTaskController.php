<?php

namespace app\controllers;

use \Throwable;
use infra\http\Request;
use infra\http\Response;


class CreateTaskController extends BaseController
{
  public function run(Request $request)
  {
    try {
      $this->validatorSchema->validate(
        $request->body,
        $this->getValidationRules()['rules'],
        $this->getValidationRules()['required']
      );
    } catch (\Throwable $th) {
      Response::send(array(
        'message' => 'Requisição inválida'
      ), 400);
      return;
    }

    try {
      $taskId = $this->taskModel->create($request->body);
      Response::send(array(
        'id' => $taskId
      ), 201);
    } catch (Throwable $th) {
      Response::send(array(
        'message' => 'Ocorreu um erro ao processar a requisição.'
      ), 500);
    }
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