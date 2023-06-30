<?php

class BaseController
{
  public $templateEngine;
  public $taskModel;

  public function __construct()
  {
    $this->templateEngine = new TemplateEngine();
    $this->taskModel = new TaskModel();
  }

  public function run($request)
  {
    throw new Exception('Not implemented');
  }

  public function render($template, $data)
  {
    $this->templateEngine->render($template, $data);
  }
}