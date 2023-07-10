<?php

include "src/infra/db/connection.php";

include "src/infra/http/base-url.php";
include "src/infra/http/request.php";
include "src/infra/http/route.php";
include "src/infra/http/router.php";

include "src/infra/tools/validator-schema.php";
include "src/infra/tools/di-container.php";
include "src/infra/tools/template-engine.php";

include "src/app/models/task-model.php";

include "src/app/controllers/base-controller.php";
include "src/app/controllers/home-controller.php";
include "src/app/controllers/tasks-controller.php";
include "src/app/controllers/detail-task-controller.php";
include "src/app/controllers/create-task-controller.php";
include "src/app/controllers/update-task-controller.php";
include "src/app/controllers/delete-task-controller.php";
include "src/app/controllers/complete-task-controller.php";
include "src/app/controllers/uncomplete-task-controller.php";
include "src/app/controllers/not-found-controller.php";

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
  NotFoundController::class,
  Router::class
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