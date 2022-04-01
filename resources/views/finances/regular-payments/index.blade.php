<x-main-finance heading="Regular Payments">
    <x-slot name="options">
        @include('finances.regular-payments.partials.options')
    </x-slot>

    <div class="relative" x-data="formCreateRegularPayment()">
        <button x-show="! show" @click="showForm()" class="">
            <x-icon name="add" />
        </button>

        <div x-show="show" class="max-w-fit px-6 pt-3">
            {{-- @include('finances.regular-payments.partials.form-create') --}}
            <livewire:create-regular-payment />
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900">
        @include('finances.regular-payments.partials.table')
    </div>

    <div class="py-3 px-6">
        <div class="font-semibold items-center">
            Monthly Regular Payments: 3.6782 €
        </div>
    </div>

    <script>
        function formCreateRegularPayment() {
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
