<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-700">クイックメニュー</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('admin.inquiries') }}" class="p-4 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition shadow-sm text-center">
                        <div class="text-indigo-600 font-bold">お問い合わせ一覧</div>
                        <div class="text-xs text-gray-500 mt-1">管理用パネルを開きます</div>
                    </a>

                    <a href="{{ route('contact.index') }}" class="p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition shadow-sm text-center">
                        <div class="text-green-600 font-bold">お問い合わせフォーム (JP)</div>
                        <div class="text-xs text-gray-500 mt-1">日本語版の入力画面へ</div>
                    </a>

                    <a href="{{ route('contact.create.en') }}" class="p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition shadow-sm text-center">
                        <div class="text-blue-600 font-bold">Inquiry Form (EN)</div>
                        <div class="text-xs text-gray-500 mt-1">Go to English Form</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>