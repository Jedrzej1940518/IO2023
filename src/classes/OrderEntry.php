<?php

class OrderEntry implements \JsonSerializable
{

    private int $id;

    private int $orderId;
    private int $amount;
    private int $productId;
    private float $historicPrice;

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function __construct(int $amount, int $productId, float $historicPrice, int $orderId, int $id = -1)
    {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->amount = $amount;
        $this->productId = $productId;
        $this->historicPrice = $historicPrice;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getHistoricPrice(): float
    {
        return $this->historicPrice;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function setHistoricPrice(float $historicPrice): void
    {
        $this->historicPrice = $historicPrice;
    }
}
