<?php

namespace Core;

use PDO;

class DbConnect
{
    protected PDO $PDOConnect;

    public function __construct()
    {
        $this->PDOConnect = new PDO(parse_ini_file('.env')["PDO_CONNECT"],
                                    parse_ini_file('.env')["PDO_NAME"],
                                    parse_ini_file('.env')["PDO_PASS"]);
    }
}