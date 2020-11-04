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
    /**
     * contructor function
     *
     * @param [type] $appPath param of application path
     */
    public function __construct($appPath)
    {
        self::$appPath = $appPath;
        $this->req = new Request();
        $this->router = new Router($this->req);
    }

    public function execute()
    {
        echo $this->router->resolve();
    }
}
