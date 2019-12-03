<?php
session_start();
function validatePassword() : bool
{
    $password=$_POST["password"];
    return preg_match ("#^[a-zA-Z0-9_]{3,10}$#" , $password );
}

function validateMail() :bool
{
    $email=($_POST["email"]);
    return preg_match ("#^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$#" , $email );
}

function passwordVerif() : bool
{
    $bdd=connexDB();
    try {
    //retrouver le hash du pwd ds la bdd where email=POST_mail
    $sql_query=$bdd->prepare("SELECT password,username FROM users WHERE email= ?");
    $sql_query->bindParam(1, ($_POST["email"]),PDO::PARAM_STR);
    $sql_query->execute();
    $hash = $sql_query->fetch();

    $_SESSION['USERNAME'] = $hash[1];
        }
    catch (PDOException $e)
    {
    //echo 'Connexion DB KO : ' . $e->getMessage();
    }

    return  password_verify($_POST["password"], $hash[0]);
}
function connexDB() : PDO
{
    $dsn = 'mysql:dbname=pool_php_rush;host=127.0.0.1:3306';
    $user = 'root';
    $password = 'password';

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    //echo 'Connexion DB OK ';
    }
catch (PDOException $e)
    {
    //echo 'Connexion DB KO : ' . $e->getMessage();
    }
    return $db;
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

$validateForm=true;
$mail=null;
$password=null;
$header="login.php";


if (isset($_POST['email'])) 
{
    $mail = $_POST['email'];
}
if (isset($_POST['password'])) 
{
    $password = $_POST['password'];
}

if (!$mail==null OR !$password==null)
{
    
if (!validateMail())
{
    //echo ("Invalid mail.\n");
    $validateForm=false;
}
if (!validatePassword())
{
    //echo ("Invalid password.\n");
    $validateForm=false;
}
if (!passwordVerif())
{
    echo ("User not found with this email/password.\n");
    $validateForm=false;
}

if ($validateForm)
{
    $header="index.php";   
}

}
?>

    <form method="post" action=<?php echo($header) ?> >
    <label>EMAIL</label><input  type="text" name="email" placeholder="Entrez votre email">
    <br>
    <label>PASSWORD</label><input  type="password" name="password" value="password">
    <br>
    <input  type="submit" value="submit" />
    </form>
    </body>
    </html>
