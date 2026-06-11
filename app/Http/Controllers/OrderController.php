<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(StoreOrderRequest $request)
    {
        Order::create($request->validated());

        return redirect()->route('home')->with('success', 'Ваша заявка успешно отправлена!');
    }

    public function list(Request $request)
    {
        $search = $request->string('search')->trim()->value();

        $orders = Order::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('orders', compact('orders', 'search'));
    }
}
