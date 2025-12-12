@props([
    'title' => '',
    'show' => 'openModal',
])

<div 
    x-show="{{ $show }}"
    x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-3"
    style="display: none;"
    x-cloak
>
    <div
        x-show="{{ $show }}"
        x-transition.scale
        class="bg-white rounded-xl shadow-lg
            w-full max-w-md        {{-- batas maksimal modal --}}
            mx-auto               {{-- biar tetap center di mobile --}}
            px-4 py-4 relative"
    >

        {{-- Header --}}
        <h3 class="text-lg font-semibold mb-4">{{ $title }}</h3>

        {{-- Isi modal --}}
        {{ $slot }}

        {{-- Tombol close --}}
        <button 
            @click="{{ $show }} = false"
            class="absolute top-3 right-3 text-red-400 hover:text-red-600 text-lg font-semibold">
            ✕
        </button>
    </div>
</div>
