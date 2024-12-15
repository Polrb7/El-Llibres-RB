<!-- resources/views/admin/viewUsers.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-center dark:text-white text-2xl font-bold mb-4">{{ __('All Users')}}</h1>
    <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700 dark:text-white">
                <th class="py-2 px-4 border-b text-center">{{ __('ID') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Name') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Surname') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Username') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Age') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Email') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Is Admin?') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Profile Image') }}</th>
                <th class="py-2 px-4 border-b text-center">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                <td class="py-2 px-4 border-b text-center">{{ $user->id }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $user->name }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $user->surname }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $user->username }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $user->age }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $user->email }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $user->admin ? __('Yes') : __('No') }}</td>
                <td class="py-2 px-4 border-b text-center">
                    @if($user->profile_img)
                    <img src="{{ asset('storage/' . $user->profile_img) }}" alt="Imatge de perfil" class="w-12 h-12 rounded-full">
                    @else
                    {{ __('No Image Available') }}
                    @endif
                </td>
                <td class="flex justify-center py-2 px-4 mt-3 border-b text-center">
                    <form method="POST" action="{{ route('users.toggleAdmin', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="text-white px-2 py-1 rounded">
                            @if($user->admin)
                            <p class="bg-yellow-500 hover:bg-yellow-600 h-8 w-auto px-2 pt-1 rounded ">{{ __('Revoke Admin') }}</p>
                            @else
                            <p class="bg-green-500 hover:bg-green-600 h-8 w-auto px-2 pt-1 rounded ">{{ __('Make Admin') }}</p>
                            @endif
                        </button>
                    </form>
                    <form method="POST" action="{{ route('users.delete', $user->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white mt-1 px-2 py-1 rounded">
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