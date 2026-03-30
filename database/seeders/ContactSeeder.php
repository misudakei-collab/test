<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        // 既存のデータを全削除
        Contact::truncate();

        // 先ほど修正したFactoryを使って50件作成
        Contact::factory()->count(50)->create();
    }
}
