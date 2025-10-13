@extends('layouts.app')
@section('title','Каталог тварин')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 mb-6">
            <h1 class="text-2xl font-bold">🐾 Каталог тварин</h1>

            <form method="GET" class="flex flex-wrap gap-2 items-center">
                <input name="q" value="{{ request('q') }}" class="border rounded p-2" placeholder="Пошук…">
                @php($cats = \App\Models\Category::orderBy('name')->get())
                <select name="category_id" class="border rounded p-2">
                    <option value="">Всі категорії</option>
                    @foreach($cats as $c)
                        <option value="{{ $c->id }}" @selected(request('category_id')==$c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
                <input name="min" value="{{ request('min') }}" class="border rounded p-2 w-28" placeholder="Ціна від">
                <input name="max" value="{{ request('max') }}" class="border rounded p-2 w-28" placeholder="до">
                <button class="btn btn-blue">Фільтрувати</button>
                <a href="{{ route('animals.index') }}" class="btn btn-yellow">Скинути</a>
            </form>
        </div>

        @if($animals->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($animals as $a)
                    <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition">
                        <img src="{{ $a->image ? asset('storage/'.$a->image) : 'https://placehold.co/600x400?text=No+photo' }}"
                             class="h-48 w-full object-cover" alt="">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-lg">{{ $a->name }}</h3>
                                <div class="font-semibold whitespace-nowrap">{{ number_format($a->price,2) }} ₴</div>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $a->category->name ?? $a->species }} • вік: {{ $a->age }}
                            </div>
                            <div class="mt-3 flex gap-2">
                                <a href="{{ route('animals.show',$a) }}" class="btn btn-yellow">Детальніше</a>
                                <form action="{{ route('cart.add',$a) }}" method="POST" class="inline">@csrf
                                    <button class="btn btn-blue">У кошик</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $animals->links() }}</div>
        @else
            <p class="text-gray-500">Каталог поки порожній 🐕</p>
        @endif
    </div>
@endsection
