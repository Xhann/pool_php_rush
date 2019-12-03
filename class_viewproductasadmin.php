
<?php
require_once("class_product.php");
class ViewProductAsAdmin extends Product
{
    public function showAllProducts()
    {
        $datas=$this->getAllProducts();
        foreach ($datas as $data)
        {
            echo $data['id']."<br>";
            echo $data['name']."<br>";
            echo $data['category']."<br>";
        }
    }
}