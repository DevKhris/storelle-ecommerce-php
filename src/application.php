<?php

namespace App;

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;

/**
 * Class Application
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 * @package namespace app;
 * @category project
 */

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
        // request instance
        $this->req = new Request();
        // response instance
        $this->res = new Response();
        // router instance
        $this->router = new Router($this->req, $this->res);
    }

    public function execute()
    {
        echo $this->router->resolve();
    }
}
