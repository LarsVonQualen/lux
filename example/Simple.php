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
    return $res->json($req->getParams());
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

$handler->register("get", "/test", function (Request $req, Response $res) {
    return $res->json("sup");
});

$handler->register("get", "/redirect/{var}", function (Request $req, Response $res) {
    $res->redirect("/Simple.php/{$req->getParam("var")}");
});

LuxApplication::attachHandler($handler);