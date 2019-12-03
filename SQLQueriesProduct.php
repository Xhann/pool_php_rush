<?php
// product : id, name, price, category_id

// Add product :
function productAdd(PDO $db)
{
    $sql = "INSERT INTO products (name, price, category_id VALUES(:name, :price, :category_id))";
                                          
    $stmt = $db->prepare($sql);
                                              
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(':price', $_POST['price'], PDO::PARAM_INT); 
    $stmt->bindParam(':category_id', $_POST['category_id'], PDO::PARAM_INT);       
                                      
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Update product name:
function productUpdateName(PDO $db)
{
    $sql = "UPDATE products SET name = :name WHERE id = :id";

    $stmt = $pdo->prepare($sql);                                  
    
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
   
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Update product price:
function productUpdatePrice(PDO $db)
{
    $sql = "UPDATE products SET price = :price WHERE id = :id";

    $stmt = $db->prepare($sql);
    
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
   
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Update product category:
function productUpdateCategory(PDO $db)
{
    $sql = "UPDATE products SET category = :category WHERE id = :id";

    $stmt = $db->prepare($sql);                
    
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
   
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Delete product :
function productDelete(PDO $db)
{
    $sql = "DELETE FROM products WHERE id =  :id";
    
    $stmt = $db->prepare($sql);
    
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);  

    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //
