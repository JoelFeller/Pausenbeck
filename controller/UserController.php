<?php
require_once '../repository/UserRepository.php';
require_once '../lib/Security.php';
    /**
     * Siehe Dokumentation im DefaultController.
     */
class UserController
{
    public function index()
    {
        Security::checkLogin();
        Security::checkAdmin();
        $userRepository = new UserRepository();
        $view = new View('user_index');
        $view->title = 'User';
        $view->heading = 'User';
        $view->users = $userRepository->readAll();
        $view->display();
    }
    public function create()
    {
        $error = [];
        $view = new View('user_create');
        $view->title = 'Registrieren';
        $view->heading = 'Registrieren';
        $view->errors = $error;
        $view->display();
    }
    public function doCreate()
    {
        if ($_POST['send']) {
            $username = $_POST['firstName'].' '.$_POST['lastName'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $userRepository = new UserRepository();
            $userRepository->create($username,$email, $password);
            header("Location: /user/login");
        }
    }
    public function delete()
    {
        Security::checkLogin();
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
    public function dologin()
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $userRepository = new UserRepository();
            $loginErfolgreich = $userRepository->login($email, $password);
            if($loginErfolgreich) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $userRepository->getId($email);
                header('Location: /');
            }
            else
            {
                header('Location: /user/login');
            }
        }else{
            echo "Hopp Thun";
        }
    }
    public function login()
    {
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }
    public function logout()
    {
        session_start();
        session_unset();
        header('Location: /');
    }
}
