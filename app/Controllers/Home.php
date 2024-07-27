<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('admin/home');
    }
    public function landing(): string
    {
        return view('landing');
    }
    public function produk(): string
    {
        return view('product');
    }
    public function aboutus(): string
    {
        return view('aboutus');
    }

    public function report(): string
    {
        return view('admin/report');
    }
}
