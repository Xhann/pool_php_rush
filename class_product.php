<?php
require_once('class_database.php');
require_once('SQLQueriesProduct.php');

class Product extends Database
{
    private $name;
    private $category;
    private $price;
    private static $ID = 0;

    public function getName()
        {
            return $this->name;
        }

    public function setName($name)
        {
            $this->name = $name;
        }

    public function getCategory()
        {
            return $this->category;
        }

    public function setCategory($category)
        {
            $this->category = $category;
        }
    
    public function getPrice()
        {
            return $this->price;
        }

    public function setPrice($price)
        {
            $this->price = $price;
        }

    public function __construct($name, $category, $price)
        {
            setName($name);
            setCategory($category);
            setPrice($price);
            self::$ID++;
            add_product($conn); // enregistrement dans la BDD
        }

    public function __destruct()
        {
            delete_product($conn); //détruire la ligne product dans la BDD
        }
}
