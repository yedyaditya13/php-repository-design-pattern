<?php

require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . "/../Entity/User.php";
require_once __DIR__ . "/../Repository/UserRepository.php";
require_once __DIR__ . "/../Service/UserService.php";


use Repository\{UserRepositoryImpl};
use Service\{UserServiceImpl};

function testGetUser(): void
{
    $connection = Config\Database::getConnection();
    $userRepository = new UserRepositoryImpl($connection);
    $userService = new UserServiceImpl($userRepository);

    $params = 'dita@gmail.com';

    print_r($userService->getUser($params));
}

function testAddUser(): void
{
    $connection = Config\Database::getConnection();
    $userRepository = new UserRepositoryImpl($connection);
    $userService = new UserServiceImpl($userRepository);

    $userService->addUser('desi@gmail.com', 'desi123', 'desi');
    testShowUsers();
}

function testShowUsers(): void
{
    $connection = Config\Database::getConnection();
    $userRepository = new UserRepositoryImpl($connection);
    $userService = new UserServiceImpl($userRepository);

    $userService->showUsers();
}

function testRemoveUser(): void
{
    $connection = Config\Database::getConnection();
    $userRepository = new UserRepositoryImpl($connection);
    $userService = new UserServiceImpl($userRepository);

    $params = 'utami9@gmail.com';
    $userService->removeUser('utami9@gmail.com');
}

// testGetUser();
// testAddUser();
// testShowUsers();
testRemoveUser();