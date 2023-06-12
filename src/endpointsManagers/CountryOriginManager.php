<?php

require_once 'BaseManager.php';
require_once 'src/classes/CountryOrigin.php';

class CountryOriginManager extends BaseManager {
    protected array $allowedFields = ['id', 'name'];
    protected string $tableName = 'country_origin';

    public function insertCountryOrigin(CountryOrigin $countryOrigin) {
        return $this->insertObject([
            'name' => $countryOrigin->getName()
        ]);
    }

    public function removeCountryOrigin(int $id) {
        $this->removeObject($id);
    }

    protected function createObject(array $row) : CountryOrigin {
        return new CountryOrigin($row['name'], $row['id']);
    }
}
?>