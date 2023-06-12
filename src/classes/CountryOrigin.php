<?php

class CountryOrigin implements \JsonSerializable {

    private int $id;
    private string $name;

    public function __construct(string $name, int $id = -1)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function jsonSerialize(): array {
        return get_object_vars($this);
    }
    public function getId() : int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getName() : string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
}