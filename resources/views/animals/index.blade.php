@extends('layouts.app')

@section('title', 'Каталог тварин')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/modal.js') }}" defer></script>

    <div class="catalog-container">
        <h1 class="catalog-title">🐾 Каталог тварин</h1>

        @if($animals->count())
            <div class="cards-container">
                <form method="GET" class="filter-bar">
                    <input type="text" name="q" placeholder="Пошук..." value="{{ request('q') }}">

                    <select name="category_id">
                        <option value="">Усі категорії</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    <label>Ціна від:
                        <input type="number" name="min" value="{{ request('min') }}">
                    </label>
                    <label>до:
                        <input type="number" name="max" value="{{ request('max') }}">
                    </label>

                    <button type="submit" class="btn">🔍 Фільтрувати</button>
                    <a href="{{ route('animals.index') }}" class="btn clear">Скинути</a>
                </form>

            @foreach($animals as $animal)
                    <div class="animal-card" data-id="{{ $animal->id }}">
                        <div class="animal-image">
                            @if($animal->image)
                                <img src="{{ asset('storage/' . $animal->image) }}" alt="{{ $animal->name }}">
                            @else
                                <div class="no-photo">📷 Без фото</div>
                            @endif
                        </div>

                        <div class="animal-info">
                            <div class="animal-text">
                                <h2>{{ $animal->name }}</h2>
                                <p class="species">{{ $animal->species }} • {{ $animal->age }} р.</p>
                                <p class="desc">{{ Str::limit($animal->description, 90) }}</p>
                            </div>

                            <div class="animal-bottom">
                                <p class="price">{{ number_format($animal->price, 0, ',', ' ') }} ₴</p>

                                <div class="buttons">
                                    <a href="{{ route('animals.show', $animal) }}" class="btn details">Детальніше</a>


                                    <button class="btn cart-btn"
                                            data-id="{{ $animal->id }}"
                                            data-name="{{ $animal->name }}"
                                            data-price="{{ $animal->price }}">
                                        🛒 До кошика
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty">Каталог поки порожній 🐶</p>
        @endif
    </div>

    {{-- МОДАЛЬНЕ ВІКНО --}}
    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="modal-close" class="close">&times;</span>
            <img id="modal-image" src="" alt="">
            <h2 id="modal-name"></h2>
            <p id="modal-species"></p>
            <p id="modal-age"></p>
            <p id="modal-desc"></p>
            <p id="modal-price" class="price"></p>
        </div>
    </div>

@endsection

@push('modals')
    {{-- МОДАЛЬНЕ ВІКНО --}}
    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <span id="modal-close" class="close">&times;</span>
            <img id="modal-image" src="" alt="">
            <h2 id="modal-name"></h2>
            <p id="modal-species"></p>
            <p id="modal-age"></p>
            <p id="modal-desc"></p>
            <p id="modal-price" class="price"></p>
        </div>
    </div>

    {{-- МОДАЛЬНЕ ВІКНО ДЛЯ КОШИКА --}}
    <div id="cartModal" class="modal hidden">
        <div class="modal-content small">
            <span id="cart-close" class="close">&times;</span>
            <h3>Додати до кошика</h3>
            <p id="cart-item-name"></p>
            <p>Ціна: <span id="cart-item-price"></span> ₴</p>

            <form id="cart-form" method="POST" action="{{ route('cart.add', ['animal' => 0]) }}">
                @csrf
                <input type="hidden" name="animal_id" id="animal_id">
                <label>Кількість:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="10">
                <button type="submit" class="btn cart">Підтвердити</button>
            </form>
        </div>
    </div>
@endpush

