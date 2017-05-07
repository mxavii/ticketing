<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class BaseController
{
    protected $c;

    public function __construct($c)
    {
        return $this->container = $c;
    }

    public function __get($property)
    {
        return $this->container->{$property};
    }
}
