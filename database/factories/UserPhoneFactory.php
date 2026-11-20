<?php

namespace Database\Factories;

use App\Models\UserPhone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserPhone>
 */
class UserPhoneFactory extends Factory
{
    protected $model = UserPhone::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->userName(),
        ];
    }
}
