<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function display(): string
    {
        return view('Home/welcome_message');
    }

    public function info(): string
    {
        return view('Info/info');
    }
}
