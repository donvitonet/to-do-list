<?php

class Request
{
  public $url;
  public $method;
  public $query;
  public $payload;

  public $baseURL;

  public function __construct()
  {
    $this->url = $_SERVER['REQUEST_URI'];
    $this->method = $_SERVER['REQUEST_METHOD'];

    $this->payload = json_decode(file_get_contents('php://input'), true);
    if (empty($this->payload)) {
      $this->payload = array();
    }

    if (parse_url($this->url, PHP_URL_QUERY)) {
      parse_str(parse_url($this->url, PHP_URL_QUERY), $this->query);
    } else {
      $this->query = array();
    }

    $this->baseURL = BaseURL::generate($this->url, $this->method);
  }
}