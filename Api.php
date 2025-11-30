<?php

class Api
{
    public $connection;

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        $dsn = "mysql:host=assessment-mysql-1;dbname=assessment;charset=utf8mb4";
        $username = "root";
        $password = "password";

        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }

    public function getUser(int $id)
    {
        $sql = ('select * from users where id = :id');

        $statement = $this->connection->prepare($sql);

        $statement->execute(['id' => $id]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return json_encode($user);
    }

    public function getAllUsers()
    {
        $sql = ("select * from users");

        $statement = $this->connection->prepare($sql);

        $statement->execute();

        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($users);
    }

    public function deleteUser(int $id)
    {
        $sql = ('delete from users where id = :id');

        $statement = $this->connection->prepare($sql);

        $statement->execute(['id' => $id]);

        $result = ['message' => 'user deleted successfully '];

        return json_encode($result);
    }

    public function updateUser(int $id, string $name, string $email)
    {
        $sql = ('update users set name = :name, email = :email where id = :id;');

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            'name' => $name,
            'email' => $email,
            'id' => $id,
        ]);

        $result = ['message' => 'user updated successfully'];

        return json_encode($result);
    }

    public function createUser(string $name, string $email, string $password)
    {
        $sql = ("insert into users (name, email, password) values(:name, :email, :password);");

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        $result = ['message' => 'user inserted successfully'];

        return json_encode($result);
    }
}
