<?php

class Request
{
  public string $url;
  public string $method;
  public array $query;
  public array $body;
  public stdClass $params;

  public $baseURL;

  public function __construct()
  {
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->url = $_SERVER['REQUEST_URI'];
    $this->query = self::parseQuery($this->url);
    $this->body = self::parseBody();
    $this->baseURL = BaseURL::generate($this->url, $this->method);
    $this->params = self::parseParams($this);
  }

  private static function parseParams(Request $request)
  {
    $params = new stdClass();

    $basePaths = explode('_', $request->baseURL);
    $param = array_search('PARAM', $basePaths);
    if ($param === false) {
      return $params;
    }

    $urlPaths = explode('/', $request->url);
    $urlPaths = array_filter($urlPaths, function($value) {
      return !empty($value);
    });
    $urlPaths = array_values($urlPaths);

    $params->id = $urlPaths[$param - 2];
    return $params;
  }

  private static function parseBody()
  {
    $body = json_decode(file_get_contents('php://input'), true);
    if (empty($body)) {
      return array();
    }

    return $body;
  }

  private static function parseQuery(string $url)
  {
    $query = array();

    if (parse_url($url, PHP_URL_QUERY)) {
      parse_str(parse_url($url, PHP_URL_QUERY), $query);
    }

    return $query;
  }
}