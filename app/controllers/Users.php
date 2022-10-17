<?php 
    class Users extends Controller {
        public function __construct() {
            $this->userModel = $this->model('User');   
        }

        public function register() {
            // This will handle loading the form 
            // And when the form is submitted

            // Check for post
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process the form
                // Sanatise the post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''  
                ];

                // Validate email
                if (empty($data['email'])) {
                    $data['email_error'] = 'Please enter an email';
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_error'] = 'Email is already taken';
                    }
                }

                // Validate name
                if (empty($data['name'])) {
                    $data['name_error'] = 'Please enter name';
                }

                // Validate password
                if (empty($data['password'])) {
                    $data['password_error'] = 'Please enter a password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_error'] = 'Please use 6 characters or more for the password';
                }

                // Validate confirm password
                if (empty($data['confirm_password'])) {
                    $data['confirm_password_error'] = 'Please confirm password';
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_error'] = 'Passwords do not match';
                    }
                }

                // Make sure errors are empty
                if (empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                    // Validated
                    
                    // Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // // Register user
                    if ($this->userModel->register($data)) {
                        flash('register_success', 'You are registered and can login');
                        redirect('users/login');
                    } else {
                        die('something went wrong');
                    }

                } else {
                    // Load view with errors
                    $this->view('users/register', $data);
                }

            } else {
                // init data
                // Blank data to match the blank form
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''  
                ];

                // Load view
                $this->view('users/register', $data);
            }
        }

        public function login() {
            // Check for post
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process the form
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_error' => '',
                    'password_error' => '',
                ];

                // Validate email
                if (empty($data['email'])) {
                    $data['email_error'] = 'Please enter email';
                }

                // Validate password
                if (empty($data['password'])) {
                    $data['password_error'] = 'Please enter password';
                }

                // Check for errors
                if (empty($date['email_error']) && empty($data['password_error'])) {
                    die('success');
                } else {
                    $this->view('users/login', $data);
                }

            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_error' => '',
                    'password_error' => '', 
                ];

                // Load view
                $this->view('users/login', $data);
            }
        }
    }