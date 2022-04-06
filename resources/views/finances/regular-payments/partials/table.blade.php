<table class="min-w-fit">
    <tr class="border-b">
        <x-column header>Titel</x-column>
        <x-column header>Betrag</x-column>
        <x-column header>Kategorie</x-column>
        <x-column header>Intervall</x-column>
        <x-column header>Stardatum</x-column>
        <x-column header>Enddatum</x-column>
    </tr>
    @foreach ($payments as $payment)
        <x-row deleteAction="{{ route('payment.destroy', ['id' => $payment->id]) }}">
            <x-column class="relative" x-data="formUpdateRegularPayment()">
                <div @click="showForm()" class="hover:text-blue-600 hover:font-semibold">
                    {{ $payment->title }}
                </div>

                <div x-show="show" class="max-w-fit w-screen">
                    <livewire:update-regular-payment :payment="$payment" />
                </div>
            </x-column>
            <x-column>{{ $payment->getAmountForUser() }}</x-column>
            <x-column>{{ $payment->category->title }}</x-column>
            <x-column>{{ $payment->interval }}</x-column>
            <x-column>{{ $payment->getStartsAtForUser() }}</x-column>
            <x-column>{{ $payment->getEndsAtForUser() }}</x-column>
        </x-row>
    @endforeach
</table>

<script>
    function formUpdateRegularPayment() {
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
