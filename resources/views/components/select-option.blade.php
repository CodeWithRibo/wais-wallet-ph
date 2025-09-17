@props([
    'options' => [],
])

<select {{ $attributes->merge([
    'class' => 'rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'
]) }}>
    <option disabled selected>Select Category</option>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
