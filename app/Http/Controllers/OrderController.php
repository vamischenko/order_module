<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        Order::create($request->only(['name', 'email', 'message']));

        return redirect()->route('home')->with('success', 'Ваша заявка успешно отправлена!');
    }

    public function list()
    {
        $orders = Order::latest()->get();

        return view('orders', compact('orders'));
    }
}
