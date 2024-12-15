@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-center dark:text-white text-2xl font-bold mb-4">{{ __('All Reviews') }}</h1>
    <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700 dark:text-white">
                <th class="py-2 px-4 border-b text-center">{{ __('ID') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('User') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Book') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Title') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Rating') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                <td class="py-2 px-4 border-b text-center">{{ $review->id }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $review->user->username }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $review->book->title }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $review->title }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $review->valoration }}/5</td>
                <td class="py-2 px-4 border-b text-center flex justify-center gap-2">
                    <a href="{{ route('review.details', $review->id) }}" class="inline-block bg-blue-500 text-white font-semibold pt-1 px-4 rounded hover:bg-blue-600">
                        {{ __('View Details') }}
                    </a>
                    <form method="POST" action="{{ route('reviews.delete', $review->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection