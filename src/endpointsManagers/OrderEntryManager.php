<?php

require_once 'BaseManager.php';
require_once 'src/classes/OrderEntry.php';

class OrderEntryManager extends BaseManager {
    protected array $allowedFields = ['id', 'order_id', 'amount', 'product_id', 'historic_price'];
    protected string $tableName = 'order_entry';

    public function insertOrderEntry(OrderEntry $orderEntry) : int {
        return $this->insertObject([
            'order_id' => $orderEntry->getOrderId(),
            'amount' => $orderEntry->getAmount(),
            'product_id' => $orderEntry->getProductId(),
            'historic_price' => $orderEntry->getHistoricPrice()
        ]);
    }

    public function deleteOrderEntry($orderId) {
        $this->deleteObject($orderId);
    }

    protected function createObject(array $row): OrderEntry {
        return new OrderEntry(
            $row['id'],
            $row['amount'],
            $row['product_id'],
            $row['historic_price'],
            $row['order_id']
        );
    }
}
