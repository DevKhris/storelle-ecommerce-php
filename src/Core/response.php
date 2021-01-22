<?php

namespace App\Core;

/**
 * Class Response for response management
 *
 * @package RubyNight\App\Core;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
class Response
{
    /**
     * Set http response code from int
     *
     * @param int $code response code
     */
    public function setStatus(int $code)
    {
        // sends response code from int
        return http_response_code($code);
    }
}
