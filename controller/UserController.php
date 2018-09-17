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
        $view->title = 'Create user';
        $view->heading = 'Create user';
        $view->errors = $error;
        $view->display();
    }
    public function doCreate()
    {
        if ($_POST['send']) {
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            if($password == $password2){
                $error = [];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $userRepository = new UserRepository();
                if ($userRepository->checkName($username) < 1) {
                    $userRepository->create($username, $password);
                    header("Location: /user/login");
                } else {
                    $error["wrong"] = "Es existiert bereits ein Benutzer mit dieser E-Mail Adresse";
                }
                $view = new View('user_create');
                $view->title = 'Create user';
                $view->heading = 'Create user';
                $view->errors = $error;
                $view->display();
            }
            else {
                $error = [];
                $view = new View('user_create');
                $view->title = 'Create user';
                $view->heading = 'Create user';
                $view->errors = $error;
                $view->display();
                echo '<p>Die Passwörter stimmen nicht miteinander überein';
            }
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
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userRepository = new UserRepository();
            $loginErfolgreich = $userRepository->login($username, $password);
            if($loginErfolgreich) {
                $_SESSION['username'] = $username;
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
    public function doLogout()
    {
        session_destroy();
        session_unset();
        header('Location: /');
    }
}
