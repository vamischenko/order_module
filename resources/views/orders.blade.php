@extends('layouts.app')

@section('title', 'Список заявок')

@section('content')

<section class="orders-section">
    <div class="orders-header">
        <h1>Список заявок</h1>
        <a href="{{ route('home') }}" class="btn btn--outline">← Назад</a>
    </div>

    <form class="orders-search" action="{{ route('orders.list') }}" method="GET">
        <input
            class="orders-search__input"
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Поиск по имени или email"
            maxlength="255"
        >
        <button class="btn" type="submit">Найти</button>
        @if ($search !== '')
            <a href="{{ route('orders.list') }}" class="btn btn--outline">Сбросить</a>
        @endif
    </form>

    @if ($orders->isEmpty())
        <div class="orders-empty">
            @if ($search !== '')
                <p>По запросу «{{ $search }}» ничего не найдено.</p>
                <a href="{{ route('orders.list') }}" class="btn btn--outline" style="margin-top:1rem">Показать все заявки</a>
            @else
                <p>Заявок пока нет.</p>
                <a href="{{ route('home') }}#order-form" class="btn" style="margin-top:1rem">Оставить первую заявку</a>
            @endif
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

        @if ($orders->hasPages())
            <div class="pagination-wrapper">
                {{ $orders->links() }}
            </div>
        @endif
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

    .orders-search {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .orders-search__input {
        flex: 1;
        min-width: 200px;
        padding: 0.65rem 0.9rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        background: #fafafa;
    }

    .orders-search__input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        background: #fff;
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

    .pagination-wrapper {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper nav {
        display: flex;
        gap: 0.25rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination-wrapper span,
    .pagination-wrapper a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2rem;
        height: 2rem;
        padding: 0 0.5rem;
        border-radius: 6px;
        font-size: 0.9rem;
        border: 1px solid #e2e8f0;
        color: #374151;
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
    }

    .pagination-wrapper a:hover {
        background: #f1f5f9;
    }

    .pagination-wrapper span[aria-current="page"] > span {
        background: #2563eb;
        color: #fff;
        border-color: #2563eb;
    }

    .pagination-wrapper span.disabled {
        opacity: 0.4;
        pointer-events: none;
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
