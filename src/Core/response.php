<?php

namespace App\Core;

/**
 * Class Response
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 * @package namespace app\core;
 */

class Response 
{
    public function setStatus(int $code)
    {
    	http_response_code($code);
   	}
}
?>