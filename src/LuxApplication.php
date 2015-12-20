<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.33
 */

namespace Lux;

use Lux\Exceptions\NotFoundException;
use Lux\Exceptions\NotImplementedException;
use Lux\Exceptions\UnauthorizedException;
use Lux\Middleware\JsonBodyParser;
use Lux\Middleware\QueryStringParser;

/**
 * Class LuxApplication
 * @package Lux
 */
class LuxApplication
{
    /**
     * @var array
     */
    private static $_middleWare = array();
    /**
     * @var array
     */
    private static $_config = array();

    /**
     * @param IMiddleware $middleware
     */
    public static function useMiddleware(IMiddleware $middleware) {
        array_push(self::$_middleWare, $middleware);
    }

    /**
     * @param Handler $handler
     */
    public static function attachHandler(Handler $handler) {
        try {
            self::useMiddleware(new JsonBodyParser());
            self::useMiddleware(new QueryStringParser());

            $req = new Request();
            $res = new Response();

            foreach (self::$_middleWare as $middleWare) {
                /**
                 * @var $middleWare IMiddleware
                 */
                $middleWare->handle($req, $res);
            }

            $content = $handler->handle($req, $res);

            $headers = $res->getHeaders();

            foreach ($headers as $key => $value) {
                header("{$key}: {$value}");
            }

            http_response_code($res->getStatus());

            echo $content;
        } catch (NotImplementedException $e) {
            self::handleError(500, $e);
        } catch (NotFoundException $e) {
            self::handleError(404, $e);
        } catch (UnauthorizedException $e) {
            self::handleError(403, $e);
        } catch (\Exception $e) {
            self::handleError(500, $e);
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public static function set($key, $value) {
        self::$_config[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function get($key) {
        return self::$_config[$key] ?? null;
    }

    /**
     * @param int $statusCode
     * @param \Exception $e
     */
    private static function handleError(int $statusCode, \Exception $e) {
        header("Content-Type: application/json");
        http_response_code($statusCode);
        echo json_encode($e->getMessage());
        die();
    }
}