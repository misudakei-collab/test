<x-guest-layout>
    <div class="max-w-lg mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Confirm your inquiry</h2>

        <div class="space-y-4 text-gray-700">
            <div><strong>Full Name:</strong> {{ $inputs['name'] }}</div>
            <div><strong>Email:</strong> {{ $inputs['email'] }}</div>
            <div><strong>Country:</strong> {{ $inputs['country'] }}</div>
            <div><strong>Subject:</strong> {{ $inputs['title'] }}</div>
            <div><strong>Message:</strong><br><p class="whitespace-pre-wrap">{{ $inputs['content'] }}</p></div>
        </div>

        <form action="{{ route('contact.store.en') }}" method="POST" class="mt-8 flex gap-4">
            @csrf
            @foreach($inputs as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <button type="submit" name="back" class="w-1/2 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                Back to Edit
            </button>
            <button type="submit" class="w-1/2 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 font-bold">
                Send Message
            </button>
        </form>
    </div>
</x-guest-layout>