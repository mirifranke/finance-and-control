@props(['heading'])

<section class="py-2 mx-auto">
    <div class="flex justify-between border-b mb-8">
        <h1 class="text-gray-800 uppercase text-lg font-bold pb-2">
            {{ $heading }}
        </h1>

        <div>
            {{ $options ?? '' }}
        </div>
    </div>

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
