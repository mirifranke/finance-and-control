<table class="min-w-fit">
    <tr class="border-b">
        <x-column header>Titel</x-column>
        <x-column header>Betrag</x-column>
        <x-column header>Kategorie</x-column>
        <x-column header>Datum</x-column>
    </tr>
    @foreach ($payments as $payment)
    <x-row deleteAction="{{ route('payments.destroy', ['id' => $payment->id]) }}">
        <x-column class="relative" x-data="formUpdateOneOffPayment()">
            <div @click="showForm()" class="hover:text-blue-600 hover:font-semibold">
                {{ $payment->title }}
            </div>

            <div x-show="show" class="max-w-fit">
                <livewire:update-one-off-payment :payment="$payment" />
            </div>
        </x-column>
        <x-column>{{ $payment->getAmountForUser() }}</x-column>
        <x-column>{{ $payment->category->title }}</x-column>
        <x-column>{{ $payment->getStartsAtForUser() }}</x-column>
    </x-row>
    @endforeach
</table>

<script>
    function formUpdateOneOffPayment() {
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
