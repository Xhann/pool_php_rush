<?php
require_once("class_category.php");
class ViewCategoryAsUser extends Category
{
    public function showAllCategories()
    {
        $datas=$this->getAllCategories();
        foreach ($datas as $data)
        {
            echo $data['name']."<br>";
            echo $data['parentId']."<br>";
        }
    }
}