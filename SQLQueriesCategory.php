<?php
//category : id, name, parent_id

// Add category :
function categoryAdd(PDO $db)
{
  
    $sql = "INSERT INTO categories (name, parent_id VALUES(:name, :parent_id))";
                                          
    $stmt = $db->prepare($sql);
                                              
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);       
    $stmt->bindParam(':parent_id', $_POST['parent_id'], PDO::PARAM_INT); 
                                      
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Update category name:
function categoryUpdateName(PDO $db)
{
    $sql = "UPDATE categories SET name = :name WHERE id = :id";

    $stmt = $db->prepare($sql);                                  
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);           
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Update category parent_id:
function categoryUpdateParentId(PDO $db)
{
    $sql = "UPDATE categories SET parent_id = :parent_id WHERE id = :id";

    $stmt = $db->prepare($sql);                                  
    $stmt->bindParam(':parent_id', $_POST['parent_id'], PDO::PARAM_STR);           
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Delete category :
function categoryDelete(PDO $db)
{
    $sql = "DELETE FROM categories WHERE id =  :id";
    
    $stmt = $db->prepare($sql);
    
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);  

    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //
