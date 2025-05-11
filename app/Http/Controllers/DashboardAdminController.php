<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    
    public function index()
    {
        return view('admin.dashboard');
    }

}