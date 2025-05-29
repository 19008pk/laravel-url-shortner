<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Short URL') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('short-urls.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="original_url"
                            class="block text-gray-700 dark:text-gray-300">{{ __('Original URL') }}</label>
                        <input type="url" name="original_url" value="{{ old('original_url') }}" required
                            id="original_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="URL">
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
