<?php

namespace app\models;

class User {

    const USER_TYPE_CUSTOMER = 'customer';
    const USER_TYPE_VENDOR = 'vendor';
    const USER_TYPE_COURIER = 'courier';

    public string $name;
    public string $password;
    public string $type;

    /**
     * @param string $password
     * @return string
     */
    public static function getPasswordHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}