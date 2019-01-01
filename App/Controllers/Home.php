<?php
/**
 * Created by PhpStorm.
 * User: olexii
 * Date: 12/29/18
 * Time: 7:14 PM
 */

namespace App\Controllers;

use Core\Controller;

/**
 * Class Home
 * @package App\Controllers
 */
class Home extends Controller
{
    /**
     * Home constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $message
     */
    public function index($message = '')
    {
        $this->view->render('view', $message);
    }

    /**
     * Sign in
     */
    public function signin()
    {
        $username=filter_input(INPUT_POST,"username",FILTER_SANITIZE_STRING);
        $password=filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);
        $repassword=filter_input(INPUT_POST,"repassword",FILTER_SANITIZE_STRING);
        $message = 'Error, try again later.';
        if($password == $repassword) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "insert into admin (`username`,`password`) values ('$username','$password');";
            if ($this->db->query($sql)) {
                $message = 'User added, please login.';
            }
        }
        $this->index(['message' => $message]);
    }

    /**
     * Login
     */
    public function login()
    {
        $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);
        $sql = "select * from admin where `username`='$username';";
        $result = $this->db->query($sql);
        $user = $result->fetch_assoc();
        if($user && password_verify($password, $user['password'])){
            unset($_SESSION['logedin']);
            $_SESSION['logedin'] = $username;
            header('Location: '. DOMAIN . '/dashboard');
        }else{
            $this->index(['message' => 'Wrong login or password']);
        }
    }

    /**
     * Loged in user's dashboard
     */
    public function dashboard()
    {
        if(!isset($_SESSION['logedin'])){
            header('Location: '. DOMAIN );
        }
        $this->view->render('dashboard');
    }

    /**
     * Logout
     */
    public function logout(){
        session_unset();
        header('Location: '. DOMAIN);
    }
}