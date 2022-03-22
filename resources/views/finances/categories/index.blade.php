<x-main-finance heading="Categories">
    <div class="pb-3">
        <table class="min-w-fit">
            <tr class="border-b">
                <x-column header>Title</x-column>
                <x-column header>Description</x-column>
            </tr>
            <x-column-row>
                <x-column>Mobility</x-column>
                <x-column>Car/ Bus/...</x-column>
            </x-column-row>
            <x-column-row>
                <x-column>Living</x-column>
                <x-column>Home...</x-column>
            </x-column-row>
            <x-column-row>
                <x-column>Sport</x-column>
                <x-column>Karate, ...</x-column>
            </x-column-row>
            <x-column-row>
                <x-column>Others</x-column>
                <x-column>...</x-column>
            </x-column-row>
        </table>
    </div>

    <div x-data="formCreateCategory()">
        <button x-show="! show" @click="showForm()" class="px-6">
            <x-icon name="add" />
        </button>

        <div x-show="show" class="max-w-fit px-6 pt-3 border-t">
            <form method="POST" action="" @submit.prevent="createCategory()">
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
                                <button @click.prevent="create()">
                                    <x-icon name="check" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function formCreateCategory() {
            return {
                show: false,

                showForm() {
                    this.show = true;
                    // TODO: set focus on title
                },

                hideForm() {
                    this.show = false;
                },

                create() {

                    console.log('create');
                },

                cancel() {
                    document.getElementById('title').value = '';
                    document.getElementById('description').value = '';
                    this.hideForm();
                }
            }
        }
    </script>
</x-main-finance>
