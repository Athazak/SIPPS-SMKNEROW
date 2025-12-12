@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row justify-between items-center mt-5 mb-2 space-y-3 sm:space-y-0">

        {{-- Text informasi halaman --}}
        <div class="text-sm text-gray-600 text-center sm:text-left">
            Menampilkan
            <span class="font-semibold">{{ $paginator->firstItem() }}</span>
            –
            <span class="font-semibold">{{ $paginator->lastItem() }}</span>
            dari
            <span class="font-semibold">{{ $paginator->total() }}</span>
            kelas
        </div>

        {{-- Pagination --}}
        <nav class="flex justify-center w-full sm:w-auto">

            {{-- ========== MOBILE VERSION (COMPACT SLIDING) ========== --}}
            <ul class="flex items-center gap-1 text-sm sm:hidden">

                {{-- Prev --}}
                @if ($paginator->onFirstPage())
                    <li><span class="px-3 py-1.5 bg-gray-200 text-gray-400 rounded-lg cursor-not-allowed">‹</span></li>
                @else
                    <li><a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg border bg-white">‹</a></li>
                @endif

                @php
                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();

                    // Window dinamis 3 angka (current - 1, current, current + 1)
                    $start = max(1, $current - 1);
                    $end = min($last, $current + 0);
                @endphp

                {{-- Jika window tidak mencakup halaman 1 --}}
                @if ($start > 2)
                    <li>
                        <a href="{{ $paginator->url(1) }}" class="px-3 py-1.5 rounded-lg border bg-white hover:bg-gray-50">1</a>
                    </li>

                    @if ($start > 2)
                        <li><span class="px-2 text-gray-400">…</span></li>
                    @endif
                @endif

                {{-- Halaman dinamis --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <li>
                            <span class="px-3 py-1.5 rounded-lg bg-[#512AD5]/70 text-white">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->url($page) }}" class="px-3 py-1.5 rounded-lg border bg-white hover:bg-gray-50">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endfor

                {{-- Jika window tidak mencakup halaman terakhir --}}
                @if ($end < $last)
                    @if ($end < $last - 1)
                        <li><span class="px-2 text-gray-400">…</span></li>
                    @endif

                    <li>
                        <a href="{{ $paginator->url($last) }}" class="px-3 py-1.5 rounded-lg border bg-white hover:bg-gray-50">
                            {{ $last }}
                        </a>
                    </li>
                @endif

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg border bg-white">›</a></li>
                @else
                    <li><span class="px-3 py-1.5 bg-gray-200 text-gray-400 rounded-lg cursor-not-allowed">›</span></li>
                @endif

            </ul>


            {{-- ========== DESKTOP VERSION (FULL) ========== --}}
            <ul class="hidden sm:flex items-center gap-1 text-sm">

                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <li><span class="px-3 py-1.5 bg-gray-200 text-gray-400 rounded-xl cursor-not-allowed">‹</span></li>
                @else
                    <li><a href="{{ $paginator->previousPageUrl() }}"
                            class="px-3 py-1.5 bg-white border rounded-xl hover:bg-gray-50">‹</a></li>
                @endif

                {{-- Numbers --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li><span class="px-3 py-1.5 text-gray-400">…</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li><span class="px-3 py-1.5 bg-[#512AD5]/70 text-white rounded-xl">{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}" class="px-3 py-1.5 bg-white border rounded-xl hover:bg-gray-50">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}"
                            class="px-3 py-1.5 bg-white border rounded-xl hover:bg-gray-50">›</a></li>
                @else
                    <li><span class="px-3 py-1.5 bg-gray-100 text-gray-300 rounded-xl cursor-not-allowed">›</span></li>
                @endif

            </ul>
        </nav>
    </div>
@endif