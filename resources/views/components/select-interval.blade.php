@props(['currentInterval' => null])

<x-select id="interval" name="interval">
    @foreach ($intervals as $interval)
    <option value="{{ $interval }}" {{ $interval == $currentInterval ? 'selected ' : '' }}
        >
        {{ $interval }}
    </option>
    @endforeach
</x-select>
