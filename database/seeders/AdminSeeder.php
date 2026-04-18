<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $admins = [
            [
                'email'      => 'admin1@example.com',
                'password'   => Hash::make('password123'),
                'first_name' => 'Super',
                'last_name'  => 'Admin',
                'phone'      => '5551234567',
                'birth_month'=> 'February',
                'birth_day'  => '10',
                'status'     => 'active',
            ],
            [
                'email'      => 'admin2@example.com',
                'password'   => Hash::make('password123'),
                'first_name' => 'Sara',
                'last_name'  => 'Hosam',
                'phone'      => '5559876543',
                'birth_month'=> 'July',
                'birth_day'  => '4',
                'status'     => 'active',
            ],
            [
                'email'      => 'admin3@example.com',
                'password'   => Hash::make('password123'),
                'first_name' => 'Malak',
                'last_name'  => 'Banna',
                'phone'      => '5554443322',
                'birth_month'=> 'November',
                'birth_day'  => '30',
                'status'     => 'inactive',
            ],
        ];

        foreach ($admins as $data) {

            $admin = Admin::create([
                'email'    => $data['email'],
                'password' => $data['password'],
            ]);


            User::create([
                'first_name'  => $data['first_name'],
                'last_name'   => $data['last_name'],
                'phone'       => $data['phone'],
                'birth_month' => $data['birth_month'],
                'birth_day'   => $data['birth_day'],
                'status'      => $data['status'],
                'actor_type'  => 'App\\Models\\Admin',
                'actor_id'    => $admin->id,
            ]);
        }
    }
    }

