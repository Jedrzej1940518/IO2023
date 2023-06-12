<?php

require_once 'src/classes/User.php';
require_once 'BaseManager.php';
class UserManager extends BaseManager {
    protected array $allowedFields = ['id', 'first_name', 'last_name', 'email', 'age', 'address'];
    protected string $tableName = 'user';
    public function insertUser(User $user) : int {
        return $this->insertObject(array(  'first_name' => $user->getFirstName(),
                                    'last_name' => $user->getLastName(),
                                    'age' => $user->getAge(),
                                    'address' => $user->getAddress(),
                                    'email' => $user->getEmail(),
                                    'password' => $user->getPassword()));
    }
    public function removeUser($id) {
        $this->removeObject($id);
    }
    protected function createObject(array $row) : User {
        return new User($row['first_name'], $row['last_name'], $row['email'], $row['age'], $row['address'], $row['password'], $row['id']);
    }
}

?>