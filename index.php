<?php

require_once 'Router.php';
require_once 'DBConnection.php';
require_once 'src/endpointsManagers/UserManager.php';
require_once 'src/endpointsManagers/ProductManager.php';

$dbh = (new DBConnection())->getDBH();
$router = new Router();

$userManager = new UserManager($dbh);
$router->addEndpoint('POST', '/register', [$userManager, 'register']);
$router->addEndpoint('POST', '/login', [$userManager, 'login']);
$router->addEndpoint('GET', '/me', [$userManager, 'me']);

$productManager = new ProductManager($dbh);
$router->addEndpoint('GET', '/products', [$productManager, 'getProducts']);
$router->addEndpoint('GET', '/products/{id}', [$productManager, 'getProductById']);
$router->addEndpoint('POST', '/products', [$productManager, 'insertProduct']);
$router->addEndpoint('PUT', '/products/{id}', [$productManager, 'editProduct']);
$router->addEndpoint('DELETE', '/products/{id}', [$productManager, 'deleteProduct']);

$router->route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
