@props([
    'options' => [],
])

<select {{ $attributes->merge([
    'class' => 'w-full rounded-md shadow-xs border-neutral-300 cursor-pointer focus:border-neutral-300 focus:ring-neutral-300 sm:text-sm'
]) }}>
@foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
