# lux
Modern lightweight PHP microservice framework.

# Goals
- Stay up-to-date with PHP, thus targeting the latest stable build of PHP, as of writing 7.
- Stay simple.
- Stay lightweight, thus not getting caught up in feature creep.
- Stay fun!

# Future goals
- Get some documentation going!

# Features
- Simple handling of GET, POST, PATCH, DELETE and PUT requests.
- Simple and easy to implement middleware, enabling easy modularization.

# Simple example
```PHP
<?php
require("../vendor/autoload.php");

use Lux\Handler;
use Lux\LuxApplication;
use Lux\Request;
use Lux\Response;

$handler = new Handler();

$handler->register("get", "/", function (Request $req, Response $res) {
    return $res->html("<h1>Hello world!</h1>");
});

$handler->register("get", "/{yourName}", function (Request $req, Response $res) {
    return $res->json([
        "hello" => $req->getParam("yourName")
    ]);
});

$handler->register("get", "/{firstName}/{lastName}", function (Request $req, Response $res) {
    $res->redirect("/Simple.php/{$req->getParam("firstName")} {$req->getParam("lastName")}");
});

$handler->register("put", "/{id}", function (Request $req, Response $res) {
    return $res->json([
        "id" => $req->getParam("id"),
        "req_body" => $req->getParam("body")
    ]);
});

$handler->register("delete", "/{id}", function (Request $req, Response $res) {
    $res->status(204);
});

$handler->register("post", "/", function (Request $req, Response $res) {
    return $res->json($req->getParam("body"));
});

LuxApplication::attachHandler($handler);
```

