<?php

require_once 'BaseManager.php';
require_once 'src/classes/Opinion.php';
require_once 'src/endpointsManagers/UserManager.php';

class OpinionManager extends BaseManager
{
    protected array $allowedFields = ['id', 'product_id', 'user_id', 'rate', 'description'];
    protected string $tableName = 'Opinion';

    private UserManager $userManager;

    public function __construct(PDO $dbh, UserManager $userManager)
    {
        $this->dbh = $dbh;
        $this->userManager = $userManager;
    }

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
            $this->userManager->getObjectBy("id", $row['product_id']),
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
