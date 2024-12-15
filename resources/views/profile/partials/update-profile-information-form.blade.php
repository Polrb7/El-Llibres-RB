<section class="flex flex-row">
    <!-- Left side: Profile form -->
    <div class="flex-grow">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <!-- Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
            </div>

            <!-- Age -->
            <div>
                <x-input-label for="age" :value="__('Age')" />
                <x-text-input id="age" name="age" type="number" class="mt-1 block w-full" :value="old('age', $user->age)" required autofocus autocomplete="age" />
                <x-input-error class="mt-2" :messages="$errors->get('age')" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div>

            <!-- Image -->
            <div>
                <x-input-label for="profile_img" :value="__('Profile Image')" />
                <x-text-input id="profile_img" name="profile_img" type="file" accept="image/jpeg,image/png,image/jpg,image/gif" class="mt-1 block w-full" :value="old('profile_img', $user->profile_img)" autofocus autocomplete="profile_img" />

                <x-input-error class="mt-2" :messages="$errors->get('profile_img')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

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

    <!-- Right side: Profile image -->
    <div class="ml-12 mt-32 flex-shrink-0 ">
        <div class="w-auto h-48 rounded-lg overflow-hidden border-4 border-gray-300 dark:border-gray-700">
            @if ($user->profile_img)
            <img src="{{ asset('storage/' . $user->profile_img) }}" alt="{{ $user->username }}" class="w-full h-full object-cover">
            @else
            <img src="{{ asset('storage/default.jpg') }}" alt="{{ __('Default Profile Image') }}" class="w-full h-full object-cover">
            @endif
        </div>
    </div>
</section>