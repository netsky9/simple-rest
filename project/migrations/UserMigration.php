<?php

namespace app\migrations;

/** @var Medoo $database */

use app\services\DbProvider;
use Medoo\Medoo;
use app\models\User;

class UserMigration {

    /**
     * @var Medoo
     */
    private Medoo $dbConnection;

    public function __construct()
    {
        $dbProvider = new DbProvider();
        $this->dbConnection = $dbProvider->connection;
    }

    public function execute(): void
    {
        $this->dbConnection->create("users", [
            "id" => [
                "INT",
                "NOT NULL",
                "AUTO_INCREMENT",
                "PRIMARY KEY"
            ],
            "login" => [
                "VARCHAR(50)",
                "NOT NULL"
            ],
            "password" => [
                "VARCHAR(200)",
                "NOT NULL"
            ],
            "type" => [
                "VARCHAR(50)",
                "NOT NULL"
            ],
        ]);

        $this->createUser(
            'customer1',
            '123',
            User::USER_TYPE_CUSTOMER
        );

        $this->createUser(
            'vendor1',
            '123',
            User::USER_TYPE_VENDOR
        );

        $this->createUser(
            'courier1',
            '123',
            User::USER_TYPE_COURIER
        );
    }

    /**
     * @param string $login
     * @param string $password
     * @param string $type
     */
    public function createUser(string $login, string $password, string $type): void
    {
        $raw = $this->dbConnection
            ->select(
                "users",
                ["login"],
                ["login[=]" => $login]
            );

        if (empty($raw)) {
            $this->dbConnection->insert("users", [
                "login" => $login,
                "password" => User::getPasswordHash($password),
                "type" => $type
            ]);
        }
    }
}
