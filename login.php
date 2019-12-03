<?php
require_once("class_validate.php");
require_once("class_database.php");
require_once("class_password.php");
require_once("SQLQueriesUser.php");
require_once("class_user.php");

$pass=new Password();

$verif=new Validate();


// VERIF SESSION ADMIN ET NEW
session_start();

function getId()
{
    $db=new Database();
    $conn=$db->connect();
    
    //GET USER ID & USERNAME BY MAIL
    $sql_query = $conn->prepare("SELECT id,username,password,isAdmin FROM users where email= ?");
    
    if ($_SESSION["new"]=true) {
        $sql_query->bindParam(1, $_SESSION["mail"], PDO::PARAM_STR);
    } else {
        $sql_query->bindParam(1, $_POST["email"], PDO::PARAM_STR);
    }
    
    $sql_query->execute();
    $result=$sql_query->fetch();
    //var_dump($result);
    $id=$result[0];
    $username=$result[1];
    $password=$result[2];
    $isAdmin=$result[3];

    if (empty($id)) {
        $id=null;
    }

    if (empty($username)) {
        $username=null;
    }
    $_SESSION['username']=$username;
    $_SESSION['isAdmin']=$isAdmin;
    $conn=null;
    return $id;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login.php</title>
</head>
<body>
<?php

$db=new Database();
$conn=$db->connect();

if (!empty($_SESSION["ErrorMsg"])) {
    echo($_SESSION["ErrorMsg"]);
    $_SESSION["ErrorMsg"]=null;
    $_SESSION["new"]=null;
}

$validateForm=true;
$mail=null;
$password=null;
$valueMail="";
$valuePassword="'password'";
$_SESSION["id"]=getId();
//$_SESSION['username'] défini ds getId()
$_SESSION["admin"]=userIsAdminGet($conn, $_SESSION["id"]);



if (isset($_POST['email'])) {
    $mail= $_POST['email'];
    $_SESSION['mail']=$mail;
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $_SESSION['password']=$password;
}

if (!$mail==null or !$password==null) {
    if (!$verif->validateMail($mail)) {
        echo ("Adresse mail au format invalide : il faut de 3 à 10 caractères parmi chiffres,lettres et caractères spéciaux.<br>");
        $validateForm=false;
    }
    if (!$verif->validatePassword($password)) {
        echo ("Password au format invalide : il faut de 3 à 10 caractères parmi chiffres,lettres et caractères spéciaux.<br>");
        $validateForm=false;
    }
    if (!$pass->passwordVerif($_SESSION["password"], $_SESSION["mail"])) {
        echo("Utilisateur inconnu avec cette combinaison de login/mdp.<br>");
        $validateForm=false;
    }

    var_dump($validateForm);

    if ($validateForm) {
        if ($_SESSION["admin"]) {
            header('Location: admin.php');
        } else {
            header('Location: index.php');
        }
    }

    
}


if ($_SESSION["id"]==null) {
    $_SESSION["new"]="";
}
//var_dump($_SESSION);
if ($_SESSION["new"]) {
    $valueMail=$_SESSION['mail'];
    $_SESSION["new"]="";
    if (!empty($_SESSION['password'])) {
        $valuePassword=$_SESSION['password'];
        echo("Merci pour votre inscription, cliquez sur SUBMIT pour vous connecter automatiquement!<br>");
    }
} else {
    echo("Merci de saisir votre email et password pour vous connecter.<br>");
}
?>

    <form method="post" action="login.php" >
    <label>EMAIL</label><input  type="text" name="email" placeholder="Entrez votre email" <?php echo("value=".$valueMail) ?>>
    <br>
    <label>PASSWORD</label><input  type="password" name="password" value=<?php echo($valuePassword) ?>>
    <br>
    <input  type="submit" value="submit" />
    </form>
    </body>
    </html>
