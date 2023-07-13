<?php

namespace app\controllers;

use infra\http\Request;
use infra\http\Response;

class TasksController extends BaseController
{
  public function run(Request $request)
  {
    try {
      $this->validatorSchema->validate(
        $request->query,
        $this->getValidationRules()['rules'],
      );
    } catch (\Throwable $th) {
      Response::sendStatus(400);
      return;
    }

    try {
      $results = $this->taskModel->findAll($request->query);
      Response::send($results);
    } catch (\Throwable $th) {
      Response::sendStatus(500);
    }
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