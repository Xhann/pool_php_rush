<?php
require_once("class_product.php");
class ViewProductAsUser extends Product
{
    public function showAllProducts()
    {
        $datas=$this->getAllProducts();
        foreach ($datas as $data)
        {
            echo $data['name']."<br>";
            echo $data['category']."<br>";
        }
    }
}