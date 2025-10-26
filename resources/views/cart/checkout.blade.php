@extends('layouts.app')
@section('title','Оформлення замовлення')
@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Оформлення замовлення</h1>

        <div class="mb-4 text-gray-700">
            Товарів: {{ count($cart) }} • Разом: <b>{{ number_format($total,2) }} ₴</b>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="space-y-3">
            @csrf

            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-3 need-validation">
                @csrf
                <input name="customer_name" class="w-full border rounded p-2" placeholder="Ім'я та прізвище" required>

                {{-- 📞 Телефон з маскою --}}
                <input name="customer_phone"
                       type="tel"
                       class="w-full border rounded p-2 phone-input"
                       placeholder="+380 (__) ___-____"
                       required>

                <input name="customer_email" class="w-full border rounded p-2" placeholder="Email (необов'язково)">
                <textarea name="note" class="w-full border rounded p-2" rows="3" placeholder="Коментар (необов'язково)"></textarea>
                <button class="btn btn-blue w-full">Підтвердити замовлення</button>
            </form>


        </form>
    </div>
@endsection
