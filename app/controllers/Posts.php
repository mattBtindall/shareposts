<?php
    class Posts extends Controller {
        public function __construct() {
            if (!isLoggedIn()) redirect('users/login');
            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }

        public function index() {
            $posts = $this->postModel->getPosts();

            $data = [
                'posts' => $posts,
            ];

            $this->view('posts/index', $data);
        }

        public function add() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => ''
                ];

                if (empty($data['title'])) {
                    $data['title_error'] = 'Please enter a title';
                }

                if (empty($data['body'])) {
                    $data['body_error'] = 'Please enter body text';
                }

                if (empty($data['title_error']) && empty($data['body_error'])) {
                    if ($this->postModel->addPost($data)) {
                        flash('post_message', 'Post Added');
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    $this->view('posts/add', $data);
                }

            } else {
                $data = [
                    'title' => '',
                    'body' => ''
                ];

                $this->view('posts/add', $data);
            }
        }

        public function edit($id) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => ''
                ];

                if (empty($data['title'])) {
                    $data['title_error'] = 'Please enter a title';
                }

                if (empty($data['body'])) {
                    $data['body_error'] = 'Please enter body text';
                }

                if (empty($data['title_error']) && empty($data['body_error'])) {
                    if ($this->postModel->updatePost($data)) {
                        flash('post_message', 'Post updated');
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    $this->view('posts/edit/', $data);
                }

            } else {
                // Get existing post from model
                $post = $this->postModel->getPostById($id);

                // Check for owner
                if ($post->user_id !== $_SESSION['user_id']) {
                    redirect('posts');
                }

                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body
                ];

                $this->view('posts/edit', $data);
            }
        }

        public function show($id) {
            // Instead of doing a complex join SQL statement in the post model
            // We simply get the user by extracting the user_id from the post data
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);

            $data = [
                'post' => $post,
                'user' => $user
            ];

            $this->view('posts/show', $data);
        }

        public function delete($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get existing post from model
                $post = $this->postModel->getPostById($id);

                // Check for owner
                if ($post->user_id !== $_SESSION['user_id']) {
                    redirect('posts');
                }

                if ($this->postModel->deletePost($id)) {
                    flash('post_message', 'Post Removed');
                    redirect('posts');
                } else {
                    die('Something went horribly wrong');
                }
            } else {
                redirect('posts');
            }
        }
    }