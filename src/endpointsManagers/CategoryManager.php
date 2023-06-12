<?php

require_once 'src/classes/Category.php';
require_once 'BaseManager.php';
class CategoryManager extends BaseManager {
    protected $allowedFields = ['id', 'name', 'description'];
    protected $tableName = 'Category';

    protected function createObject(array $row) : Category {
        return new Category($row['id'], $row['name'], $row['description']);
    }
}
?>
