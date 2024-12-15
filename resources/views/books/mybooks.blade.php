@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold dark:text-white text-center mb-6">{{ __('My Books') }}</h1>
    @if($books->isEmpty())
    <p class="text-center text-gray-600">{{ __('You have no books.') }}</p>
    @else
    <!-- Graella responsiva -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($books as $book)
        <!-- Targeta individual -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <!-- Imatge del llibre amb mida fixa -->
            <img
                src="{{ asset('storage/' . $book->book_img) }}"
                alt="{{ $book->title }}"
                class="w-44 h-44 object-cover block mx-auto" />
            <div class="text-center p-2">
                <!-- Detalls del llibre -->
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white text-gray-800 truncate">{{ $book->title }}</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Author') }}: <span class="font-medium">{{ $book->author }}</span></p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Genre') }}: <span class="font-medium">{{ $book->genre }}</span></p>
            </div>
            <!-- Botó d'eliminació -->
            <div class="p-4 text-center">
                <div class="text-center mb-4">
                    <a href="{{ route('view.book', $book->id) }}" class="inline-block bg-blue-500 text-white mr-2 font-semibold py-2 px-4 rounded hover:bg-blue-600">
                        {{ __('Details') }}
                    </a>
                    <a href="{{ route('edit.book', $book->id) }}" class="inline-block bg-yellow-500 text-white ml-2 font-semibold py-2 px-4 rounded hover:bg-yellow-600">
                        {{ __('Modify') }}
                    </a>
                </div>
                <form action="{{ route('delete.book', $book->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this book?') }}');">
                    @csrf
                    @method('DELETE')
                    <button
                        type=" submit"
                        class="font-semibold bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors">
                        {{ __('Delete') }}
                    </button>
                </form>

            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection