<?php

class Product implements \JsonSerializable {

    private int $id;
    private string $name;
    private int $categoryId;
    private float $alcoholContent;
    private string $description;
    private int $countryOriginId;
    private float $price;
    private int $availableAmount;
    private int $rating;

    public function jsonSerialize(): array {
        return get_object_vars($this);
    }

    public function __construct(
        string $name,
        int $categoryId,
        float $alcoholContent,
        string $description,
        int $countryOriginId,
        float $price,
        int $availableAmount,
        int $rating,
        int $id = -1
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->categoryId = $categoryId;
        $this->alcoholContent = $alcoholContent;
        $this->description = $description;
        $this->countryOriginId = $countryOriginId;
        $this->price = $price;
        $this->availableAmount = $availableAmount;
        $this->rating = $rating;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getCategoryId(): int {
        return $this->categoryId;
    }

    public function getAlcoholContent(): float {
        return $this->alcoholContent;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCountryOriginId(): int {
        return $this->countryOriginId;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getAvailableAmount(): int {
        return $this->availableAmount;
    }

    public function getRating(): ?int {
        return $this->rating;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function setAlcoholContent(float $alcoholContent): void
    {
        $this->alcoholContent = $alcoholContent;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setCountryOriginId(int $countryOriginId): void
    {
        $this->countryOriginId = $countryOriginId;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setAvailableAmount(int $availableAmount): void
    {
        $this->availableAmount = $availableAmount;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }
}
