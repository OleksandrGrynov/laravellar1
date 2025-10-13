<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');                // Назва тварини
            $table->string('species');             // Вид (кіт, собака, тощо)
            $table->integer('age');                // Вік
            $table->decimal('price', 10, 2);       // Ціна
            $table->text('description');           // Опис
            $table->string('image')->nullable();   // Фото
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
