<?php

require_once 'BaseManager.php';
require_once 'src/classes/Opinion.php';

class OpinionManager extends BaseManager {
    protected array $allowedFields = ['id', 'product_id', 'user_id', 'rate', 'description'];
    protected string $tableName = 'Opinion';

    public function insertOpinion(Opinion $opinion) : int {
        return $this->insertObject([
            'product_id' => $opinion->getProductId(),
            'user_id' => $opinion->getUserId(),
            'rate' => $opinion->getRate(),
            'description' => $opinion->getDescription()
        ]);
    }

    public function deleteOpinion($id) {
        $this->deleteObject($id);
    }

    protected function createObject(array $row): Opinion {
        $opinion = new Opinion(
            $row['user_id'],
            $row['product_id'],
            $row['rate'],
            $row['description'],
            $row['id']
        );
        return $opinion;
    }
}
