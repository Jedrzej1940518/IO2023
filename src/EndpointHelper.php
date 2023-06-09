<?php

require_once 'classes/Category.php';

class EndpointHelper {
    private $categories = array();
    private $categories_by_name = array();
    private $categories_by_description = array();

    public function __construct() {
        //dbh initialization done before, as cocnluded, here only usage of it (PDO database assumed)
        $sth = $dbh->prepare("SELECT id,name,description FROM Category");
        $sth->execute();
        while ($row = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $this->categories[] = new Category($row[0], $row[1], $row[2]);
        }

        $sth = $dbh->prepare("SELECT id,name,description FROM Category ORDER BY name");
        $sth->execute();
        while ($row = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $this->categories_by_name[] = new Category($row[0], $row[1], $row[2]);
        }

        $sth = $dbh->prepare("SELECT id,name,description FROM Category ORDER BY description");
        $sth->execute();
        while ($row = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $this->categories_by_description[] = new Category($row[0], $row[1], $row[2]);
        }
    }

    public function toJSON(?array $objects) : string {
        return json_encode($objects);
    }

    public function getCategories(bool $reverse) : array {
        if (!$reverse) {
            return $this->categories;
        } else {
            return array_reverse($this->categories);
        }
    }

    public function getCategoriesByName(bool $reverse) : array {
        if (!$reverse) {
            return $this->categories_by_name;
        } else {
            return array_reverse($this->categories_by_name);
        }
    }

    public function getCategoriesByDesc(bool $reverse) : array {
        if (!$reverse) {
            return $this->categories_by_description;
        } else {
            return array_reverse($this->categories_by_description);
        }
    }

    public function getOpinionsByProduct(int $product_id) : array {
        $opinions = array();
        $sth = $dbh->prepare("SELECT id,product_id,user_id,rate,description FROM Category WHERE product_id=?");
        $sth->bindValue(1, $product_id, PDO::PARAM_INT);
        $sth->execute();
        while ($row = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            //TODO : $opinions[] = new Opinion($row[0], $row[1], $row[2], $row[3], $row[4]);
        }
        return $opinions;
    }

    //TODO : add more functions for opinions and others (by user (etc))
}

?>