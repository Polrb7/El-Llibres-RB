@php
$year = date("Y");
@endphp

<footer class="bg-white dark:bg-gray-800 text-gray-500 border-gray-100 dark:border-gray-700 h-20 py-4">
    <div class="container mx-auto font-semibold text-center pt-4">
        <p>&copy; {{ $year }} El Llibres. <span>{{ __('All Rights Reserved') }}</span></p>
    </div>
</footer>