@extends('layouts.app')
@section('title', 'Адмін-панель')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">👑 Адмін-панель</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.animals.create') }}" class="btn btn-blue">➕ Додати тварину</a>
                <a href="{{ route('animals.index') }}" class="btn btn-yellow">📚 Каталог</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="font-semibold mb-3">🛒 Замовлення користувачів</h2>

            @if($orders->count())
                <table class="w-full text-sm border">
                    <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-2">ID</th>
                        <th class="p-2">Клієнт</th>
                        <th class="p-2">Сума</th>
                        <th class="p-2">Статус</th>
                        <th class="p-2">Товари</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $o)
                        <tr class="border-t">
                            <td class="p-2">{{ $o->id }}</td>
                            <td class="p-2">
                                {{ $o->customer_name }}<br>
                                <span class="text-gray-500 text-xs">{{ $o->customer_phone }}</span>
                            </td>
                            <td class="p-2">{{ number_format($o->total, 2) }} ₴</td>
                            <td class="p-2">
                                <form method="POST" action="{{ route('admin.updateStatus', $o) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="border rounded p-1">
                                        @foreach(['new'=>'Нове','paid'=>'Оплачено','shipped'=>'Відправлено','done'=>'Завершено','canceled'=>'Скасовано'] as $k=>$v)
                                            <option value="{{ $k }}" @selected($o->status==$k)>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="p-2">
                                <details>
                                    <summary class="cursor-pointer text-blue-600">Показати</summary>
                                    <ul class="pl-5 list-disc">
                                        @foreach($o->items as $it)
                                            <li>{{ $it->animal->name ?? 'Видалено' }} × {{ $it->qty }}</li>
                                        @endforeach
                                    </ul>
                                    <a class="text-sm text-indigo-600 inline-block mt-1"
                                       href="{{ route('admin.orders.show', $o) }}">Деталі</a>
                                </details>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $orders->links() }}</div>
            @else
                <p class="text-gray-600">Немає замовлень</p>
            @endif
        </div>
    </div>
@endsection
