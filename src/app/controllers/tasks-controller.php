<?php

class TasksController extends BaseController
{
  public function run($request)
  {
    $criteria = array(
      'orderBy' => array(),
      'where' => array()
    );

    if (array_key_exists('sort', $request->query)) {
      $criteria['orderBy'] = explode(',', $request->query['sort']);
    }



    if (array_key_exists('status', $request->query)) {
      $criteria['where']['complete'] = $request->query['status'];
    }

    $this->render('ajax', array(
      'content' => $this->taskModel->findAll($criteria)
    ));
  }
}