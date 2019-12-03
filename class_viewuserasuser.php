<?php
require_once("class_admin.php");
class ViewUserAsUser extends User
{    
    public function showSelf()
    {
        $datas=$this->getSelfUsers();
        foreach ($datas as $data)
        {
            echo $data['username']."<br>";
            echo $data['email']."<br>";
        }
    }
}