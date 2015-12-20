<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.35
 */

namespace Lux;

/**
 * Interface IMiddleware
 * @package Lux
 */
interface IMiddleware
{
    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    public function handle(Request &$req, Response &$res);
}