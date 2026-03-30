<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            // カテゴリーIDをランダムに取得
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,

            // 姓名を分けて生成
            'first_name'  => $this->faker->firstName(),
            'last_name'   => $this->faker->lastName(),

            // 1:男性, 2:女性, 3:その他
            'gender'      => $this->faker->numberBetween(1, 3),

            'email'       => $this->faker->unique()->safeEmail(),

            // 🟢 修正：'tell' を 'tel' に変更（SQLエラーを回避）
            // テスト用にリアルな11桁の数字（ハイフンなし）を生成するようにしました
            'tel' => $this->faker->numberBetween(1000000000, 99999999999),

            'address'     => $this->faker->address(),
            'building'    => $this->faker->secondaryAddress(),

            // お問い合わせ内容は120文字以内
            'detail'      => $this->faker->realText(100),

            // 🕒 追加：作成日時をバラバラに（管理画面の並び替えテストのため）
            'created_at'  => $this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at'  => now(),
        ];
    }
}
