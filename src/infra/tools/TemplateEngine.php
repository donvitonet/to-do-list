<?php

namespace infra\tools;

use \Exception;

class TemplateEngine
{
  private $templatePath;

  public function __construct()
  {
    $rootPath = realpath('.');
    $this->templatePath = implode(DIRECTORY_SEPARATOR,  array(
      $rootPath,
      'src',
      'app',
      'views'
    ));
  }

  public function render($template, $data)
  {
    $templateFile = $this->templatePath . '/' . $template . '.php';
    if (!file_exists($templateFile)) {
      throw new Exception('Template not found');
    }

    extract($data);

    ob_start();
    include $templateFile;
    $renderedTemplate = ob_get_clean();

    echo $renderedTemplate;
  }
}
