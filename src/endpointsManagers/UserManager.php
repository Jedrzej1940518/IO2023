<?php

require_once 'src/classes/User.php';
require_once 'BaseManager.php';
class UserManager extends BaseManager {
    protected $allowedFields = ['id', 'first_name', 'last_name', 'age', 'address', 'email'];
    protected $tableName = 'User';

    protected function createObject(array $row) : User {
        return new User($row['id'], $row['first_name'], $row['last_name'], $row['age'], $row['address'], $row['email'], $row['password']);
    }
}

?>