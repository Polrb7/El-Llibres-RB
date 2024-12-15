@extends('layouts.app')

@section('content')
<div class="py-12">
    <h1 class="text-2xl font-bold dark:text-white text-center mb-6">{{ __('Add a Book') }}</h1>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="post" action="{{ route('store.book') }}" enctype="multipart/form-data"="mt-6 space-y-6">
                    @csrf
                    @method('patch')
                    <div>
                        <!-- Title -->
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus />
                        <br>

                        <!-- Author -->
                        <x-input-label for="author" :value="__('Author')" />
                        <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" required autofocus />
                        <br>

                        <!-- Genre -->
                        <x-input-label for="genre" :value="__('Genre')" />
                        <x-text-input id="genre" name="genre" type="text" class="mt-1 block w-full" required autofocus />
                        <br>

                        <!-- Description -->
                        <x-input-label for="description" :value="__('Description')" />
                        <x-textarea
                            name="description"
                            id="description"
                            rows="6"
                            placeholder="{{__('Write a short description of the book here')}}"
                            class=" bg-gray-50"></x-textarea>

                        <br>

                        <!-- Image -->
                        <x-text-input id="book_img" name="book_img" type="file" class="mt-1 block w-full" autofocus autocomplete="book_img" />
                        <x-input-error class="mt-2" :messages="$errors->get('book_img')" />
                        <br>
                    </div>
                    <div class="flex items-center gap-4">
                        <x-primary-button class="">{{ __('Save') }}</x-primary-button>

                        @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection