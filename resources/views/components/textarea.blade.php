<textarea
    name="{{ $name }}"
    id="{{ $id }}"
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'w-full px-3 py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border rounded-md focus:outline-none focus:ring focus:ring-blue-100']) }}>{{ $slot }}</textarea>