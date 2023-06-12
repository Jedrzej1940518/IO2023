<?php

require_once 'src/classes/Category.php';
require_once 'src/classes/User.php';
require_once 'src/classes/CountryOrigin.php';
require_once 'src/classes/OrderEntry.php';
require_once 'src/classes/Orders.php';
require_once 'src/classes/Opinion.php';
require_once 'src/classes/Product.php';
require_once 'src/endpointsManagers/CategoryManager.php';
require_once 'src/endpointsManagers/UserManager.php';
require_once 'src/endpointsManagers/CountryOriginManager.php';
require_once 'src/endpointsManagers/OrderEntryManager.php';
require_once 'src/endpointsManagers/OrdersManager.php';
require_once 'src/endpointsManagers/ProductManager.php';
require_once 'src/endpointsManagers/OpinionManager.php';

function connectToDatabase(): PDO
{
    $host = 'localhost';
    $db = 'alkohole';
    $user = 'root';
    $pass = 'admin';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    return new PDO($dsn, $user, $pass, $opt);
}

class TestBackend
{
    private $PDO;
    private CategoryManager $categoryManager;
    private CountryOriginManager $countryOriginManager;
    private OrderEntryManager $orderEntryManager;
    private OrdersManager $ordersManager;
    private ProductManager $productManager;
    private UserManager $userManager;
    private OpinionManager $opinionManager;

    private Category $category;
    private CountryOrigin $countryOrigin;
    private Opinion $opinion;
    private OrderEntry $orderEntry1;
    private OrderEntry $orderEntry2;
    private Orders $orders;
    private Product $product;
    private User $user;

    public function __construct()
    {
        $this->PDO = connectToDatabase();
        $this->categoryManager = new CategoryManager($this->PDO);
        $this->countryOriginManager = new CountryOriginManager($this->PDO);
        $this->orderEntryManager = new OrderEntryManager($this->PDO);
        $this->ordersManager = new OrdersManager($this->PDO);
        $this->productManager = new ProductManager($this->PDO);
        $this->userManager = new UserManager($this->PDO);
        $this->opinionManager = new OpinionManager($this->PDO);
    }

    public function runTest()
    {
        echo "=== TestBackend ===\n";

        $this->__createCategory();
        $this->__createCountryOrigin();
        $this->__createProduct();
        $this->__createUser();
        $this->__createOpinion();
        $this->__createOrders();
        $this->__createOrderEntries();

        // Clear up database
        $this->orderEntryManager->removeOrderEntry($this->orderEntry1->getId());
        $this->orderEntryManager->removeOrderEntry($this->orderEntry2->getId());
        $this->ordersManager->removeOrders($this->orders->getId());
        $this->opinionManager->removeOpinion($this->opinion->getId());
        $this->productManager->removeProduct($this->product->getId());
        $this->categoryManager->removeCategory($this->category->getId());
        $this->countryOriginManager->removeCountryOrigin($this->countryOrigin->getId());
        $this->userManager->removeUser($this->user->getId());

        // Print table contents after removal
        echo "Category Table after removal:\n";
        $categoriesAfterRemoval = $this->categoryManager->getObjects();
        echo $this->categoryManager->toJSON($categoriesAfterRemoval) . "\n";

        echo "Country Origin Table after removal:\n";
        $countryOriginsAfterRemoval = $this->countryOriginManager->getObjects();
        echo $this->countryOriginManager->toJSON($countryOriginsAfterRemoval) . "\n";

        echo "Product Table after removal:\n";
        $productsAfterRemoval = $this->productManager->getObjects();
        echo $this->productManager->toJSON($productsAfterRemoval) . "\n";

        echo "User Table after removal:\n";
        $usersAfterRemoval = $this->userManager->getObjects();
        echo $this->userManager->toJSON($usersAfterRemoval) . "\n";

        echo "Opinion Table after removal:\n";
        $opinionsAfterRemoval = $this->opinionManager->getObjects();
        echo $this->opinionManager->toJSON($opinionsAfterRemoval) . "\n";

        echo "Orders Table after removal:\n";
        $ordersAfterRemoval = $this->ordersManager->getObjects();
        echo $this->ordersManager->toJSON($ordersAfterRemoval) . "\n";

        echo "Order Entry Table after removal:\n";
        $orderEntriesAfterRemoval = $this->orderEntryManager->getObjects();
        echo $this->orderEntryManager->toJSON($orderEntriesAfterRemoval) . "\n";
    }
    private function __createCategory()
    {
        $this->category = new Category("Wino", "Smaczne i czerwone");
        echo "Before creating Category:\n";
        $categoriesBeforeCreation = $this->categoryManager->getObjects();
        echo $this->categoryManager->toJSON($categoriesBeforeCreation) . "\n";
        $this->category->setId($this->categoryManager->insertCategory($this->category));
        echo "After creating Category:\n";
        $categoriesAfterCreation = $this->categoryManager->getObjects();
        echo $this->categoryManager->toJSON($categoriesAfterCreation) . "\n";
    }

