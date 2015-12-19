<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 19/12/2015
 * Time: 11.58
 */

use Owlie\Application;
use Owlie\Middleware\JsonBodyParser;
use Owlie\Middleware\ApiVersionMiddleware;
use Owlie\Middleware\QueryStringParser;

require("../Bootstrap.php");

Application::set("JWT_SECRET", "CykelKaj90");
Application::set("JWT_ALGORITHMS", ["HS256"]);

Application::AddMiddleware(new JsonBodyParser());
Application::AddMiddleware(new QueryStringParser());
Application::AddMiddleware(new ApiVersionMiddleware());
