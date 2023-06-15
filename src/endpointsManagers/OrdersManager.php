<?php

require_once 'BaseManager.php';
require_once 'src/classes/Orders.php';

class OrdersManager extends BaseManager
{
    protected array $allowedFields = ['id', 'order_date', 'user_id', 'state_id'];
    protected string $tableName = 'orders';

    public function insertOrder()
    {
        $this->insertFromRequest('order');
    }

    public function deleteOrder($id)
    {
        $this->deleteObject($id);
    }

    protected function createObject(array $row): Orders
    {
        return new Orders(
            $row['order_date'],
            $row['user_id'],
            $row['state_id'],
            $row['id']
        );
    }

    private function getUser(): User|false
    {
        return $_SESSION['user'] ?? false;
    }

    public function getOrders()
    {
        if (!($user = $this->getUser())) {
            http_response_code(401);
            echo json_encode(['error' => 'User not logged in!']);
        }

        $result = $this->fetchFiltered(['user_id = :id'], [':id' => $user->getId()]);
        echo json_encode($result);
    }

    public function getOrder($id)
    {
        if (!($user = $this->getUser())) {
            http_response_code(401);
            echo json_encode(['error' => 'User not logged in!']);
        }

        $result = $this->fetchFiltered(['user_id = :user_id', 'id = :id'], [':user_id' => $user->getId(), ':id' => $id]
        );
        echo json_encode($result);
    }

    public function updateOrder($id)
    {
        $this->updateObjectFromRequest($id, 'order');
    }
}
