<?php

namespace infra\http;

use Exception;

class Response
{
  public static function sendCreated(int $id)
  {
    if (!$id) {
      throw new Exception("ID not provided");
    }

    Response::send(array(
      'id' => $id
    ), 201);
  }

  public static function sendStatus($httpResponseCode)
  {
    self::send(array(), $httpResponseCode);
  }

  public static function send(
    array $body = array(),
    int $httpResponseCode = 200
  ) {
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($httpResponseCode);

    $noBody = empty($body);
    $containDefaultMessage = in_array($httpResponseCode, array(400, 404, 500));

    if ($noBody && $containDefaultMessage) {
      $body = array(
        'message' => self::getDefaultBodyByCode($httpResponseCode)
      );
    }

    $hasBody = !empty($body);
    if ($hasBody) {
      echo json_encode($body);
    }
  }

  private static function getDefaultBodyByCode($httpResponseCode)
  {
    switch ($httpResponseCode) {
      case 400:
        return "Requisição inválida";
      case 404:
        return "Não encontrado";
      case 500:
        return "Ocorreu um erro ao processar a requisição";
      default:
        throw new Exception("Code not found");
    }
  }
}