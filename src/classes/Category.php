<?php

class Category implements \JsonSerializable {

	
	private int $id;
	private string $description;
	private string $name;
    public function jsonSerialize(): array {
        return get_object_vars($this);
    }
    public function __construct(string $name, string $description, int $id = -1) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getDescription() : string {
        return $this->description;
    }

	public function getID() : int {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

?>