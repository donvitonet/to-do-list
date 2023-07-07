<?php

class CORSController extends BaseController
{
  public function run($request)
  {
    $this->render('ajax', array(
      'content' => array()
    ));
  }
}