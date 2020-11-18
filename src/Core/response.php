<?php
/**
 * Class Request for response management
 * 
 * @package RubyNight\App\Core;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
namespace App\Core;

class Response 
{
    /**
     * [setStatus for http response]
     * 
     * @param int $code [response code]
     */
    public function setStatus(int $code)
    {
        // sends response code from int
        http_response_code($code);
    }
}
?>