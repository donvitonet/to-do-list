<?php

namespace infra\http;

class Response
{
  public static function send(
    array $body = array(),
    int $httpResponseCode = 200
  ) {
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($httpResponseCode);
    echo json_encode($body);
  }
}