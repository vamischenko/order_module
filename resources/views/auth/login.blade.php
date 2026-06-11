@extends('layouts.app')

@section('title', 'Вход для администратора')

@section('content')

<section class="login-section">
    <h1>Вход</h1>
    <p class="login-subtitle">Страница заявок доступна только авторизованным пользователям</p>

    <form class="form" action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div class="form__group">
            <label class="form__label" for="email">Email <span class="required">*</span></label>
            <input
                class="form__input @error('email') form__input--error @enderror"
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="admin@example.com"
                required
                maxlength="255"
                autofocus
            >
            @error('email')
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form__group">
            <label class="form__label" for="password">Пароль <span class="required">*</span></label>
            <input
                class="form__input @error('password') form__input--error @enderror"
                type="password"
                id="password"
                name="password"
                placeholder="Введите пароль"
                required
            >
            @error('password')
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form__group form__group--inline">
            <label class="form__checkbox-label">
                <input type="checkbox" name="remember"> Запомнить меня
            </label>
        </div>

        <button class="btn" type="submit">Войти</button>
    </form>
</section>

<style>
    .login-section {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        max-width: 480px;
        margin: 0 auto;
    }

    .login-section h1 {
        font-size: 1.6rem;
        color: #1e3a8a;
        margin-bottom: 0.25rem;
    }

    .login-subtitle {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 1.75rem;
    }

    .form__group--inline {
        display: flex;
        align-items: center;
    }

    .form__checkbox-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: #374151;
        cursor: pointer;
    }

    .btn {
        width: 100%;
        text-align: center;
    }
</style>

@endsection
