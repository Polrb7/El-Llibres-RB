@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">{{ __('Add Comment') }}</h1>

    <!-- Mostrar la ressenya -->
    <div class="bg-white mb-6 p-4 border border-gray-300 rounded-md">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $review->title }}</h3>
        <p class="text-md text-gray-600 dark:text-gray-400 mt-1">{{ __('By') }}: <span class="font-medium">{{ $review->user->name }} {{ $review->user->surname }}</span></p>
        <p class="text-md text-gray-600 dark:text-gray-400 mt-1">{{ __('Valoration') }}: {{ $review->valoration }}/5</p>
        <p class="text-md text-gray-800 dark:text-gray-200 mt-2">{{ $review->text }}</p>
    </div>

    <form action="{{ route('comment.store', $review->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700">{{ __('Comment') }}</label>
            <x-textarea
                name="comment"
                id="comment"
                rows="4"
                placeholder="{{__('Write your comment here')}}"
                class=" bg-gray-50 border-gray-300"></x-textarea>
            @error('comment')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
            {{ __('Submit Comment') }}
        </button>
    </form>
</div>
@endsection