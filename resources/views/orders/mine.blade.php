@extends('layouts.app')
@section('title', 'Мої замовлення')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <div class="orders-container">
        <h1 class="orders-title">📦 Мої замовлення</h1>

        @if($orders->isEmpty())
            <p class="empty">У вас ще немає замовлень 😿</p>
        @else
            <table class="orders-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Дата</th>
                    <th>Сума</th>
                    <th>Статус</th>
                    <th>Товари</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td><b>{{ number_format($order->total, 2) }} ₴</b></td>

                        {{-- кольоровий статус --}}
                        <td>
                            <span class="status {{ $order->status }}">
                                {{ __('statuses.' . $order->status) }}
                            </span>
                        </td>

                        <td>
                            <details>
                                <summary>Показати</summary>
                                <ul>
                                    @foreach($order->items as $item)
                                        <li>
                                            {{ $item->animal->name ?? '—' }} × {{ $item->qty }}
                                            ({{ number_format($item->price, 2) }} ₴)
                                        </li>
                                    @endforeach
                                </ul>
                            </details>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
