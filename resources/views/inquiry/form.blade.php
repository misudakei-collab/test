<x-guest-layout>
    <x-slot name="title">
        お問い合わせフォーム
    </x-slot>

    <div class="max-w-lg mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">お問い合わせ</h2>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.confirm') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <div class="flex items-center">
                    <x-input-label for="name" value="お名前" />
                    <span class="ml-2 text-xs text-red-500 font-bold">必須</span>
                </div>
                <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name')" required placeholder="例：山田 太郎" /> 
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center">
                    <x-input-label for="kana" value="フリガナ" />
                    <span class="ml-2 text-xs text-red-500 font-bold">必須</span>
                </div>
                <x-text-input id="kana" name="kana" type="text" class="block mt-1 w-full" :value="old('kana')" required placeholder="例：ヤマダ タロウ" /> 
                <x-input-error :messages="$errors->get('kana')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center">
                    <x-input-label for="email" value="メールアドレス" />
                    <span class="ml-2 text-xs text-red-500 font-bold">必須</span>
                </div>
                <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="old('email')" required placeholder="例：example@mail.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="tel" value="電話番号" />
                <x-text-input id="tel" name="tel" type="tel" class="block mt-1 w-full" :value="old('tel')"placeholder="例：09012345678" />
            </div>

            <div>
                <x-input-label for="gender" value="性別" />
                <select name="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="男性">男性</option>
                    <option value="女性">女性</option>
                    <option value="その他">その他</option>
                </select>
            </div>

            <div>
                <x-input-label for="birthdate" value="生年月日" />
                <x-text-input id="birthdate" name="birthdate" type="date" class="block mt-1 w-full" />
            </div>

            <div>
                <div class="flex items-center">
                    <x-input-label for="title" value="件名" />
                    <span class="ml-2 text-xs text-red-500 font-bold">必須</span>
                </div>
                <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" :value="old('title')" required placeholder="例：サービス内容について" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center">
                    <x-input-label for="content" value="お問い合わせ内容" />
                    <span class="ml-2 text-xs text-red-500 font-bold">必須</span>
                </div>
                <textarea name="content" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="例：サービスの利用方法について教えてください。">{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="terms" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" required>
                    <span class="ml-2 text-sm text-gray-600">
                        <a href="/terms" target="_blank" class="text-indigo-600 underline">利用規約</a>に同意します
                    </span>
                    <span class="ml-2 text-xs text-red-500 font-bold">必須</span>
                </label>
                <x-input-error :messages="$errors->get('terms')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-8 border-t pt-6">
                <a href="{{ route('contact.selection') }}" class="text-sm text-gray-600 hover:text-gray-900 underline transition">
                    &laquo; 言語選択へ戻る
                </a>

                <x-primary-button>
                    送信する
                </x-primary-button>
            </div>

        </form>
    </div>
</x-guest-layout>