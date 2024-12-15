@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold dark:text-white text-center mb-6">{{ __('All Books') }}</h1>

    @if($books->isEmpty())
    <p class="text-center text-gray-600">{{ __('No books found.') }}</p>
    @else
    <!-- Graella responsiva -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($books as $book)
        <!-- Targeta individual -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden text-center">
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
                    class="inline-block bg-blue-500 text-white font-semibold py-2 mb-2 px-4 rounded hover:bg-blue-600">
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