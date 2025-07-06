<a {{ $attributes->merge([
    'class' => 'inline-block px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-emerald-700 rounded-lg hover:bg-teal-600 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50'
]) }}>
    {{ $slot }}
</a>
