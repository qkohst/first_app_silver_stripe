<?php

use SilverStripe\Control\HTTPRequest;


class AuthController extends PageController
{
    private static $allowed_actions = [
        'login',
        'doLogin',
        'register',
        'doRegister'
    ];

    public function login(HTTPRequest $request)
    {
        $data = [
            "siteParent" => "Login",
            "site" => "Login"
        ];

        return $this->customise($data)->renderWith((array(
            'Login', 'Auth',
        )));
    }

    public function doLogin(HTTPRequest $request)
    {
        print_r($request['AuthenticationMethod']);
        die;
        // $data = [
        //     "siteParent" => "Login",
        //     "site" => "Login"
        // ];
    }

    public function register(HTTPRequest $request)
    {
        $data = [
            "siteParent" => "Register",
            "site" => "Register"
        ];

        return $this->customise($data)->renderWith((array(
            'Register', 'Auth',
        )));
    }

    public function doRegister(HTTPRequest $request)
    {
        // $data = [
        //     "siteParent" => "Login",
        //     "site" => "Login"
        // ];
    }
}
