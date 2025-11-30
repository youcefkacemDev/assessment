<?php

class User {
    private string $name;
    private string $email;
    private string $password;

    public function __construct(string $name, string $email, string $password){
        $this->name = $name;
        $this->email = $email;
        $this->setPassword($password);
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setPassword(string $password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public static function getAllUsers()
    {
        $host = 'mysql:host=assessment-mysql-1;';
        $database = 'dbname=assessment';
        $username = 'root';
        $password = 'password';

        $connection = new PDO($host . $database , $username ,$password);

        $users = $connection
            ->query('select * from users;')
            ->fetchAll();

        return $users;
    }
}

$user = new User('youcef', 'youcef@mail.com', '2234343');
echo "user name: " . $user->getName() . PHP_EOL;

var_dump( $user->getAllUsers());