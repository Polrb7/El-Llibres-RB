@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl dark:text-white font-bold mb-4">{{ $review->title }}</h1>
    <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $review->text }}</p>
    <p class="text-lg dark:text-white font-semibold mb-2">{{ __('Valoration') }}: <span class="text-yellow-500">{{ $review->valoration }}</span></p>
    <p class="text-sm text-gray-500">{{ __('Written By') }}: {{ $review->user->name }} {{ $review->user->surname }}</p>

    <h2 class="text-2xl dark:text-white font-semibold mt-6 mb-4">{{ __('Comments') }}</h2>
    @foreach($review->comments as $comment)
    <div class="bg-gray-200 dark:bg-gray-600 rounded-lg border-b border-gray-300 dark:border-gray-500 pb-4 mb-4 p-5">
        <strong class="text-lg">{{ $comment->user->name }} {{ $comment->user->surname }}</strong>
        <p class="text-md text-gray-600 dark:text-gray-200">{{ $comment->comment }}</p>
        <p class="text-sm mt-2 text-gray-400">{{ $comment->created_at }}</p>
    </div>
    @endforeach

</div>
@endsection