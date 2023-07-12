<?php

use infra\http\Route;
use infra\http\Request;
use infra\http\Router;

use app\controllers\HomeController;
use app\controllers\TasksController;
use app\controllers\DetailTaskController;
use app\controllers\CreateTaskController;
use app\controllers\UpdateTaskController;
use app\controllers\DeleteTaskController;
use app\controllers\CompleteTaskController;
use app\controllers\UncompleteTaskController;
use app\controllers\NotFoundController;

include "src/infra/Constants.php";
include "src/infra/tools/Autoloader.php";

$container = new infra\tools\Container([
  infra\db\Connection::class,
  app\models\TaskModel::class,
  infra\tools\TemplateEngine::class,
  infra\tools\ValidatorSchema::class,
  HomeController::class,
  TasksController::class,
  DetailTaskController::class,
  CreateTaskController::class,
  UpdateTaskController::class,
  DeleteTaskController::class,
  CompleteTaskController::class,
  UncompleteTaskController::class,
  NotFoundController::class,
  infra\http\Router::class
]);

$router = $container->get(Router::class);
$router->addRoute(new Route('GET', '/', HomeController::class));
$router->addRoute(new Route('GET', '/tasks', TasksController::class));
$router->addRoute(new Route('POST', '/tasks', CreateTaskController::class));
$router->addRoute(new Route('GET', '/tasks/:id', DetailTaskController::class));
$router->addRoute(new Route('PUT', '/tasks/:id', UpdateTaskController::class));
$router->addRoute(new Route('DELETE', '/tasks/:id', DeleteTaskController::class));
$router->addRoute(new Route('PATCH', '/tasks/:id/complete', CompleteTaskController::class));
$router->addRoute(new Route('PATCH', '/tasks/:id/uncomplete', UncompleteTaskController::class));

$router->dispatch(new Request());