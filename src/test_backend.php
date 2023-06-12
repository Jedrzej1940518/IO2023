<?php

require_once 'src/classes/Category.php';
require_once 'src/endpointsManagers/CategoryManager.php';
require_once 'src/classes/User.php';
require_once 'src/endpointsManagers/UserManager.php';

$host = 'localhost';
$db   = 'alkohole';
$user = 'root';
$pass = 'admin';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$userManager = new UserManager($pdo);
$newUserId1 = $userManager->insertObject([
    'first_name' => 'John',
    'last_name' => 'Doe',
    'age' => 30,
    'address' => '123 Main St',
    'email' => 'john.doe@example.com',
    'password' => password_hash('password', PASSWORD_DEFAULT),
]);

$newUserId2 = $userManager->insertObject([
    'first_name' => 'Jane',
    'last_name' => 'Smith',
    'age' => 28,
    'address' => '456 Park Ave',
    'email' => 'jane.smith@example.com',
    'password' => password_hash('password', PASSWORD_DEFAULT),
]);

echo "Created new user with ID: $newUserId1\n";
echo "Created new user with ID: $newUserId2\n";

$categoryManager = new CategoryManager($pdo);
$newCategoryId1 = $categoryManager->insertObject([
    'name' => 'Electronics',
    'description' => 'All things electronic',
]);

$newCategoryId2 = $categoryManager->insertObject([
    'name' => 'Furniture',
    'description' => 'Comfortable and stylish',
]);

echo "Created new category with ID: $newCategoryId1\n";
echo "Created new category with ID: $newCategoryId2\n";

// Fetch and print all users
$users = $userManager->getObjects();
echo "All users:\n";
echo $userManager->toJSON($users) . "\n";

// Fetch and print all categories
$categories = $categoryManager->getObjects();
echo "All categories:\n";
echo $categoryManager->toJSON($categories) . "\n";
?>
