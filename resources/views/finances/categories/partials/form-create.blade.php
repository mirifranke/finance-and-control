<form method="POST" action="/finances/categories">
    @csrf
    
    <div class="flex">
        <div class="grow grid grid-cols-3 gap-4">
            <div>
                <x-label for="title" class="">Title</x-label>
                <x-input
                         id="title"
                         name="title"
                         type="text"
                         @keyup.enter="create()"
                         @keyup.esc="cancel()" />
            </div>

            <div class="col-span-2">
                <x-label for="description">Description</x-label>
                <x-input
                         id="description"
                         name="description"
                         type="text"
                         class="w-full"
                         @keyup.enter="create()"
                         @keyup.esc="cancel()" />
            </div>

            <div class="col-span-3">
                <div class="flex justify-end space-x-2">
                    <button @click.prevent="cancel()">
                        <x-icon name="cancel" />
                    </button>
                    <button type="submit">
                        <x-icon name="check" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
