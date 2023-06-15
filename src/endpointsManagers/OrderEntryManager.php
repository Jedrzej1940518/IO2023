<?php

require_once 'BaseManager.php';
require_once 'src/classes/OrderEntry.php';

class OrderEntryManager extends BaseManager
{
    protected array $allowedFields = ['id', 'order_id', 'amount', 'product_id', 'historic_price'];
    protected string $tableName = 'order_entry';

    public function insertOrderEntry($id)
    {
        $data = $this->fetchDataFromRequest(true);
        $data['order_id'] = $id;
        $newId = $this->insertObject($data);
        echo json_encode(['status' => 'success', 'order_entry_id' => $newId]);
    }

    public function deleteOrderEntry($id, $product_id)
    {
        $this->deleteObject($id, 'product_id = :product_id', ['product_id' => $product_id]);
    }

    protected function createObject(array $row): OrderEntry
    {
        return new OrderEntry(
            $row['id'],
            $row['amount'],
            $row['product_id'],
            $row['historic_price'],
            $row['order_id']
        );
    }

    public function getOrderEntries($id)
    {
        $result = $this->fetchFiltered(['order_id = :id'], [':id' => $id]);
        echo json_encode($result);
    }

    public function updateOrderEntry($id, $product_id)
    {
        $data = $this->fetchDataFromRequest();
        $orderEntry = $this->updateObject($id, $data, 'product_id = :product_id', ['product_id' => $product_id]);
        echo json_encode(['status' => 'success', 'order_entry' => $orderEntry]);
    }
}
