@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-center dark:text-white text-2xl font-bold mb-4">{{ __('All Books') }}</h1>
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700 dark:text-white">
                <th class="py-2 px-4 border-b text-center">{{ __('ID') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Title') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Author') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Added by') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                <td class="py-2 px-4 border-b text-center">{{ $book->id }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $book->title }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $book->author }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $book->user->name . " " . $book->user->surname ?? __('Unknown') }}</td>
                <td class="py-2 px-4 border-b text-center">
                    <a href="{{ route('view.book', $book->id) }}"
                        class="inline-block bg-blue-500 text-white font-semibold py-1 mb-2 px-4 rounded hover:bg-blue-600">
                        {{ __('View More') }}
                    </a>
                    <form method="POST" action="{{ route('books.delete', $book->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 font-semibold text-white px-2 py-1 rounded hover:bg-red-600">
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