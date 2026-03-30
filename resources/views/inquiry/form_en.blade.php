<x-guest-layout>
    <div class="max-w-lg mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Inquiry Form</h2>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.confirm.en') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <div class="flex items-center">
                    <x-input-label for="name" value="Full Name" />
                    <span class="ml-2 text-xs text-red-500 font-bold">Required</span>
                </div>
                <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name')" required placeholder="e.g. John Doe" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center">
                    <x-input-label for="email" value="Email Address" />
                    <span class="ml-2 text-xs text-red-500 font-bold">Required</span>
                </div>
                <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="old('email')" required placeholder="e.g. john@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center">
                    <x-input-label for="gender" value="Gender" />
                    <span class="ml-2 text-xs text-gray-500 font-bold">(Optional)</span>
                </div>
                <select name="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="" {{ old('gender') == '' ? 'selected' : '' }}>Select your gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center">
                    <x-input-label for="country" value="Country" />
                    <span class="ml-2 text-xs text-red-500 font-bold">Required</span>
                </div>
                <x-text-input id="country" name="country" type="text" class="block mt-1 w-full" :value="old('country')" required placeholder="e.g. USA" />
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="birthdate" value="Date of Birth" />
                <x-text-input id="birthdate" name="birthdate" type="date" class="block mt-1 w-full" :value="old('birthdate')" />
                <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="tel" value="Phone Number" />
                <x-text-input id="tel" name="tel" type="tel" class="block mt-1 w-full" :value="old('tel')" placeholder="e.g. +123456789" />
                <x-input-error :messages="$errors->get('tel')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center">
                    <x-input-label for="title" value="Subject" />
                    <span class="ml-2 text-xs text-red-500 font-bold">Required</span>
                </div>
                <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" :value="old('title')" required placeholder="e.g. About your service" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center">
                    <x-input-label for="content" value="Message" />
                    <span class="ml-2 text-xs text-red-500 font-bold">Required</span>
                </div>
                <textarea name="content" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Please type your inquiry here.">{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="terms" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" required>
                    <span class="ml-2 text-sm text-gray-600">
                        I agree to the <a href="/terms/en" target="_blank" class="text-indigo-600 underline">Terms of Service</a>
                    </span>
                    <span class="ml-2 text-xs text-red-500 font-bold">Required</span>
                </label>
                <x-input-error :messages="$errors->get('terms')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-8 border-t pt-6">
                <a href="{{ route('contact.selection') }}" class="text-sm text-gray-600 hover:text-gray-900 underline transition">
                    &laquo; Back to language selection
                </a>

                <x-primary-button>
                    Send Message
                </x-primary-button>
            </div>

        </form>
    </div>
</x-guest-layout>