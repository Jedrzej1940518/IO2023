<?php

require_once 'BaseManager.php';
require_once 'src/classes/Product.php';

class ProductManager extends BaseManager
{
    protected array $allowedFields = [
        'id',
        'name',
        'category_id',
        'alcohol_content',
        'description',
        'country_origin_id',
        'price',
        'available_amount',
        'rating'
    ];
    protected string $tableName = 'product';

    public function getProducts() : void
    {
        $products =  $this->getObjects();
        echo json_encode(['status' => 'success', 'products' => $products]);
    }

    public function getProductById(int $id) : void
    {
        $product =  $this->getObjectBy('id', $id);
        echo json_encode(['status' => 'success', 'product' => $product]);
    }

    public function insertProduct(): void
    {
        $data = $this->fetchDataFromRequest(true);
        $newProductId = $this->insertObject($data);
        echo json_encode(['status' => 'success', 'product_id' => $newProductId]);
    }

    public function editProduct(int $id): void
    {
        $data = $this->fetchDataFromRequest();
        $product = $this->updateObject($id, $data);
        echo json_encode(['status' => 'success', 'product' => $product]);
    }

    public function deleteProduct($id)
    {
        $this->deleteObject($id);
        echo json_encode(['status' => 'success']);
    }

    protected function createObject(array $row): Product
    {
        return new Product(
            $row['name'],
            $row['category_id'],
            $row['alcohol_content'],
            $row['description'],
            $row['country_origin_id'],
            $row['price'],
            $row['available_amount'],
            $row['rating'],
            $row['id']
        );
    }
}
