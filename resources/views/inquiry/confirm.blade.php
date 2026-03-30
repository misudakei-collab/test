<x-guest-layout>
    <div class="max-w-lg mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">入力内容の確認</h2>

        <div class="space-y-4 text-gray-700">
            <div><span class="text-sm text-gray-500">お名前:</span> <p class="font-semibold">{{ $inputs['name'] }}</p></div>
            <div><span class="text-sm text-gray-500">ふりがな:</span> <p class="font-semibold">{{ $inputs['kana'] ?? '未入力' }}</p></div>
            <div><span class="text-sm text-gray-500">メールアドレス:</span> <p class="font-semibold">{{ $inputs['email'] }}</p></div>
            <div><span class="text-sm text-gray-500">件名:</span> <p class="font-semibold">{{ $inputs['title'] }}</p></div>
            <div><span class="text-sm text-gray-500">お問い合わせ内容:</span> <p class="font-semibold whitespace-pre-wrap">{{ $inputs['content'] }}</p></div>
        </div>

        <form action="{{ route('contact.store') }}" method="POST" class="mt-8 flex gap-4">
            @csrf
            @foreach($inputs as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <button type="submit" name="back" class="w-1/2 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50 transition text-center">
                修正する
            </button>
            <x-primary-button class="w-1/2 justify-center">
                送信する
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>