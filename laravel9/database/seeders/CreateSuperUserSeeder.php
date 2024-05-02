<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateSuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUser = User::create([
            'email'=>'admin@admin.gmail.com',
            'name'=>'Admin',
            'password'=>Hash::make('secret'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        // создать пользователя для роли
        Role::create([
            'name' => 'super-user',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        // назначить роль
        $superUser->assignRole('super-user');
    }
}
