<x-main-finance heading="Categories">
    <div class="pb-3">
        @include('finances.categories.partials.table')
    </div>

    <div x-data="formCreateCategory()">
        <button x-show="! show" @click="showForm()" class="px-6">
            <x-icon name="add" />
        </button>

        <div x-show="show" class="max-w-fit px-6 pt-3 border-t">
            @include('finances.categories.partials.form-create')
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
