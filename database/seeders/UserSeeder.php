<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //User::factory()->create(10);

        User::create([
            'name' => 'Emanuel Ramirez',
            'email' => 'emanuel@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('ema23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);


        User::create([
            'name' => 'Bihui Yu',
            'email' => 'vicky@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('vicky23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Sara Rios',
            'email' => 'sara@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('sara23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Noe Hernandez',
            'email' => 'noe@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('noe23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Manuel Contreras',
            'email' => 'manuel@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('manuel23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Luis Meza',
            'email' => 'luismeza@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('luismeza23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Juan Gonzalez',
            'email' => 'jgonzalez@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('jgonzalez23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Gabriel Santos',
            'email' => 'gsantos@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('gsantos23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Luis Mariscal',
            'email' => 'lmariscal@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('lmariscal23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Leticia Baes',
            'email' => 'lbaes@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('lbaes23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Arturo Trujillo',
            'email' => 'atrujillo@massivehome.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('atrujillo23'), // password
            'remember_token' => Str::random(10),
            'email_verified_at' => null,
        ]);
        
    }
}
