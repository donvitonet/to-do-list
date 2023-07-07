<?php

include "src/infra/http/base-url.php";
include "src/infra/http/request.php";
include "src/infra/http/route.php";
include "src/infra/http/router.php";

include "src/infra/mysql/connection.php";
include "src/app/models/task-model.php";

include "src/app/views/template-engine.php";

include "src/app/controllers/base-controller.php";
include "src/app/controllers/home-controller.php";
include "src/app/controllers/tasks-controller.php";
include "src/app/controllers/detail-task-controller.php";
include "src/app/controllers/create-task-controller.php";
include "src/app/controllers/update-task-controller.php";
include "src/app/controllers/delete-task-controller.php";
include "src/app/controllers/complete-task-controller.php";
include "src/app/controllers/uncomplete-task-controller.php";
include "src/app/controllers/cors-controller.php";
include "src/app/controllers/not-found-controller.php";

include "src/infra/tools/validator-schema.php";

include "src/infra/di/container.php";

$container = new DIContainer([
  DatabaseConnection::class,
  TaskModel::class,
  TemplateEngine::class,
  ValidatorSchema::class,
  HomeController::class,
  TasksController::class,
  DetailTaskController::class,
  CreateTaskController::class,
  UpdateTaskController::class,
  DeleteTaskController::class,
  CompleteTaskController::class,
  UncompleteTaskController::class,
  CORSController::class,
  NotFoundController::class,
  Router::class
]);

$router = $container->get(Router::class);
$router->addRoute(new Route('GET', '/', HomeController::class));
$router->addRoute(new Route('GET', '/tasks', TasksController::class));
$router->addRoute(new Route('POST', '/tasks', CreateTaskController::class));
$router->addRoute(new Route('OPTIONS', '/tasks', CORSController::class));

$router->addRoute(new Route('GET', '/task', DetailTaskController::class));
$router->addRoute(new Route('PUT', '/task', UpdateTaskController::class));
$router->addRoute(new Route('DELETE', '/task', DeleteTaskController::class));
$router->addRoute(new Route('PATCH', '/task/complete', CompleteTaskController::class));
$router->addRoute(new Route('PATCH', '/task/uncomplete', UncompleteTaskController::class));

$router->dispatch(new Request());