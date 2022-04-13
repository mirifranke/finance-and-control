@props(['message'])

<div x-data="{ showDeleteModal:false }"
     x-bind:class="{ 'model-open': showDeleteModal }"
     style="font-family:Roboto">
    <div class="flex justify-center items-center h-screen">
        <div @click="showDeleteModal = true">
            {{ $trigger }}
        </div>
    </div>

    <div x-show="showDeleteModal"
        tabindex="0"
        class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">

        <div @click.away="showDeleteModal = false"
            class="z-50 relative p-3 mx-auto my-0 max-w-full"
            style="width: 500px;">
            <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden px-10 py-10">
                <div class="text-center font-light text-gray-700 mb-8">
                    {{ $message }}
                </div>
                <div class="flex justify-center">
                    <div @click={showDeleteModal=false}>
                        {{ $cancel }}
                    </div>
                    <div>
                        {{ $delete }}
                    </div>
                </div>
            </div>
        </div>
        <div class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black opacity-50"></div>
    </div>
    </body>
