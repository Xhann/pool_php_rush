<?php



require_once("class_validate.php");
require_once("class_database.php");
require_once("class_password.php");
require_once("SQLQueriesUser.php");
include('inc/container.php');

session_start();

$verif=new Validate();

function verifDoublonMail($conn, $mail) :bool
{
    //test doublon email dans la table
    $doublon=null;

    //GET USER MAIL
    $doublon =userEmailGet($conn, $mail);
    $conn=null;

    
    if ($doublon[0]!=false) {
        $_SESSION["ErrorMsg"]="Erreur : Champ mail déjà renseigné dans la base !";
        return false;
    }
    //var_dump($_SESSION);
    return true;
}

function insertDB(PDO $conn)
{
    try {
        // On ne peut pas creer un compte admin via Inscription
        $admin=false;

        //Verif doublon avant insert
        verifDoublonMail($conn, $_POST["email"]);
        
        //Hachage PWD
        $pass=new Password();
        $hash=$pass->hashPassword($_POST["password"]);

        //ADD USER
        userAdd($conn, $_POST["name"], $hash, $_POST["email"], $admin);
        
        //GET USER ID BY MAIL
        $id=userIdGet($conn, $_POST["email"]);
        $_SESSION["id"]=$id[0];
        //var_dump($_SESSION);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
    $conn=null;


    //Sauvegarde de toutes les variables de navigation sur le site
    $_SESSION["new"]=true;
    $_SESSION["mail"]=$_POST["email"];
    $_SESSION["username"]=$_POST["name"];
    $_SESSION["password"]=$_POST["password"];
    $_SESSION["admin"]=$admin;

    //Si pas d'erreur à l'inscription, redirige vers login.php
    if (empty($_SESSION["ErrorMsg"])) {
        //Appel Login.php
        header('Location: login.php');
    }
}
/////DEBUT DE PAGE HTML
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSS PREVU -->
<title>Inscription.php</title>
<body>

<?php

//Connexion DB////////
$db=new Database();
$conn=$db->connect();


/////Afiichage MSG d'erreur et initialisation de variables//////////////
//Si Message d'erreur renseigné et new user, on l'affiche, et on efface les valeurs de session ensuite.
if (!empty($_SESSION["ErrorMsg"]) && $_SESSION["new"]) {
    echo($_SESSION["ErrorMsg"]);
    $_SESSION["ErrorMsg"]="";
    $_SESSION["new"]="";
}
$validateForm=true;
$name=null;
$mail=null;
$password=null;
$password_confirm=null;


// RECUPERATION DES CHAMPS EN POST DU FORMULAIRE/////////////////////
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['email'])) {
    $mail = $_POST['email'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['password_confirmation'])) {
    $password_confirm = $_POST['password_confirmation'];
}
/////////////////////////////////////////////////////////////////////
// CONTROLES FORMULAIRE//////////////////////////////////////////////
if (!($name==null or $mail==null or $password==null or $password_confirm==null)) {
    if (!$verif->validateName($_POST["name"])) {
        echo("Invalid name.\n");
        $validateForm=false;
    }
    if (!$verif->validateMail($_POST["email"])) {
        echo("Invalid mail.\n");
        $validateForm=false;
    }
    if (!$verif->validatePassword($_POST["password"]) or !$verif->validatePasswordConfirmation($_POST["password"], $_POST["password_confirmation"])) {
        echo("Invalid password or password confirmation.\n");
        $validateForm=false;
    }
    ///////////////////////////////////////////////////////////////////////
    //SI FORMULAIRE OK= ON appelle la fonction pour INSERT
    if ($validateForm) {
        insertDB($conn);
    }
}
///////////////////////////////////////////////////////////////////////
?>
    <!-- FORMULAIRE HTML -->
    <form method="post" action="inscription.php" >
    <label>NOM</label><input  type="text" name="name" placeholder="Entrez votre nom">
    <br>
    <label>EMAIL</label><input  type="text" name="email" placeholder="Entrez votre email">
    <br>
    <label>PASSWORD</label><input  type="password" name="password" value="password">
    <br>
    <label>CONFIRM</label><input  type="password" name="password_confirmation" value="password_confirmation">
    <br>
    <input  type="submit" value="submit" />
    </form>
    <!-- FORMULAIRE HTML -->
    </body>
    </html>
