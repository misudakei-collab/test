<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'            => $this->faker->name(),
            'kana'            => 'テスト カナ',
            'email'           => $this->faker->unique()->safeEmail(),
            'telephoneNumber' => $this->faker->phoneNumber(),
            'gender'          => $this->faker->randomElement(['男性', '女性', 'その他']),
            'birthDate'       => $this->faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
            'countryName'     => $this->faker->country(),
            'title'           => $this->faker->realText(20),
            'content'         => $this->faker->realText(200),
            'isRead'          => $this->faker->boolean(50),
            'isCompleted'     => $this->faker->boolean(20),
            // ↓ この行を削除してください
            // 'createdAt'    => now(),
        ];
    }
}
