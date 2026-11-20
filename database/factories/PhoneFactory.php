<?php

namespace Database\Factories;

use App\Models\Phone;
use App\Models\UserPhone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Phone>
 */
class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition(): array
    {
        return [
            'user_phone_id' => UserPhone::factory(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
        ];
    }
}
