<button {{ $attributes->merge(['class' => 'flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</button>
