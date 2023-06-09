<?php

class Opinion implements \JsonSerializable
{
    private int $id;
    private int $productId;
    private User $user;
    private int $rate; //0-5 per opinion
    private string $description;

    public function __construct(User $user, int $productId, int $rate, string $description, int $id = -1)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->user = $user;
        $this->rate = $rate;
        $this->description = $description;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function setRate($rate): void
    {
        $this->rate = $rate;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }
}
