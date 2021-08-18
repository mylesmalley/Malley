<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use DB;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;


    public function malley()
    {
        return $this->state(function (array $attributes) {
            return [
                'company_id' => 2
            ];
        });
    }

    public function not_malley()
    {
        return $this->state(function (array $attributes) {
            return [
                'company_id' => rand( 3, DB::table('companies')->count() )
            ];
        });
    }


    public function enabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_enabled' => 1
            ];
        });
    }

    public function disabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_enabled' => 0
            ];
        });
    }

    public function unnassigned()
    {
        return $this->state(function (array $attributes) {
            return [
                'company_id' => 1
            ];
        });
    }



    public function hasDepartment()
    {
        return $this->state(function (array $attributes) {
            return [
                'department_id' => rand( 1, DB::table('departments')->count() ) ,
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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_enabled' => 1,
            'company_id' =>  rand( 2, DB::table('companies')->count() ) ,
            'remember_token' => Str::random(10),
        ];
    }
}
