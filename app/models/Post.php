<?php
    class Post {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getPosts() {
            $this->db->query('SELECT *,
                              shareposts_posts.id as postId,
                              shareposts_users.id as userId,
                              shareposts_posts.created_at as postCreatedDate,
                              shareposts_users.created_at as userCreatedDate
                              FROM shareposts_posts
                              INNER JOIN shareposts_users
                              ON shareposts_posts.user_id = shareposts_users.id
                              ORDER BY shareposts_posts.created_at DESC
                              ');
            $results = $this->db->resultSet();

            return $results;
        }

        public function addPost($data) {
            $this->db->query('INSERT INTO ' . DB_PREFIX . 'posts (title, user_id, body) VALUE(:title, :user_id, :body)');
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':body', $data['body']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function getPostById($id) {
            $this->db->query('SELECT * FROM ' . DB_PREFIX . 'posts WHERE id= :id');
            $this->db->bind(':id', $id);
            return $this->db->single();
        }

        public function updatePost($data) {
            $this->db->query('UPDATE ' . DB_PREFIX . 'posts SET title = :title, body = :body WHERE id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deletePost($id) {
            $this->db->query('DELETE FROM ' . DB_PREFIX . 'posts  WHERE id = :id');
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }