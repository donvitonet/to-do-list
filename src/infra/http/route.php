<?php

class Route
{
    public $url;
    public $method;
    public $handler;
    public $baseURL;

    public function __construct($method, $url, $handler)
    {
        $this->url = $url;
        $this->method = $method;
        $this->handler = $handler;

        $this->baseURL = BaseURL::generate($url, $method);
    }
}