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
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|min:10|max:2000',
        ]);

        Order::create($validated);

        return redirect()->route('home')->with('success', 'Ваша заявка успешно отправлена!');
    }

    public function list()
    {
        $orders = Order::latest()->paginate(20);

        return view('orders', compact('orders'));
    }
}
