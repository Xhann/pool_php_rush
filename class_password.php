<?php
class Password
{
    public function hashPassword($password) : string
    {
        $hash=password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }
    public function passwordVerif($password, $mail) : bool
    {
        $db=new Database();
        $conn=$db->connect();
        $resultat=null;
        try {
            //retrouver le hash du pwd ds la bdd where email=POST_mail
            $sql_query=$conn->prepare("SELECT password,username FROM users WHERE mail= ?");
            $sql_query->bindParam(1, $mail, PDO::PARAM_STR);
            $sql_query->execute();
            $resultat = $sql_query->fetch();
        } catch (PDOException $e) {
            //echo 'Connexion DB KO : ' . $e->getMessage();
        }

        return  password_verify($password, $resultat);
    }
}