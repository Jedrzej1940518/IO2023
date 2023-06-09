<?php

require_once 'classes/Category.php';
require_once 'EndpointHelper.php';

$cat = new Category(1, "wódki", "Wszystkie czyste wódeczki");
$cat2 = new Category(2, "wódki2", "Wszystkie kolorowe wódeczki");

$ars = array($cat, $cat2);

//var_dump($cat);

$h = new EndpointHelper();

print_r($h->toJSON($ars));

?>