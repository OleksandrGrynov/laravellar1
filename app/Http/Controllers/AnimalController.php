<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $q = Animal::query()->latest();

        if ($request->filled('q')) {
            $q->where('name', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('category_id')) {
            $q->where('category_id', $request->category_id);
        }
        if ($request->filled('min')) {
            $q->where('price', '>=', (float)$request->min);
        }
        if ($request->filled('max')) {
            $q->where('price', '<=', (float)$request->max);
        }

        $animals = $q->paginate(9)->withQueryString();
        return view('animals.index', compact('animals'));
    }

    public function create()
    {
        return view('animals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
        ], [
            'required' => 'Поле :attribute є обов’язковим.',
            'min' => 'Поле :attribute не може бути від’ємним.',
            'image' => 'Фото має бути зображенням (jpg, png тощо).',
            'numeric' => 'Поле :attribute має бути числом.',
            'integer' => 'Поле :attribute має бути цілим числом.',
            'exists' => 'Вибрана категорія не існує.',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('animals', 'public');
        }

        Animal::create($data);
        return redirect()->route('animals.index')->with('status', '✅ Тварину додано!');
    }

    public function show(Animal $animal)
    {
        return view('animals.show', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        return view('animals.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
        ], [
            'required' => 'Поле :attribute є обов’язковим.',
            'min' => 'Поле :attribute не може бути від’ємним.',
            'image' => 'Фото має бути зображенням.',
            'numeric' => 'Поле :attribute має бути числом.',
            'integer' => 'Поле :attribute має бути цілим числом.',
            'exists' => 'Вибрана категорія не існує.',
        ]);

        if ($request->hasFile('image')) {
            if ($animal->image) {
                Storage::disk('public')->delete($animal->image);
            }
            $data['image'] = $request->file('image')->store('animals', 'public');
        }

        $animal->update($data);
        return redirect()->route('animals.show', $animal)->with('status', '🐾 Дані оновлено!');
    }

    public function destroy(Animal $animal)
    {
        if ($animal->image) {
            Storage::disk('public')->delete($animal->image);
        }
        $animal->delete();

        return redirect()->route('animals.index')->with('status', '🗑 Тварину видалено!');
    }
}
