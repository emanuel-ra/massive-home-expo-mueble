<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prospect>
 */
class ProspectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $commercial_business = ['Iluminación' ,'Audio','Cámaras','Linea Blanca','Soportes TV'];

        return [
            'name' => fake()->name() ,
            'company_name' => fake()->company() ,
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address() , 
            'country' => fake()->country() , 
            'estate' => fake()->state() , 
            'city' => fake()->city() , 
            'commercial_business' => fake()->randomElement($commercial_business) , 
            'observations' => fake()->text() , 
            'user_id' => User::all()->random()->id , 
        ];
    }
}
