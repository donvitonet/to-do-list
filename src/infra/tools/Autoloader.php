<?php
spl_autoload_register(function ($relativeClass) {
  $rootPath = realpath('.');

  $baseDir = implode(DS,  array(
    $rootPath,
    'src',
  )) . DS;

  $file = $baseDir . str_replace('\\', DS, $relativeClass) . '.php';
  if (file_exists($file)) {
    require $file;
  }
});