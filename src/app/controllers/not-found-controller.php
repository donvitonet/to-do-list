<?php

class NotFoundController extends BaseController
{
  public function run($request)
  {
    http_response_code(404);
    $this->render('not-found', array(
      'description' => 'Pagina não encontrada.'
    ));
  }
}