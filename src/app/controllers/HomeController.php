<?php

namespace app\controllers;

use infra\http\Request;

class HomeController extends BaseController
{
  public function run(Request $request)
  {
    $this->render('home', array());
  }
}