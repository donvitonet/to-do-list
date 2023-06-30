<?php

class HomeController extends BaseController
{
  public function run($request)
  {
    $this->render('home', array());
  }
}