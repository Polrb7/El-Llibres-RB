@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Informació del llibre -->
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <h1 class="text-center text-2xl font-bold text-gray-800 dark:text-gray-100 py-4">{{ $book->title }}</h1>
        <img src="{{ asset('storage/' . $book->book_img) }}" alt="{{ $book->title }}" class="w-full h-full  -cover">
        <div class="p-6">
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 font-bold">{{ __('Author') }}: <span class="font-medium">{{ $book->author }}</span></p>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 font-bold">{{ __('Genre') }}: <span class="font-medium">{{ $book->genre }}</span></p>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-4 font-bold">{{ __('Description') }}:</p>
            <p class="text-sm text-gray-800 dark:text-gray-200 mt-2">{{ $book->description }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-4 font-bold">{{ __('Added by') }}: <a href="user.details"><span class="font-medium">{{ $book->user->name }} {{ $book->user->surname }}</span></a></p>
        </div>
        <div class="text-center mt-4 mb-4">
            <a href="{{ route('review.create', $book->id) }}" class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
                {{ __('Add Review') }}
            </a>
        </div>
    </div>

    <!-- Ressenyes -->
    <div class="mt-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">{{ __('Reviews') }}</h2>
        @if($book->reviews->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">{{ __('No reviews yet') }}</p>
        @else
        <div class="space-y-4">
            @foreach($book->reviews as $review)
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">

                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $review->title }}</h3>
                <p class="text-md text-gray-600 dark:text-gray-400 mt-1">{{ __('By') }}: <a href="user.details"><span class="font-medium">{{ $review->user->name }} {{ $review->user->surname }}</span></a></p>
                <p class="text-md text-gray-600 dark:text-gray-400 mt-1">{{ __('Valoration') }}: {{ $review->valoration }}/5</p>
                <p class="text-md text-gray-800 dark:text-gray-200 mt-2">{{ $review->text }}</p>
                <p class="text-sm text-gray-400 mt-2">{{ $review->created_at }}</p>
                <div class="flex gap-4">
                    <div>
                        <a href="{{ route('comment.create', $review->id) }}" class="inline-block bg-blue-500 text-white font-semibold mt-2 py-2 px-4 rounded hover:bg-blue-600">
                            {{ __('Reply') }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('review.details', $review->id) }}" class="inline-block bg-blue-500 text-white font-semibold mt-2 py-2 px-4 rounded hover:bg-blue-600">
                            {{ __('View Comments') }}
                        </a>
                    </div>
                    @if($review->user->id == Auth::id())
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Estàs segur que vols eliminar aquesta ressenya?');">
                        @csrf
                        @method('DELETE')
                        <button class="inline-block bg-red-500 text-white font-semibold mt-2 py-2 px-4 rounded hover:bg-red-600" type="submit">{{ __('Delete Review') }}</button>
                    </form>
                    @endif
                </div>
            </div>
            <br>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection