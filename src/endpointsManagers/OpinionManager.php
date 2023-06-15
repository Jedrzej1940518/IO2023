<?php

require_once 'BaseManager.php';
require_once 'src/classes/Opinion.php';

class OpinionManager extends BaseManager
{
    protected array $allowedFields = ['id', 'product_id', 'user_id', 'rate', 'description'];
    protected string $tableName = 'Opinion';

    public function insertOpinion()
    {
        $data = $this->fetchDataFromRequest(true);
        $newId = $this->insertObject($data);
        echo json_encode(['status' => 'success', 'opinion_id' => $newId]);
    }

    public function deleteOpinion($id)
    {
        $this->deleteObject($id);
    }

    protected function createObject(array $row): Opinion
    {
        $opinion = new Opinion(
            $row['user_id'],
            $row['product_id'],
            $row['rate'],
            $row['description'],
            $row['id']
        );
        return $opinion;
    }

    public function getOpinions($product_id)
    {
        $result = $this->fetchFiltered(['product_id = :id'], [':id' => $product_id]);
        echo json_encode($result);
    }

    public function updateOpinion($id)
    {
        $data = $this->fetchDataFromRequest();
        $opinion = $this->updateObject($id, $data);
        echo json_encode(['status' => 'success', 'opinion' => $opinion]);
    }
}
