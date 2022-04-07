@props(['deleteAction'])

<tr x-data="{ hover: false }"
    @mouseover="hover = true"
    @mouseleave="hover = false"
    class="hover:bg-gray-100">
    {{ $slot }}

    <x-column>
        <form method="POST" action="{{ $deleteAction }}">
            @csrf
            @method('DELETE')
            
            <button x-show="hover" type="submit">
                <x-icon name="trash" />
            </button>
        </form>
    </x-column>
</tr>
