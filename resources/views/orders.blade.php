@extends('layouts.app')

@section('title', 'Список заявок')

@section('content')

<section class="orders-section">
    <div class="orders-header">
        <h1>Список заявок</h1>
        <a href="{{ route('home') }}" class="btn btn--outline">← Назад</a>
    </div>

    @if ($orders->isEmpty())
        <div class="orders-empty">
            <p>Заявок пока нет.</p>
            <a href="{{ route('home') }}#order-form" class="btn" style="margin-top:1rem">Оставить первую заявку</a>
        </div>
    @else
        <div class="table-wrapper">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Сообщение</th>
                        <th>Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                            <td class="message-cell">{{ $order->message }}</td>
                            <td class="date-cell">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>

<style>
    .orders-section {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }

    .orders-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .orders-header h1 {
        font-size: 1.6rem;
        color: #1e3a8a;
    }

    .btn {
        display: inline-block;
        background: #2563eb;
        color: #fff;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.95rem;
        transition: background 0.2s;
    }

    .btn:hover {
        background: #1d4ed8;
    }

    .btn--outline {
        background: transparent;
        border: 2px solid #2563eb;
        color: #2563eb;
    }

    .btn--outline:hover {
        background: #2563eb;
        color: #fff;
    }

    .orders-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: #64748b;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .orders-table th,
    .orders-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    .orders-table th {
        background: #f8fafc;
        font-weight: 600;
        color: #374151;
        white-space: nowrap;
    }

    .orders-table tbody tr:hover {
        background: #f1f5f9;
    }

    .orders-table a {
        color: #2563eb;
        text-decoration: none;
    }

    .orders-table a:hover {
        text-decoration: underline;
    }

    .message-cell {
        max-width: 300px;
        word-break: break-word;
    }

    .date-cell {
        white-space: nowrap;
        color: #64748b;
        font-size: 0.88rem;
    }

    @media (max-width: 600px) {
        .orders-section {
            padding: 1.25rem;
        }

        .orders-table th,
        .orders-table td {
            padding: 0.6rem 0.6rem;
            font-size: 0.88rem;
        }
    }
</style>

@endsection
