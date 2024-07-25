<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('admin/home');
    }

    public function report(): string
    {
        return view('admin/report');
    }
}
