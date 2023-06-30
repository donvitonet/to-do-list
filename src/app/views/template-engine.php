<?php

class TemplateEngine
{
  private $templatePath;

  public function __construct()
  {
    $this->templatePath = dirname(__FILE__);
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
