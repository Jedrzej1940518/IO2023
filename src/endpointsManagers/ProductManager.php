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
        'rating',
    ];
    protected string $tableName = 'product';

    public function getProducts(): void
    {
        $filters = $_GET['filters'] ?? null;
        $page = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 50;

        [$filterParts, $params] = $this->processFilters($filters);
        $result = $this->fetchFiltered($filterParts, $params, $page, $limit);
        echo json_encode(['status' => 'success', 'result' => $result]);
    }

    public function getProductById(int $id): void
    {
        $product = $this->getObjectBy('id', $id);
        echo json_encode(['status' => 'success', 'product' => $product]);
    }

    public function insertProduct(): void
    {
        $this->insertFromRequest('product');
    }

    public function editProduct(int $id): void
    {
        $this->updateObjectFromRequest($id, 'product');
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

    private function processFilters(string $filters = null): array
    {
        $filterParts = [];
        $params = [];

        if ($filters) {
            $filters = explode(",", $filters);
            foreach ($filters as $filter) {
                [$key, $value] = explode(":", $filter);
                switch ($key) {
                    case 'name':
                        $filterParts[] = 'name LIKE :name';
                        $params[':name'] = '%' . $value . '%';
                        break;
                    case 'price_min':
                        $filterParts[] = 'price >= :price_min';
                        $params[':price_min'] = (float) $value;
                        break;
                    case 'price_max':
                        $filterParts[] = 'price <= :price_max';
                        $params[':price_max'] = (float) $value;
                        break;
                    case 'alcohol_content_min':
                        $filterParts[] = 'alcohol_content >= :alcohol_content_min';
                        $params[':alcohol_content_min'] = (float) $value;
                        break;
                    case 'alcohol_content_max':
                        $filterParts[] = 'alcohol_content <= :alcohol_content_max';
                        $params[':alcohol_content_max'] = (float) $value;
                        break;
                    case 'category_id':
                        $filterParts[] = 'category_id = :category_id';
                        $params[':category_id'] = (int) $value;
                        break;
                }
            }
        }

        return [$filterParts, $params];
    }
}
