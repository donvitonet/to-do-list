<?php

namespace app\controllers;

use \Exception;
use app\models\TaskModel;
use infra\http\Request;
use infra\tools\TemplateEngine;
use infra\tools\ValidatorSchema;

class BaseController
{
  public TaskModel $taskModel;
  public TemplateEngine $templateEngine;
  public ValidatorSchema $validatorSchema;



  public function __construct($container = null)
  {
    $this->validatorSchema = $container->get(ValidatorSchema::class);
    $this->templateEngine = $container->get(TemplateEngine::class);
    $this->taskModel = $container->get(TaskModel::class);
  }

  public function run(Request $request)
  {
    throw new Exception('Not implemented');
  }

  public function render($template, $data)
  {
    $this->templateEngine->render($template, $data);
  }
}