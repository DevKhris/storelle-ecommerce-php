<?php

namespace App\Core;

/**
 * Class Request for response management
 * 
 * @package RubyNight\App\Core;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

class Response 
{
    public function setStatus(int $code)
    {
        http_response_code($code);
    }
}
?>