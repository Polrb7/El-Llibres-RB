@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $book->title }}</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Added by') }}: <span class="font-medium">{{ $book->user->name }} {{ $book->user->surname }}</span></p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('review.store', $book->id) }}">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 dark:text-gray-300">{{ __('Review Title') }}</label>
                    <input type="text" id="title" name="title" class="w-full mt-2 p-2 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 border rounded" value="{{ old('title') }}" required>
                </div>
                <div class="mb-4">
                    <label for="text" class="block text-gray-700 dark:text-gray-300">{{ __('Your Review') }}</label>
                    <textarea id="text" name="text" class="w-full mt-2 p-2 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 border rounded" rows="4" required>{{ old('text') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="valoration" class="block text-gray-700 dark:text-gray-300">{{ __('Valoration (1-5)') }}</label>
                    <input type="number" id="valoration" name="valoration" class="w-full mt-2 p-2 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 border rounded" min="1" max="5" value="{{ old('valoration') }}" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
                        {{ __('Submit Review') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection