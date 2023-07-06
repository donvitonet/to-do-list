<?php

class BaseController
{
  public $validatorSchema;
  public $templateEngine;
  public $taskModel;

  public function __construct($container = null)
  {
    $this->validatorSchema = $container->get(ValidatorSchema::class);
    $this->templateEngine = $container->get(TemplateEngine::class);
    $this->taskModel = $container->get(TaskModel::class);
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