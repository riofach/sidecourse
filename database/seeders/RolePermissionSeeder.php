<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //seeder bawaan laravel : php artisan make:seeder RolePermissionSeeder    
    public function run(): void
    {
        //membuat beberapa role
        $ownerRole = Role::create([
            'name' => 'owner'
        ]);
        $studentRole = Role::create([
            'name' => 'student'
        ]);
        $teacherRole = Role::create([
            'name' => 'teacher'
        ]);

        //akun superadmin untuk kelola data awal
        $userOwner = User::create([
            'name' => 'Fachrio Raditya',
            'occupation' => 'Education',
            'avatar' => 'images/default-avatar.png',
            'email' => 'rio@owner.com',
            'password' => bcrypt('rio123')
        ]);

        $userOwner->assignRole($ownerRole);
        //setelah di assignRole ke DatabaseSeeder dan lakukan php artisan migrate:fresh --seed
        //agar data diatas masuk ke database User
    }
}