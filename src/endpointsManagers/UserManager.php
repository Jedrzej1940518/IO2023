<?php

require_once 'src/classes/User.php';
require_once 'BaseManager.php';

class UserManager extends BaseManager
{
    protected array $allowedFields = ['id', 'first_name', 'last_name', 'email', 'age', 'address', 'password'];
    protected string $tableName = 'user';

    public function register()
    {
        $data = $this->fetchDataFromRequest(true);
        $data['password'] = User::hashPassword($data['password']);
        $user = $this->insertObject($data);
        echo json_encode(['status' => 'success', 'user' => $user]);
    }

    public function login()
    {
        $data = $this->fetchDataFromRequest();
        if (!$data['email'] || !$data['password']) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing email or password']);
            return;
        }
        $user = $this->getObjectBy("email", $data['email']);
        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid email!']);
            return;
        }
        if (!$user->verifyPassword($data['password'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid password!', 'password' => $data['password'], 'user' => $user]);
            return;
        }
        $_SESSION['user'] = $user;
        echo json_encode(['status' => 'success', 'user' => $user]);
    }

    public function me($id)
    {
        $user = $this->getObjectBy("id", $id);
        if(!$user)
        {
            http_response_code(401);
            echo json_encode(['error' => 'No user with this id!', 'id' => $id]);
        }
        echo json_encode(['status' => 'success', 'user' => $user]);
    }

    public function insertUser(User $user): int
    {
        return $this->insertObject([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'age' => $user->getAge(),
            'address' => $user->getAddress(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);
    }

    public function deleteUser($id)
    {
        $this->deleteObject($id);
    }

    protected function createObject(array $row): User
    {
        return new User(
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            $row['age'],
            $row['address'],
            $row['password'],
            $row['id']
        );
    }
}

?>