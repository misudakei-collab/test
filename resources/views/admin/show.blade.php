<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お問い合わせ詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-8">
                
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">お問い合わせ詳細</h2>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('admin.inquiries.export.single', $inquiry->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-green-700 transition">
                            📊 この内容をCSV出力
                        </a>

                        <a href="{{ route('admin.inquiries') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300 transition">
                            一覧に戻る
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">お名前（フリガナ）</p>
                        <p class="text-lg text-gray-800">
                            {{ $inquiry->name }} 
                            @if($inquiry->kana) （{{ $inquiry->kana }}） @endif
                        </p>
                    </div>
                    
                    @if($inquiry->country)
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">Country</p>
                        <p class="text-lg text-gray-800">{{ $inquiry->country }}</p>
                    </div>
                    @endif

                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">送信日時</p>
                        <p class="text-lg text-gray-800">{{ $inquiry->created_at->format('Y/m/d H:i') }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">メールアドレス</p>
                        <p class="text-lg text-gray-800">{{ $inquiry->email }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">電話番号</p>
                        <p class="text-lg text-gray-800">{{ $inquiry->tel ?? '未設定' }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">性別 / 年齢</p>
                        <p class="text-lg text-gray-800">
                            {{ $inquiry->gender ?? '未設定' }} / {{ $age }}
                        </p>
                    </div>
                </div>

                <div class="mt-10 p-6 bg-gray-50 rounded-xl border border-gray-200">
                    <p class="text-xs text-gray-400 uppercase font-bold mb-3">お問い合わせ内容</p>
                    <p class="text-gray-800 whitespace-pre-wrap leading-relaxed text-base">
                        {{ $inquiry->content }}
                    </p>
                </div>

                <div class="mt-10 pt-6 border-t flex justify-end">
                    <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('このお問い合わせを完全に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-white hover:bg-red-500 border border-red-500 px-4 py-2 rounded-lg transition-all text-sm font-bold">
                            このデータを削除する
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>