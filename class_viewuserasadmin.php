<?php
require_once("class_admin.php");
class ViewUserAsAdmin extends Admin
{
    public function showAllUsers()
    {
        $datas=$this->getAllUsers();
        foreach ($datas as $data)
        {
            echo $data['id']."<br>";
            echo $data['username']."<br>";
            echo $data['password']."<br>";
            echo $data['email']."<br>";
            echo $data['admin']."<br>";
        }
    }
    
    public function showSelf()
    {
        $datas=$this->getSelfUsers();
        foreach ($datas as $data)
        {
            echo $data['id']."<br>";
            echo $data['username']."<br>";
            echo $data['password']."<br>";
            echo $data['email']."<br>";
            echo $data['admin']."<br>";
        }
    }
}