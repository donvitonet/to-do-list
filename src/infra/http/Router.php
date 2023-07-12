<?php

namespace infra\http;

class Router
{
  private $container;
  private $routes = array();


  public function __construct($container = null)
  {
    $this->container = $container;
  }

  public function addRoute(Route $route)
  {
    $this->routes[$route->baseURL] = $route;
  }

  private function getHandler(Request $request)
  {
    if (array_key_exists($request->baseURL, $this->routes)) {
      return $this->routes[$request->baseURL]->handler;
    }

    return NotFoundController::class;
  }

  public function dispatch(Request $request)
  {
    $handler = $this->getHandler($request);
    $this->container->get($handler)->run($request);
  }
}