<?php

namespace Core;

use Attribute;

#[Attribute]
class Route
{
    public function __construct(
        private string $method = 'GET',
        private string $path = '//temp//',
    ) { }
}