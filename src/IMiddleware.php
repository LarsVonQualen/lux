<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.35
 */

namespace Owlie;

interface IMiddleware {
    public function Handle(Request &$req, Response &$res);
}