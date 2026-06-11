<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Укажите ваше имя.',
            'name.max'         => 'Имя не должно превышать :max символов.',
            'email.required'   => 'Укажите email.',
            'email.email'      => 'Введите корректный email.',
            'email.max'        => 'Email не должен превышать :max символов.',
            'message.required' => 'Напишите сообщение.',
            'message.min'      => 'Сообщение должно содержать минимум :min символов.',
            'message.max'      => 'Сообщение не должно превышать :max символов.',
        ];
    }
}
