<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index.php</title>
</head>
<body>
    <?php if (isset($_SESSION['USERNAME']))
    {
        echo ("BRAVO ".$_SESSION['USERNAME'].", c'est ce qui était attendu -;)");
        //session_destroy();
    }
    else
    {
        header('Location: login.php');
    }
    ?>
</body>
</html>