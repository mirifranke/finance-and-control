<tr x-data="{ hover: false }"
    @mouseover="hover = true"
    @mouseleave="hover = false"
    class="hover:bg-gray-100">
    {{ $slot }}

    <template x-if="hover">
        <x-column>
            <x-icon name="trash" />
        </x-column>
    </template>
</tr>
