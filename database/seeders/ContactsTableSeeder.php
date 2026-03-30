<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Category;

class ContactsTableSeeder extends Seeder
{
    public function run()
    {
        // カテゴリが空の場合は作成（念のため）
        if (Category::count() == 0) {
            $categories = ['商品のお届けについて', '商品の交換について', '商品購入について', 'ショップへのお問い合わせ', 'その他'];
            foreach ($categories as $cat) {
                Category::create(['content' => $cat]);
            }
        }

        // テストデータを10件作成
        for ($i = 1; $i <= 10; $i++) {
            Contact::create([
                'category_id' => rand(1, 5),
                'first_name'  => '太郎' . $i,
                'last_name'   => '山田',
                'gender'      => rand(1, 3),
                'email'       => 'test' . $i . '@example.com',
                'tel'         => '0901234567' . $i,
                'address'     => '東京都渋谷区道玄坂1-2-3',
                'building'    => 'テストビル' . $i . 'F',
                'detail'      => 'これは' . $i . '件目のテスト用のお問い合わせ内容です。',
            ]);
        }
    }
}
