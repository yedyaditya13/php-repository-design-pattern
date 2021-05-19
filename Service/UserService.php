<?php 


namespace Service {

    require_once __DIR__ . "/../Config/Database.php";
    require_once __DIR__ . "/../Repository/UserRepository.php";
    require_once __DIR__ . "/../Entity/User.php";

    use Config\{Database};
    use Entity\{User};
    use Repository\{UserRepository, UserRepositoryImpl};

    interface UserService 
    {
        function showUsers(): void; 

        function getUser(string $email): void;
        
        function addUser(string $email, string $pasword, string $username): void;

        function removeUser(string $email): void;
    }

    class UserServiceImpl implements UserService
    {
        private $userRepository;

        public function __construct(UserRepository $userRepository)
        {
            $this->userRepository = $userRepository;
        }

        public function showUsers(): void
        {
            $users = $this->userRepository->findAll();

            foreach ($users as $key => $val)
            {
                // echo $key . \PHP_EOL;
                echo \PHP_EOL;
                echo 'Users';
                echo \PHP_EOL;
                foreach ($val as $keyItem => $valItem)
                {
                    echo $keyItem . " : " . $valItem . \PHP_EOL;
                }
                echo \PHP_EOL;
            }
        }

        public function getUser(string $email): void
        {   
            $user = $this->userRepository->findUserByEmail($email);

            if (empty($user)) {
                echo 'kosong' . \PHP_EOL;
            }else{
                foreach ($user as $key => $val)
                {
                    echo \PHP_EOL;
                    echo 'id : ' . $val->getId() . \PHP_EOL;
                    echo 'email : ' . $val->getEmail() . \PHP_EOL;
                    echo 'password : ' . $val->getPassword() . \PHP_EOL;
                    echo 'username : ' . $val->getUsername() . \PHP_EOL;
                    echo \PHP_EOL;
                }
            }
        }

        public function addUser(string $email, string $pasword, string $username): void
        {
            $user = new User($email, $pasword, $username);

            $checkUser = $this->userRepository->save($user);  
            if ($checkUser == false) {
                echo "Maaf, user sudah ada " . \PHP_EOL;
            }else{
                echo "Sukses menambah user " . \PHP_EOL;
            }
        }

        public function removeUser(string $email): void
        {
            $checkUser = $this->userRepository->remove($email);

            if ($checkUser == \false)
            {
                echo "Maaf, user tidak ditemukan " . \PHP_EOL;
            }else{
                echo "Sukses menghapus user " . \PHP_EOL;
            }
        }

    }

    // $conn = Database::getConnection();
    // $userRepo = new UserRepositoryImpl($conn);
    // $obj = new UserServiceImpl($userRepo);
    // $obj->getUser('yedy@gmail.com');
    // $obj->showUsers();
    // $obj->addUser('fani@gmail.com', 'fani123', 'fani');
}