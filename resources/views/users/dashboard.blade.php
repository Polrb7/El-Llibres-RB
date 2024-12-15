@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Filtres -->
    <form method="GET" action="{{ route('view.allbooks') }}" class="mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 justify-items-center">
            <!-- Filtre per títol o autor -->
            <div class="w-full max-w-xs">
                <label for="title_or_author" class="block text-sm font-medium text-gray-700">{{ __('Title or Author') }}</label>
                <input type="text" name="title_or_author" id="title_or_author" value="{{ request('title_or_author') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-white dark:bg-gray-800 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Filtre per gènere -->
            <div class="w-full max-w-xs">
                <label for="genre" class="block text-sm font-medium text-gray-700">{{ __('Genre') }}</label>
                <select name="genre" id="genre"
                    class="mt-1 block w-full border-gray-300 dark:text-white rounded-md shadow-sm bg-white dark:bg-gray-800 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">{{ __('All Genres') }}</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre }}" @if(request('genre')===$genre) selected @endif>{{ $genre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botó de cerca -->
            <div class="w-full max-w-xs flex items-end justify-center">
                <button type="submit"
                    class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
                    {{ __('Filter') }}
                </button>
            </div>
        </div>
    </form>

    <h1 class="text-2xl font-bold dark:text-white text-center mb-6">{{ __('All Books') }}</h1>

    @if($books->isEmpty())
    <p class="text-center text-gray-600">{{ __('No books found.') }}</p>
    @else
    <!-- Graella responsiva -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($books as $book)
        <!-- Targeta individual -->
        <div class="bg-white shadow-lg rounded-lg bg-white dark:bg-gray-800 overflow-hidden text-center">
            <!-- Imatge del llibre amb mida fixa -->
            <img src="{{ asset('storage/' . $book->book_img) }}" alt="{{ $book->title }}"
                class="w-44 h-44 object-cover block mx-auto" />
            <div class="p-4">
                <!-- Detalls del llibre -->
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white truncate">{{ $book->title }}</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Author') }}: <span
                        class="font-medium">{{ $book->author }}</span></p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Genre') }}: <span
                        class="font-medium">{{ $book->genre }}</span></p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ __('Added by') }}: <a href="user.details"> <span
                            class="font-medium">{{ $book->user->name }} {{ $book->user->surname }}</span></a></p>
            </div>
            <div class="text-center mt-4 mb-4">
                <a href="{{ route('view.book', $book->id) }}"
                    class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
                    {{ __('View More') }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
<x-footer />
@endsection