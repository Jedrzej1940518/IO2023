<?php

require_once 'Router.php';
require_once 'DBConnection.php';
require_once 'src/endpointsManagers/UserManager.php';
require_once 'src/endpointsManagers/ProductManager.php';
require_once 'src/endpointsManagers/CategoryManager.php';
require_once 'src/endpointsManagers/OrderEntryManager.php';
require_once 'src/endpointsManagers/OrdersManager.php';
require_once 'src/endpointsManagers/OpinionManager.php';

session_start();

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

$categoryManager = new CategoryManager($dbh);
$router->addEndpoint('GET', '/categories', [$categoryManager, 'getCategories']);
$router->addEndpoint('POST', '/categories', [$categoryManager, 'insertCategory']);
$router->addEndpoint('DELETE', '/categories/{id}', [$categoryManager, 'deleteCategory']);

$ordersManager = new OrdersManager($dbh);
$router->addEndpoint('GET', '/orders', [$ordersManager, 'getOrders']);
$router->addEndpoint('GET', '/orders/{id}', [$ordersManager, 'getOrder']);
$router->addEndpoint('POST', '/orders', [$ordersManager, 'insertOrder']);
$router->addEndpoint('PUT', '/orders/{id}', [$ordersManager, 'updateOrder']);
$router->addEndpoint('DELETE', '/orders/{id}', [$ordersManager, 'deleteOrder']);

$orderEntryManager = new OrderEntryManager($dbh);
$router->addEndpoint('GET', '/order_entries/{id}', [$orderEntryManager, 'getOrderEntries']);
$router->addEndpoint('POST', '/order_entries/{id}', [$orderEntryManager, 'insertOrderEntry']);
$router->addEndpoint('PUT', '/order_entries/{id}', [$orderEntryManager, 'updateOrderEntry']);
$router->addEndpoint('DELETE', '/order_entries/{id}', [$orderEntryManager, 'deleteOrderEntry']);

$opinionManager = new OpinionManager($dbh);
$router->addEndpoint('GET', '/products_opinions/{id}', [$opinionManager, 'getOpinions']);   //{id] is PRODCUT ID !!! not opinion id!!
$router->addEndpoint('POST', '/products_opinions', [$opinionManager, 'insertOpinion']);
$router->addEndpoint('PUT', '/products_opinions/{id}', [$opinionManager, 'updateOpinion']);
$router->addEndpoint('DELETE', '/products_opinions/{id}', [$opinionManager, 'deleteOpinion']);

$router->route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
