<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function register($data) {
            $this->db->query('INSERT INTO ' . DB_PREFIX . 'users (name, email, password) VALUE(:name, :email, :password)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Data here is being passed in from the form
        public function login($email, $password) {
            $this->db->query('SELECT * FROM ' . DB_PREFIX . 'users WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            $hashed_passwsord = $row->password;
            // if (password_verify($password, $hashed_passwsord)) {
            //     return $row;
            // } else {
            //     return false;
            // }

            return (password_verify($password, $hashed_passwsord)) ? $row : false;
        }

        public function findUserByEmail($email) {
            $this->db->query('SELECT * FROM ' . DB_PREFIX . 'users WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            return $this->db->rowCount() > 0;
        }
    }