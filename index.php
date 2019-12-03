<?php
require_once("user.php");
require_once("category-product.php");
require_once("database.php");
session_start();

$db=new Database();
$db->connect();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- ajouter le lien vers le CSS -->
    <title>Index.php</title>
</head>
<body>
    <?php if (isset($_SESSION['id'])) {  //verif Id dans BDD pour 2eme sécurité
    echo("BRAVO ".$_SESSION['username'].", vous etes sur la page Index -;)\n");
    if ($_SESSION['admin']) {
        echo("Bonjour Admin, clic sur le lien pour le backoffice <a href='admin.php'>admin.php</a>");
        var_dump($_SESSION);
    }
} else {
    header('Location: login.php');
    // si l'utilisateur n'est pas administrateur ou pas enregistré, on le (vire) redirige vers login
    $_SESSION["ErrorMsg"]="Vous n'êtes pas authentifié.\n";
}
    ?>
    <a href="logout.php">LOG OUT</a>
    <br>
    <br>
    
    <form method="post" action="index.php">
        <div class ="user">
            <label>// display profile Afficher son profil</label>
                <input type="text" name="display_profile">
            <button type="submit" class="btn" >DISPLAY!!</button>
        </div>
    </form>
    <br>
    
    <form method="post" action="index.php">
        <div class ="user">
            <label>// update user Modifier son profil</label>
                <input type="text" name="update_profile">
            <button type="submit" class="btn" >UPDATE!!</button>
        </div>
    </form>
    <br>
    
    <form method="post" action="index.php">
        <div class ="user">
            <label>// display product Afficher un produit</label>
                <input type="text" name="product_display">
            <button type="submit" class="btn" >DISPLAY!!</button>
        </div>
    </form>
    <br>
    
    <form method="post" action="index.php">
        <div class ="admin">
            <label>// display product Afficher une catégorie</label>
                <input type="text" name="category_display">
            <button type="submit" class="btn" >DISPLAY!!</button>
        </div>
    </form>
    

</body>
</html>
