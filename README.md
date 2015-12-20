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

$handler->Register("get", "/", function (Request $req, Response $res) {
    return $res->html("<h1>Hello world!</h1>");
});

$handler->Register("get", "/{yourName}", function (Request $req, Response $res) {
    return $res->json([
        "hello" => $req->getParam("yourName")
    ]);
});

LuxApplication::AttachHandler($handler);
```

