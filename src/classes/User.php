<?php

class User implements \JsonSerializable {

    private int $id;
    private string $firstName;
    private string $lastName;
    private int $age;
    private string $address;
    private string $password;

    public function __construct(int $id, string $firstName, string $lastName, int $age, string $address, string $password) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->address = $address;
        $this->password = $this->hashPassword($password);
    }

    private function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getAge(): int {
        return $this->age;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password);
    }

    public function jsonSerialize(): array {
        $userVars = get_object_vars($this);
        unset($userVars['password']);
        return $userVars;
    }
}

?>
