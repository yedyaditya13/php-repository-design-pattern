<?php

namespace Entity {

    class User {

        private int $id;
        private string $email;
        private string $password;
        private string $username;

        public function __construct(string $email, string $password, string $username)
        {
            $this->email = $email;
            $this->password = $password;
            $this->username = $username;
        }

        // GETTER 
        public function getId()
        {
            return $this->id;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getUsername()
        {
            return $this->username;
        }


        // SETTER
        public function setId(int $id)
        {
            $this->id = $id;
        }

        public function setEmail(string $email)
        {
            $this->email = $email;
        }

        public function setPassword(string $password)
        {
            $this->password = $password;
        }

        public function setUsername(string $username)
        {
            $this->username = $username;
        }
    }

}