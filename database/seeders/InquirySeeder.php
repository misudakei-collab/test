<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    public function run(): void
    {
        // 規約に基づき、マジックナンバーを避けたい場合は件数を変数に
        $numberOfInquiries = 15;

        // 日本語フォーム用（countryNameがnullを想定）
        Inquiry::factory()->count($numberOfInquiries)->create([
            'countryName' => null,
        ]);

        // 英語フォーム用（countryNameが入っている想定）
        Inquiry::factory()->count(5)->create([
            'countryName' => 'United States',
        ]);
    }
}
