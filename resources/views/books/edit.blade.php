@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-center mb-6">{{ __('Edit Book') }}</h1>
    <form action="{{ route('update.book', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" value="{{ $book->title }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="author" class="block text-gray-700">{{ __('Author') }}</label>
            <input type="text" name="author" id="author" value="{{ $book->author }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="genre" class="block text-gray-700">{{ __('Genre') }}</label>
            <input type="text" name="genre" id="genre" value="{{ $book->genre }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                {{ __('Update Book') }}
            </button>
        </div>
    </form>
</div>
@endsection