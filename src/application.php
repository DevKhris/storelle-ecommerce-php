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
    public Router $router;
    public Request $req;
    public Response $res;

    public function __construct()
    {
        $this->req = new Request();
        $this->router = new Router($this->req);
    }

    public function execute()
    {
        echo $this->router->resolve();
    }
}
