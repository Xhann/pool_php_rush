<?php
require_once("class_category.php");
class ViewCategoryAsAdmin extends Category
{
    public function showAllCategories()
    {
        $datas=$this->getAllCategories();
        foreach ($datas as $data)
        {
            echo $data['id']."<br>";
            echo $data['name']."<br>";
            echo $data['parentId']."<br>";
        }
    }
}