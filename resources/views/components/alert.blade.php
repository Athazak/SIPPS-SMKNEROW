@props(['type' => 'success'])

@php
    $baseClasses = "max-w-7xl mx-auto mt-2 mb-2 px-4 py-2 rounded relative shadow";
    $colors = [
        'success' => 'bg-green-100 border border-green-400 text-green-700',
        'error' => 'bg-red-100 border border-red-400 text-red-700',
        'warning' => 'bg-yellow-100 border border-yellow-400 text-yellow-700',
        'info' => 'bg-blue-100 border border-blue-400 text-blue-700',
    ];
    $classes = $baseClasses . ' ' . ($colors[$type] ?? $colors['info']);
@endphp

<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="{{ $classes }}">
    <span class="block sm:inline">{{ $slot }}</span>
</div>