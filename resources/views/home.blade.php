@extends('layouts.app')

@section('title', 'Наши услуги')

@section('content')

{{-- Блок услуг --}}
<section class="services">
    <div class="services__header">
        <h1>Наши услуги</h1>
        <p class="services__subtitle">Мы предлагаем профессиональные решения для вашего бизнеса</p>
    </div>

    <div class="cards">
        <div class="card">
            <div class="card__icon">🔧</div>
            <h2 class="card__title">Техническое обслуживание</h2>
            <p class="card__text">Регулярное обслуживание оборудования и профилактика неисправностей для бесперебойной работы.</p>
        </div>
        <div class="card">
            <div class="card__icon">💻</div>
            <h2 class="card__title">Разработка ПО</h2>
            <p class="card__text">Создание веб-приложений и корпоративных систем под ключ с учётом ваших требований.</p>
        </div>
        <div class="card">
            <div class="card__icon">📞</div>
            <h2 class="card__title">Техническая поддержка</h2>
            <p class="card__text">Оперативная помощь специалистов 24/7. Решаем любые технические вопросы в кратчайшие сроки.</p>
        </div>
    </div>

    <div class="services__cta">
        <a href="#order-form" class="btn">Оставить заявку</a>
    </div>
</section>

{{-- Форма заявки --}}
<section class="form-section" id="order-form">
    <h2>Оставьте заявку</h2>
    <p class="form-section__subtitle">Заполните форму, и мы свяжемся с вами в течение рабочего дня</p>

    <form class="form" action="{{ route('orders.store') }}" method="POST" novalidate>
        @csrf

        <div class="form__group">
            <label class="form__label" for="name">Имя <span class="required">*</span></label>
            <input
                class="form__input @error('name') form__input--error @enderror"
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Введите ваше имя"
            >
            @error('name')
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form__group">
            <label class="form__label" for="email">Email <span class="required">*</span></label>
            <input
                class="form__input @error('email') form__input--error @enderror"
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="example@mail.com"
            >
            @error('email')
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form__group">
            <label class="form__label" for="message">Сообщение <span class="required">*</span></label>
            <textarea
                class="form__input form__textarea @error('message') form__input--error @enderror"
                id="message"
                name="message"
                placeholder="Опишите вашу задачу (минимум 10 символов)"
            >{{ old('message') }}</textarea>
            @error('message')
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn" type="submit">Отправить заявку</button>
    </form>
</section>

<style>
    /* Услуги */
    .services {
        margin-bottom: 3rem;
    }

    .services__header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .services__header h1 {
        font-size: 2rem;
        color: #1e3a8a;
        margin-bottom: 0.5rem;
    }

    .services__subtitle {
        color: #64748b;
        font-size: 1.05rem;
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        padding: 1.75rem 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    }

    .card__icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .card__title {
        font-size: 1.1rem;
        color: #1e3a8a;
        margin-bottom: 0.75rem;
    }

    .card__text {
        font-size: 0.95rem;
        color: #64748b;
    }

    .services__cta {
        text-align: center;
    }

    /* Кнопка */
    .btn {
        display: inline-block;
        background: #2563eb;
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        border: none;
        font-size: 1rem;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s;
    }

    .btn:hover {
        background: #1d4ed8;
    }

    /* Форма */
    .form-section {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        max-width: 640px;
        margin: 0 auto;
    }

    .form-section h2 {
        font-size: 1.5rem;
        color: #1e3a8a;
        margin-bottom: 0.25rem;
    }

    .form-section__subtitle {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .form__group {
        margin-bottom: 1.25rem;
    }

    .form__label {
        display: block;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: #374151;
    }

    .required {
        color: #ef4444;
    }

    .form__input {
        width: 100%;
        padding: 0.65rem 0.9rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #fafafa;
    }

    .form__input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        background: #fff;
    }

    .form__input--error {
        border-color: #ef4444;
    }

    .form__textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form__error {
        display: block;
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.3rem;
    }

    /* Адаптив */
    @media (max-width: 768px) {
        .cards {
            grid-template-columns: 1fr;
        }

        .services__header h1 {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 480px) {
        .form-section {
            padding: 1.25rem;
        }
    }
</style>

@endsection
