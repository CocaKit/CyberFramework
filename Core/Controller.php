<?php

namespace Core;

use Core\Response;

class Controller
{
    public function __construct(protected Response $response = new Response()) { }
}