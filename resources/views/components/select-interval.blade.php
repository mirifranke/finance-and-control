@props(['currentInterval' => null])

<x-select id="interval" name="interval">
    <option value="null">select interval</option>
    @foreach ($intervals as $interval)
    <option value="{{ $interval }}" {{ $interval == $currentInterval ? 'selected ' : '' }}
        >
        {{ $interval }}
    </option>
    @endforeach
</x-select>
