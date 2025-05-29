<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Short URL Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <strong>ID:</strong> {{ $shortUrl->id }}
                </div>

                <div class="mb-4">
                    <strong>User:</strong> {{ $shortUrl->user->name }}
                </div>
                <div class="mb-4">
                    <strong>Original URL:</strong> {{ $shortUrl->original_url }}
                </div>
                <div class="mb-4">
                    <strong>Short Code:</strong> {{ $shortUrl->short_code }}
                </div>
                <div class="mb-4">
                    <strong>Total Clicks:</strong> {{ $shortUrl->clicks }}
                </div>
                <a href="{{ route('short-urls.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
