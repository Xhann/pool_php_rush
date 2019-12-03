<?php
require_once('class_user.php');
require_once('SQLQueriesCategory.php');
require_once('SQLQueriesProduct.php');

class Admin extends User
{
    protected $isAdmin = true;
    
    public function adminCreate($name, $email, $password)
        {
            __construct($name, $email, $password);
            add_user($conn); // inscription à la BDD
        }
    
    public function userCreate($name, $email, $password)
        {
            parent::__construct($name, $email, $password);
            add_user($conn); // inscription à la BDD
        }
    
    public function userDelete(user $user)
        {
            $user->__destruct();
            delete_user($conn); // inscription dans la BDD
        }

   public function userNameModify(user $user, $name)
       {
            $user->setName($name);
            update_user($conn); // modification de la BDD
       }

    public function userEmailModify(user $user, $email)
       {
            $user->setEmail($email);
            update_user($conn); // modification de la BDD
       }

    public function userPasswordModify(user $user, $password)
       {
            $user->setPassword($name);
            update_user($conn); // modification de la BDD
       }

    public function getIsAdmin()
        {
            return $this->isAdmin;
        }

    private function setToAdmin(user $user)
        {
            $user_ID = $user->id;
            createAdmin($user->name, $user->email, $user->password);
            echo($user->name . " est maintenant administrateur.\n");
            deleteUser($user);
            update_user($conn); // modification de la BDD
        }
    
    private function setToUser(admin $admin)
        {
            createUser($admin->name, $admin->email, $admin->password);
            echo($admin->name . " est maintenant simple utilisateur.\n");
            __destruct($admin);
            update_user($conn); // modification de la BDD
        }

    public function productCreate($name, $category, $price)
        {
            $this->__construct($name, $category, $price);
            add_product($conn); // inscription à la BDD
        }
    
    public function productDelete(product $product)
        {
            $product->__destruct();
            delete_product($conn);// destruction dans la BDD
        }

   public function productNameModify(product $product, $name)
       {
            $product->setName = $name;
            update_product($conn); // modif de la BDD
       }

    public function productCategoryModify(product $product, $category)
       {
            $product->setCategory = $category;
            update_product($conn); // modif de la BDD
       }

    public function productPriceModify(product $product, $price)
       {
            $product->setPrice = $price;
            update_product($conn); // Mdif de la BDD
       }

    public function categoryNameModify(category $category, $name)
       {
           $category->name = $name;
           update_category($conn); // Modif de la BDD
       }
       
    public function __construct()
        {
            parent::__construct();
            $this->isAdmin = true;
            add_user($conn); // Inscription dans la BDD
        }
    
    public function dataListLine()
    {
        return sprintf('<option value="%s">',$this->name);
    }
    
    protected function getAllUsers()
        {
            $sql="SELECT * FROM users";
            $result=$this->connect()->query($sql);
            $numRows=$result->rowCount();
            if ($numRows>0)
            {
                while($row=$result->fetch(PDO::FETCH_ASSOC))
                {
                    $data[]=$row;
                }
                return $data;
            }
        }  
}
