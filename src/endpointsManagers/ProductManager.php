<?php

require_once 'BaseManager.php';
require_once 'src/classes/Product.php';

class ProductManager extends BaseManager {
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

    public function insertProduct(Product $product) : int {
        return $this->insertObject([
                'name' => $product->getName(),
                'category_id' => $product->getCategoryId(),
                'alcohol_content' => $product->getAlcoholContent(),
                'description' => $product->getDescription(),
                'country_origin_id' => $product->getCountryOriginId(),
                'price' => $product->getPrice(),
                'available_amount' => $product->getAvailableAmount(),
                'rating' => $product->getRating()
                ]);
    }

    public function removeProduct($id) {
        $this->removeObject($id);
    }

    protected function createObject(array $row): Product {
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
