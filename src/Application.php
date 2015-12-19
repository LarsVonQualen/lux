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

class Application {
    /**
     * @var array
     */
    private static $_middleWare = array();
    private static $_config = array();

    public static function AddMiddleware(IMiddleware $middleware) {
        array_push(self::$_middleWare, $middleware);
    }

    public static function HandleRequest(Handler $handler) {
        try {
            $req = new Request();
            $res = new Response();

            foreach (self::$_middleWare as $middleWare) {
                /**
                 * @var $middleWare IMiddleware
                 */
                $middleWare->Handle($req, $res);
            }

            $content = $handler->Handle($req, $res);

            $headers = $res->getHeaders();

            foreach ($headers as $key => $value) {
                header("{$key}: {$value}");
            }

            http_response_code($res->getStatus());

            return $content;
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

    public static function set($key, $value) {
        self::$_config[$key] = $value;
    }

    public static function get($key) {
        return self::$_config[$key] ?? null;
    }

    private static function handleError(int $statusCode, \Exception $e) {
        header("Content-Type: application/json");
        http_response_code($statusCode);
        echo json_encode($e->getMessage());
        die();
    }
}