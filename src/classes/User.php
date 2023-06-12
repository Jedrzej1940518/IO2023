<?php

class User implements \JsonSerializable {


    private int $id;
    private string $firstName;
    private string $lastName;

    private string $email;
    private int $age;
    private string $address;
    private string $password;


    public function __construct(string $firstName, string $lastName, string $email, int $age, string $address, string $password, int $id = -1) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
        $this->address = $address;
        $this->password = $this->hashPassword($password);
    }

    private function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password);
    }
    public function jsonSerialize(): array {
        return get_object_vars($this);
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

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }


    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }


    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

}

?>
