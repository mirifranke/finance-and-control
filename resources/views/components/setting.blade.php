@props(['heading'])

<section class="md:py-2 mx-auto">
    <div class="hidden md:flex justify-between border-b md:mb-8">
        <h1 class="text-gray-800 uppercase text-lg font-bold pb-2">
            {{ $heading }}
        </h1>

        <div>
            {{ $options ?? '' }}
        </div>
    </div>

    <div class="flex-row md:flex">
        <div class="w-48 flex-shrink-0 md:border-r">
            <ul>
                {{ $links ?? '' }}
            </ul>
        </div>

        <div class="flex-1 px-1 md:px-6">
            {{ $slot }}
        </div>
    </div>
</section>
