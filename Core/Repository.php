<?php 

namespace Core;

use Core\Entity;

interface Repository
{
    public function save(Entity $object) : array;

    // public function remove(int $id) : array;

    // public function getAll() : array;

    // public function clear() : array;

    // public function findById(int $id) : array;
}