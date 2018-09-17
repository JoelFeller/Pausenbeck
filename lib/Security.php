<?php
class Security
{
    public static function checkLogin() {
        if(!isset($_SESSION['username']))
        {
            header('Location: /user/login');
        }
    }
    public static function checkAdmin() {
        if($_SESSION['username'] !== "admin")
        {
            header('Location: /user/login');
        }
    }
}