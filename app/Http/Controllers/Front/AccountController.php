<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function orders()
    {
        $orders = Auth::user()->orders()->latest()->get();

        return view('front.account.orders', compact('orders'));
    }
}