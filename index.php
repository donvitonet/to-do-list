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
include "src/app/controllers/not-found-controller.php";

$router = new Router();
$router->addRoute(new Route('GET', '/', new HomeController()));
$router->addRoute(new Route('GET', '/tasks', new TasksController()));
$router->addRoute(new Route('GET', '/task', new DetailTaskController()));
$router->addRoute(new Route('POST', '/task', new CreateTaskController()));
$router->addRoute(new Route('PUT', '/task', new UpdateTaskController()));
$router->addRoute(new Route('DELETE', '/task', new DeleteTaskController()));
$router->addRoute(new Route('PATCH', '/task/complete', new CompleteTaskController()));
$router->addRoute(new Route('PATCH', '/task/uncomplete', new UncompleteTaskController()));

$router->dispatch(new Request());