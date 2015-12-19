<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.46
 */


use Owlie\Application;
use Owlie\Handler;
use Owlie\Middleware\Auth;
use Owlie\Request;
use Owlie\Response;

require("Config.php");

Application::AddMiddleware(new Auth());

$handler = new Handler();

$handler->Register("get", "/", function (Request $req, Response $res) {
    return $res->json(array(
        "test" => 1337
    ));
});

$handler->Register("get", "/{id}", function (Request $req, Response $res) {
    return $res->json($req->getParams());
});

$handler->Register("post", "/{id}/{someOtherParam}", function (Request $req, Response $res) {
    return $res->json($req->getParams());
});

echo Application::HandleRequest($handler);