    private function __createCountryOrigin()
    {
        $this->countryOrigin = new CountryOrigin("Polska");
        echo "Before creating CountryOrigin:\n";
        $countryOriginsBeforeCreation = $this->countryOriginManager->getObjects();
        echo $this->countryOriginManager->toJSON($countryOriginsBeforeCreation) . "\n";
        $this->countryOrigin->setId($this->countryOriginManager->insertCountryOrigin($this->countryOrigin));
        echo "After creating CountryOrigin:\n";
        $countryOriginsAfterCreation = $this->countryOriginManager->getObjects();
        echo $this->countryOriginManager->toJSON($countryOriginsAfterCreation) . "\n";
    }

    private function __createProduct()
    {
        $this->product = new Product(
            "Bordeaux",
            $this->category->getId(),
            0.18,
            "Prosto z Polski",
            $this->countryOriginManager->getObjectIdBy("name", "Polska"),
            45.55,
            10,
            3.5
        );
        echo "Before creating Product:\n";
        $productsBeforeCreation = $this->productManager->getObjects();
        echo $this->productManager->toJSON($productsBeforeCreation) . "\n";
        $this->product->setId($this->productManager->insertProduct($this->product));
        echo "After creating Product:\n";
        $productsAfterCreation = $this->productManager->getObjects();
        echo $this->productManager->toJSON($productsAfterCreation) . "\n";
    }

    private function __createUser()
    {
        $this->user = new User("Jedrzej", "Klamra", "j@m.pl", 25, "Krakow lol", "password");
        echo "Before creating User:\n";
        $usersBeforeCreation = $this->userManager->getObjects();
        echo $this->userManager->toJSON($usersBeforeCreation) . "\n";
        $this->user->setId($this->userManager->insertUser($this->user));
        echo "After creating User:\n";
        $usersAfterCreation = $this->userManager->getObjects();
        echo $this->userManager->toJSON($usersAfterCreation) . "\n";
    }

    private function __createOpinion()
    {
        $this->opinion = new Opinion($this->user->getId(), $this->product->getId(), 3, "sciema");
        echo "Before creating Opinion:\n";
        $opinionsBeforeCreation = $this->opinionManager->getObjects();
        echo $this->opinionManager->toJSON($opinionsBeforeCreation) . "\n";
        $this->opinion->setId($this->opinionManager->insertOpinion($this->opinion));
        echo "After creating Opinion:\n";
        $opinionsAfterCreation = $this->opinionManager->getObjects();
        echo $this->opinionManager->toJSON($opinionsAfterCreation) . "\n";
    }

    private function __createOrders()
    {
        $this->orders = new Orders("2023-06-15 12:30:00", $this->user->getId());
        echo "Before creating Orders:\n";
        $ordersBeforeCreation = $this->ordersManager->getObjects();
        echo $this->ordersManager->toJSON($ordersBeforeCreation) . "\n";
        $this->orders->setId($this->ordersManager->insertOrders($this->orders));
        echo "After creating Orders:\n";
        $ordersAfterCreation = $this->ordersManager->getObjects();
        echo $this->ordersManager->toJSON($ordersAfterCreation) . "\n";
    }

    private function __createOrderEntries()
    {
        $this->orderEntry1 = new OrderEntry(1, $this->product->getId(), $this->product->getPrice(), $this->orders->getId());
        $this->orderEntry2 = new OrderEntry(2, $this->product->getId(), $this->product->getPrice(), $this->orders->getId());
        echo "Before creating OrderEntries:\n";
        $orderEntriesBeforeCreation = $this->orderEntryManager->getObjects();
        echo $this->orderEntryManager->toJSON($orderEntriesBeforeCreation) . "\n";
        $this->orderEntry1->setId($this->orderEntryManager->insertOrderEntry($this->orderEntry1));
        $this->orderEntry2->setId($this->orderEntryManager->insertOrderEntry($this->orderEntry2));
        echo "After creating OrderEntries:\n";
        $orderEntriesAfterCreation = $this->orderEntryManager->getObjects();
        echo $this->orderEntryManager->toJSON($orderEntriesAfterCreation) . "\n";
    }
}

$testBackend = new TestBackend();

$testBackend->runTest();