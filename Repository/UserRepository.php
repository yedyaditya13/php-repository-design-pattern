<?php

namespace Repository 
{
    require_once __DIR__ . "/../Config/Database.php";
    require_once __DIR__ . "/../Entity/User.php";

    use Config\{Database};
    use Entity\User;
    use PDO;

    interface UserRepository 
    {
        public function findAll(): array;

        public function save(User $user): bool;

        public function findUserByEmail(string $email): array;

        public function remove(string $email): bool;

        // public function update(User $user);
    }


    class UserRepositoryImpl implements UserRepository
    {
        private PDO $connection;

        function __construct(PDO $connection)
        {
            $this->connection = $connection;
        }

        function findAll(): array
        {
            $sql = "SELECT * FROM users";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            // \var_dump($result);
            return $result;
        }

        function findUserByEmail(string $email): array
        {
            $sql = "SELECT id, email, password, username from users WHERE email = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$email]);

            if ($row = $statement->fetch())
            {
                $result = [];

                $user = new User($row['email'], $row['password'], $row['username']);
                $user->setId($row['id']);
                $user->setEmail($row['email']);
                $user->setPassword($row['password']);
                $user->setUsername($row['username']);

                $result[] = $user;
                
                // \var_dump($result);
                return $result;
            } else {
                return array();
            }    
        }

        function save(User $user): bool
        {
            $checkUser = $this->findUserByEmail($user->getEmail());

            if (empty($checkUser)) {
                $sql = "INSERT INTO users(email, password, username) VALUES(?, ?, ?)";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$user->getEmail(), $user->getPassword(), $user->getUsername()]);

                return \true;
            }else{
                return \false;
            }
        }

        function remove(string $email): bool
        {
            $checkUser = $this->findUserByEmail($email);

            if (empty($checkUser)) {
                return \false;
            }else{
                $sql = "DELETE FROM users WHERE email = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$email]);

                return \true;
            }
        }

    }

    // $conn = Database::getConnection();
    // $obj = new UserRepositoryImpl($conn);
    // $obj->remove('a@gmail.com');
    // $obj->findAll();
    // $obj->findUserByEmail('ooo@gmail.com');
}

