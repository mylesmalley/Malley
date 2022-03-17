<?php

namespace Database\Factories;

use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function malley()
    {
        return $this->state(function (array $attributes) {
            return [
                'company_id' => 2,
            ];
        });
    }

    public function not_malley()
    {
        return $this->state(function (array $attributes) {
            return [
                'company_id' => rand(3, DB::table('companies')->count()),
            ];
        });
    }

    public function enabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_enabled' => 1,
            ];
        });
    }

    public function disabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_enabled' => 0,
            ];
        });
    }

    public function unnassigned()
    {
        return $this->state(function (array $attributes) {
            return [
                'company_id' => 1,
            ];
        });
    }

    public function hasDepartment()
    {
        return $this->state(function (array $attributes) {
            return [
                'department_id' => rand(1, DB::table('departments')->count()),
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_enabled' => 1,
            'company_id' =>  rand(2, DB::table('companies')->count()),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Define the model's unverified state.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
