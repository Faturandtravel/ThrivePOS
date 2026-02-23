<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function dashboard()
    {
        return view('pos.dashboard');
    }

    public function cashier()
    {
        return view('pos.cashier');
    }

    public function product()
    {
        return view('pos.product');
    }

    public function setting()
    {
        return view('pos.setting');
    }
}