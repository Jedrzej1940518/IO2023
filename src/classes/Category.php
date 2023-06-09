<?php

class Category implements \JsonSerializable {
	
	private int $id;
	private string $description;
	private string $name;

    public function __construct(int $id, string $name, string $description) {
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

    public function jsonSerialize(): array {
        $vars = get_object_vars($this);

        return $vars;
    }
}

?>