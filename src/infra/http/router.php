<?php

class Router
{
  private $routes = array();

  public function addRoute(Route $route)
  {
    $this->routes[$route->baseURL] = $route;
  }

  private function getRoute(Request $request)
  {
    if (array_key_exists($request->baseURL, $this->routes)) {
      return $this->routes[$request->baseURL];
    }

    return null;
  }

  public function dispatch(Request $request)
  {
    $route = $this->getRoute($request);
    if ($route) {
      try {
        $route->handler->run($request);
      } catch (\Throwable $th) {
        error_log(print_r($th, true));
      }


      return;
    }

    $notFoundHandler = new NotFoundController();
    $notFoundHandler->run($request);
  }
}