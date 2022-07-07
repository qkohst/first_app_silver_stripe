<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Convert;

class AuthController extends ContentController
{
    private static $allowed_actions = [
        'login',
        'doLogin',
        'register',
        'doRegister',
        'doLogout'
    ];
    public function init()
    {
        parent::init();
        @session_start();
    }

    public function login(HTTPRequest $request)
    {
        $user_logged_id = isset($_SESSION['logged_user_id']) ? $_SESSION['logged_user_id'] : "";
        if ($user_logged_id) {
            return $this->redirect(Director::absoluteBaseURL() . "Dashboard");
        }
        
        $statusRegister = "";
        $msgRegister = "";
        if (isset($_SESSION['register_status'])) {
            $statusRegister = $_SESSION['register_status'];
            $msgRegister = $_SESSION['register_msg'];
            unset($_SESSION['register_status']);
            unset($_SESSION['register_msg']);
        }

        $statusLogin = "";
        $msgLogin = "";
        if (isset($_SESSION['login_status'])) {
            $statusLogin = $_SESSION['login_status'];
            $msgLogin = $_SESSION['login_msg'];
            unset($_SESSION['login_status']);
            unset($_SESSION['login_msg']);
        }

        $data = [
            "siteParent" => "Login",
            "site" => "Login",
            "StatusLogin" => $statusLogin,
            "msglogin" => $msgLogin,
            "StatusRegister" => $statusRegister,
            "msgRegister" => $msgRegister,

        ];

        return $this->customise($data)->renderWith((array(
            'Login', 'Auth',
        )));
    }

    public function doLogin(HTTPRequest $request)
    {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $user = User::get()->filter(['Email' => $email])->first();

        if (is_null($user)) {
            $_SESSION['login_status'] = "error";
            $_SESSION['login_msg'] = "Email tidak ditemukan";
            return $this->redirectBack();
        }

        if (password_verify($password, $user->Password) == 1) {
            $_SESSION['logged_user_id'] = $user->ID;
            $_SESSION['logged_user_email'] = $user->Email;
            $_SESSION['logged_user_name'] = $user->NamaLengkap;
            return $this->redirect(Director::absoluteBaseURL() . 'Dashboard');
        } else {
            $_SESSION['login_status'] = "error";
            $_SESSION['login_msg'] = "Password Salah";
            return $this->redirectBack();
        }
    }

    public function register(HTTPRequest $request)
    {
        $status = "";
        $msg = "";
        if (isset($_SESSION['register_status'])) {
            $status = $_SESSION['register_status'];
            $msg = $_SESSION['register_msg'];
            unset($_SESSION['register_status']);
        }

        $data = [
            "siteParent" => "Register",
            "site" => "Register",
            "Status" => $status,
            "msg" => $msg
        ];

        return $this->customise($data)->renderWith((array(
            'Register', 'Auth',
        )));
    }

    public function doRegister(HTTPRequest $request)
    {
        // Validation Nama Lengkap 
        if (trim($_REQUEST['namaLengkap']) == null) {
            $_SESSION['register_status'] = "error";
            $_SESSION['register_msg'] = "Nama Lengkap tidak boleh kosong";
            return $this->redirectBack();
        }
        // Validation password 
        if (strlen($_POST['password']) < 8) {
            $_SESSION['register_status'] = "error";
            $_SESSION['register_msg'] = "Password minimal terdiri 8 karakter";
            return $this->redirectBack();
        } elseif ($_POST['password'] != $_POST['confirmPassword']) {
            $_SESSION['register_status'] = "error";
            $_SESSION['register_msg'] = "Password dan Konfirmasi password tidak sesuai";
            return $this->redirectBack();
        }
        // Validation Unique Email
        $check_user = User::get()->filter([
            'Email' => Convert::raw2sql($_REQUEST['email'])
        ]);

        if (count($check_user) == 0) {
            $user = User::create();
            $user->NamaLengkap = Convert::raw2sql($_REQUEST['namaLengkap']);
            $user->Email = Convert::raw2sql($_REQUEST['email']);
            $user->Password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
            $user->write();

            $_SESSION['register_status'] = "success";
            $_SESSION['register_msg'] = "Registrasi berhasil, silahkan login";
            return $this->redirect(Director::absoluteBaseURL() . "Auth/login");
        } else {
            $_SESSION['register_status'] = "error";
            $_SESSION['register_msg'] = "Email sudah digunakan oleh user lain";
            return $this->redirectBack();
        }
    }

    public function doLogout()
    {
        session_destroy();
        return $this->redirect(Director::absoluteBaseURL() . 'Auth/login');
    }
}
