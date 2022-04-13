@props(['heading'])

<section class="md:py-2 mx-auto">
    <div class="flex-row md:flex">
        <div class="w-48 flex-shrink-0 md:border-r">
            <ul>
                {{ $links ?? '' }}
            </ul>
        </div>

        <div class="w-full">
            <div class="flex flex-col md:flex-row items-center justify-between border-b md:mb-3 mx-6">
                <h1 class="text-gray-800 uppercase text-lg font-bold pb-1">
                    {{ $heading }}
                </h1>

                <div>
                    {{ $options ?? '' }}
                </div>
            </div>

            <div class="flex-1 px-1 md:px-6">
                {{ $slot }}
            </div>
        </div>

    </div>
</section>
