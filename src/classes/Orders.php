<?php

class Orders implements \JsonSerializable {

    private int $id;
    private $orderDate;
    private int $userId;
    private string $stateId;

    // State constants
    public const ORDER_STARTED = 0;
    public const AWAITING_PAYMENT = 1;
    public const PAYMENT_FAILED = 2;
    public const ORDER_FINISHED = 3;

    public function jsonSerialize(): array {
        return get_object_vars($this);
    }

    public function __construct($orderDate, int $userId, $stateId = self::ORDER_STARTED, int $id = -1) {
        $this->id = $id;
        $this->orderDate = $orderDate;
        $this->userId = $userId;
        $this->stateId = $stateId;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getOrderDate() {
        return $this->orderDate;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getStateId(): string {
        return $this->stateId;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function setOrderDate($orderDate): void
    {
        $this->orderDate = $orderDate;
    }


    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }


    public function setStateId(string $stateId): void
    {
        $this->stateId = $stateId;
    }
}

