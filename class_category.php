<?php
require_once('class_database.php');
require_once('SQLQueriesCategory.php');

class Category extends Database
{
    private $name;
    protected $parentId;
    static $ID = 0;

    public function setName($name)
        {
            $this->name = $name;
        }

    public function getName()
        {
            return $this->name;
        }

    public function getParentId()
        {
            return $this->parentId;
        }
    
    public function __construct($name, $parent_id)
        {
            $this->setName($name);
            $this->parentId = $parent_id;
            self::$ID++;
            add_category($conn);  // enregistrement dans la BDD
        }

    public function __destruct()
        {
            delete_category($conn); //détruire la ligne product dans la BDD
        }
  public function datalistLine()
        {
             return sprintf('<option value="%s">',$this->name);
        }
}
