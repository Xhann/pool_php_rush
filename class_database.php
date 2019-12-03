<?php
class Database
{
    //définir parametres de connexion
    private $dsn;
    private $user;
    private $password;
    


    public function connect()
    {
        $this->dsn='mysql:dbname=pool_php_rush;host=127.0.0.1:3306';
        $this->user="root";
        $this->password="password";
        

        $conn = new PDO($this->dsn, $this->user, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}