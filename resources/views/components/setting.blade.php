
@props(['heading'])

<section class="py-2 mx-auto">
    <h1 class="text-gray-800 uppercase text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
        <div class="w-48 flex-shrink-0 border-r">
            <ul>
                {{ $links ?? '' }}
            </ul>
        </div>

        <div class="flex-1 px-6">
            {{ $slot }}
        </div>
    </div>
</section>
