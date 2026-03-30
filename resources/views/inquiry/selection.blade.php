<x-guest-layout>
    <div class="max-w-md mx-auto mt-20 p-10 bg-white shadow-lg rounded-xl text-center">
        <h2 class="text-2xl font-bold mb-8 text-gray-800">Please select your language</h2>
        <p class="mb-10 text-gray-600">お問い合わせに使用する言語を選択してください。</p>

        <div class="grid gap-4">
            
            <a href="{{ url('/contact') }}" class="block w-full py-4 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition shadow-md">
                日本語 (Japanese)
            </a>

            <a href="{{ route('contact.create.en') }}" class="block w-full py-4 bg-gray-800 text-white rounded-lg font-bold hover:bg-gray-900 transition shadow-md">
                English
            </a>
        </div>
    </div>
</x-guest-layout>