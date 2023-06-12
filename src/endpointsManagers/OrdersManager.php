<?php
require_once 'BaseManager.php';
require_once 'src/classes/Orders.php';

class OrdersManager extends BaseManager {
    protected array $allowedFields = ['id', 'order_date', 'user_id', 'state_id'];
    protected string $tableName = 'orders';

    public function insertOrders(Orders $order) : int {
        return $this->insertObject([
            'order_date' => $order->getOrderDate(),
            'user_id' => $order->getUserId(),
            'state_id' => $order->getStateId()
        ]);
    }

    public function removeOrders($id) {
        $this->removeObject($id);
    }

    protected function createObject(array $row): Orders {
        return new Orders(
            $row['order_date'],
            $row['user_id'],
            $row['state_id'],
            $row['id']
        );
    }
}
