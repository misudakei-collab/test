<x-guest-layout>
    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">利用規約</h2>
        
        <div class="prose prose-sm text-gray-600 mb-10">
            <p>第1条（適用）...</p>
            <p>第2条（禁止事項）...</p>
        </div>

        <div class="mt-10 border-t pt-6 flex justify-center gap-4">
            <a href="{{ url('/contact') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition text-sm">
                フォームへ戻る
            </a>

            <button onclick="window.close()" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition text-sm">
                このページを閉じる
            </a>
        </div>
    </div>
</x-guest-layout>