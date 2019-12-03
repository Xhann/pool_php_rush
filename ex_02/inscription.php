<?php

function validateName() : bool
{
    $name=$_POST["name"];
    return preg_match ("#^[a-zA-Z0-9_]{3,10}$#" , $name );
}
function validatePassword() : bool
{
    $password=$_POST["password"];
    return preg_match ("#^[a-zA-Z0-9_]{3,10}$#" , $password );
}
function validatePasswordConfirmation() : bool
{
    return $_POST["password"]===$_POST["password_confirmation"];
}
function validateMail() :bool
{
    $email=($_POST["email"]);
    return preg_match ("#^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$#" , $email );
}
function hashPassword() : string
{
    $hash=password_hash($_POST["password"],PASSWORD_DEFAULT);
    return $hash;
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

function writeDB(PDO $db)
{
    try { 
        $password=hashPassword($_POST["password"],PASSWORD_DEFAULT);
        
        $sql_query=$db->prepare("INSERT INTO users (id, username, email, password, admin) VALUES( :id, :name, :email, :password, false)");
        $sql_query->bindParam(':id', $id ,PDO::PARAM_STR);
        $sql_query->bindParam(':name', ($_POST["name"]),PDO::PARAM_STR);
        $sql_query->bindParam(':email', ($_POST["email"]),PDO::PARAM_STR);
        $sql_query->bindParam(':password', $password,PDO::PARAM_STR);
        $sql_query->execute();
        }
    catch (PDOException $e)
    {
        echo 'Connexion DB KO : ' . $e->getMessage();
    }
    echo("User created");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription.php</title>
</head>
<body>
<?php

$validateForm=true;
$name=null;
$mail=null;
$password=null;
$password_confirm=null;
$hidden="";

if (isset($_POST['name'])) 
{
    $name = $_POST['name'];
}
if (isset($_POST['email'])) 
{
    $mail = $_POST['email'];
}
if (isset($_POST['password'])) 
{
    $password = $_POST['password'];
}
if (isset($_POST['password_confirmation'])) 
{
    $password_confirm = $_POST['password_confirmation'];
}

if (!( $name==null OR $mail==null OR $password==null OR $password_confirm==null ))
{
    
if (!validateName())
{
    echo ("Invalid name.\n");
    $validateForm=false;
}
if (!validateMail())
{
    echo ("Invalid mail.\n");
    $validateForm=false;
}
if (!validatePassword() OR !validatePasswordConfirmation())
{
    echo ("Invalid password or password confirmation.\n");
    $validateForm=false;
}

if ($validateForm)
{
    $bdd=connexDB();
    writeDB($bdd);
    $hidden="hidden";
}
}
?>

    <form method="post" action="inscription.php" <?php echo($hidden) ?> >
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
    </body>
    </html>
