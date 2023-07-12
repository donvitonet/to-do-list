<?php

namespace app\controllers;

use infra\http\Request;

class NotFoundController extends BaseController
{
  public function run(Request $request)
  {
    http_response_code(404);
    $this->render('not-found', array(
      'description' => 'Pagina não encontrada.'
    ));
  }
}