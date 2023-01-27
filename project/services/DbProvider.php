<?php

namespace app\services;

use Medoo\Medoo;

class DbProvider{
    /**
     * @var Medoo
     */
    public Medoo $connection;

    public function __construct()
    {
        $this->connection = new Medoo([
            'type' => DB_TYPE,
            'host' => DB_HOST,
            'database' => DB_DATABASE,
            'username' => DB_USERNAME,
            'password' => DB_PASSWORD
        ]);
    }
}
