<?php

require_once 'src/classes/Category.php';
require_once 'BaseManager.php';

class CategoryManager extends BaseManager
{
    protected array $allowedFields = ['id', 'name', 'description'];
    protected string $tableName = 'category';

    public function insertCategory(Category $category): int
    {
        return $this->insertObject([
            'name' => $category->getName(),
            'description' => $category->getDescription(),
        ]);
    }

    public function deleteCategory($id)
    {
        $this->deleteObject($id);
    }

    protected function createObject(array $row): Category
    {
        return new Category($row['name'], $row['description'], $row['id']);
    }
}

?>
