<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $category_count = Category::count();
        $order_count = Order::count();
        $orders = Order::all();
        $product_count = Product::count();
        $client_count = Client::count();
        $user_count = User::whereRoleIs('admin')->count();

        return view('dashboard.home', compact('category_count','client_count','product_count','user_count','order_count','orders'));
    }
    public function logout()
    {
        auth()->logout();

        return view('auth.login');
    }
}
