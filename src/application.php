<?php
/**
 * Class MainController for handling rendering and callbacks
 * 
 * @package RubyNight\App;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
namespace App;

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;

class Application
{
    public static string $appPath;
    public Router $router;
    public Request $req;
    public Response $res;
    public static Application $app;
    /**
     * contructor function
     *
     * @param [type] $appPath param of application path
     */
    public function __construct($appPath)
    {
        // self instance and application path
        self::$app = $this;
        self::$appPath = $appPath;
        // new request instance
        $this->req = new Request();
        // new response instance
        $this->res = new Response();
        // new router instance
        $this->router = new Router($this->req, $this->res);
    }

    /**
     * [execute resolves callback]
     * @return [callback] [executes callback from request]
     */
    public function execute()
    {
        // returns resolve
        echo $this->router->resolve();
    }
}
