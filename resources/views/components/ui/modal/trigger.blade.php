@props([
    'id' => null
])
<div x-data>
    <span
        x-on:click="$modal.open(@js($id))"
        {{ $attributes->merge(["modal-trigger [:where(&)]:inline cursor-pointer"]) }}
    >
        {{ $slot }}
</span>
</div>
