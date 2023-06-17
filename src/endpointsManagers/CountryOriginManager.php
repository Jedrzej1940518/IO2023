<?php

require_once 'BaseManager.php';
require_once 'src/classes/CountryOrigin.php';

class CountryOriginManager extends BaseManager
{
    protected array $allowedFields = ['id', 'name'];
    protected string $tableName = 'country_origin';

    public function insertCountryOrigin(): void
    {
        $this->insertFromRequest($this->tableName);
    }

    public function getCountries(): void
    {
        $page = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 50;

        $result = $this->fetchFiltered(null, null, $page, $limit);
        echo json_encode(['status' => 'success', 'result' => $result]);
    }

    public function getCountryById(int $id): void
    {
        $country = $this->getObjectBy('id', $id);
        echo json_encode(['status' => 'success', 'country_origin' => $country]);
    }

    public function deleteCountryOrigin(int $id)
    {
        $this->deleteObject($id);
    }

    protected function createObject(array $row): CountryOrigin
    {
        return new CountryOrigin($row['name'], $row['id']);
    }

    public function editCountryOrigin(int $id): void
    {
        $this->updateObjectFromRequest($id, $this->tableName);
    }
}

?>