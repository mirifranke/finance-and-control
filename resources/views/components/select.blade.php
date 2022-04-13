 @props(['disabled' => false])

<select {!! $attributes->merge(['class' => 'bg-gray-100 rounded-xl border-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full']) !!}>
  {{ $slot }}
</select>
