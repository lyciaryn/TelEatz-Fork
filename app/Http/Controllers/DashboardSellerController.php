<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSellerController extends Controller
{
    public function index()
    {
        return view('seller.dashboard');
    }
}
