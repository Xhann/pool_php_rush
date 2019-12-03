<?php
//user : id, username, password, email, admin

// Add user :
function userAdd(PDO $db,$username,$password,$email,$admin)
{
    $sql = "INSERT INTO users (username, password, email, isAdmin) VALUES(:username, :password, :email, :isAdmin)";
                                          
    $stmt = $db->prepare($sql);
                                              
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR); 
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);       
    $stmt->bindParam(':isAdmin', $admin, PDO::PARAM_BOOL);                                 
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Update user name:
function userNameUpdate(PDO $db,$username,$id)
{
    $sql = "UPDATE users SET username = :username WHERE id = :id";

    $stmt = $db->prepare($sql);                                  
    
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);  
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Update user email:
function userEmailUpdate(PDO $db,$email,$id)
{
    $sql = "UPDATE users SET email = :email WHERE id = :id";

    $stmt = $db->prepare($sql);                                  
    
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);  
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Update user name:
function userPasswordUpdate(PDO $db, $password, $id)
{
    $sql = "UPDATE users SET password = :password WHERE id = :id";

    $stmt = $db->prepare($sql);                                  
    
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);    
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Update user isAdmin:
function userIsAdminUpdate(PDO $db, bool $isAdmin, $id)
{
    $sql = "UPDATE users SET isAdmin = :isAdmin WHERE id = :id";

    $stmt = $db->prepare($sql);                                  
    
    $stmt->bindParam(':isAdmin', $isAdmin, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //

// Get user Name:
function userNameGet(PDO $db, $id)
{
    $sql = "SELECT name FROM users WHERE id = :id";

    $stmt = $db->prepare($sql);                                  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);     
    $stmt->execute();
    $name=$stmt->fetch(PDO::FETCH_NUM);

    return $name;
}

// ------------------------------------------------------------------------------------------------------------ //

// Get user Email:
function userEmailGet($db,$email)
{
    $sql = "SELECT email FROM users WHERE email = :email";

    $stmt = $db->prepare($sql);                                  
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);     
    $stmt->execute();
    $mail=$stmt->fetch(PDO::FETCH_NUM);

    return $mail;
}

// ------------------------------------------------------------------------------------------------------------ //

// Get user id:
function userIdGet(PDO $db,$email)
{
    $sql = "SELECT id FROM users WHERE email = :email";

    $stmt = $db->prepare($sql);                                  
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);     
    $stmt->execute();
    $id=$stmt->fetch(PDO::FETCH_NUM);

    return $id;
}

// ------------------------------------------------------------------------------------------------------------ //

// Get user Password:
function userPasswordGet(PDO $db, $id)
{
    $sql = "SELECT password FROM users WHERE id = :id";

    $stmt = $db->prepare($sql);                                  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);     
    $stmt->execute();
    $password=$stmt->fetch(PDO::FETCH_NUM);

    return $password;
}

// ------------------------------------------------------------------------------------------------------------ //

// Get user isAdmin:
function userIsAdminGet(PDO $db,$id)
{
    $sql = "SELECT isAdmin FROM users WHERE id = :id";

    $stmt = $db->prepare($sql);                                  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);     
    $stmt->execute();
    $isAdmin=$stmt->fetch(PDO::FETCH_NUM);

    return $isAdmin;
}

// ------------------------------------------------------------------------------------------------------------ //

// Delete user :
function userDelete(PDO $db,$id)
{
    $sql = "DELETE FROM users WHERE id =  :id";
    
    $stmt = $db->prepare($sql);
    
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);  

    $stmt->execute();
}

// ------------------------------------------------------------------------------------------------------------ //
