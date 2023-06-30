<?php

class BaseURL
{
  public static function generate($url, $method)
  {
    $segments = explode('/', parse_url($url, PHP_URL_PATH));
    return self::generateBaseURL($method, $segments);
  }

  private static function generateBaseURL($method, $segments)
  {
    $base  = array(
      'HTTP',
      strtoupper($method)
    );
    $base = array_merge($base, $segments);
    return implode('_', $base);
  }
}