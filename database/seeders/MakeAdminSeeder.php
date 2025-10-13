<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class MakeAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::where('email', 'hrynovoleksandr@hpk.edu.ua')->update(['is_admin' => true]);
    }
}
