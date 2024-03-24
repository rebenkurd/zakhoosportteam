<?php

namespace Database\Seeders\Backend;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User as UserModel;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserModel::factory()
            ->count(20)
            ->create();
            
    }
}
