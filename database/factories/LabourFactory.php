<?php

namespace Database\Factories;

use App\Models\labour;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;class LabourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = labour::class;

    protected string $timezone =  "America/Moncton";

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'end' => null,
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
        $end = Carbon::now( $this->timezone )->toIso8601String();
        $start = Carbon::now( $this->timezone )->subHours( rand(1, 5) )->toIso8601String();


        return [
            "job" => $this->faker->randomElement(["A1000", 'PL1230', 'XYZ1A', 'CD002' ]),
        //    "user_id" => rand(1, 50),
            'department_id' => rand(1, DB::table('departments')->count() ),
            "start" => $start,
            'end' => $end,
        ];
    }
}
