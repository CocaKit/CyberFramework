<?php

namespace Config;

use Controller\MainController;
use Controller\UserController;

class Links 
{
    public function __construct(
        private array $controllers = [
            MainController::class,
            UserController::class,
        ]
    ) {}

    public function getAll() : array
    {
        return $this->controllers;
    }
}