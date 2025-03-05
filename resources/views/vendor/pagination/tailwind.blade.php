<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="custom-pagination">
        <!-- Informasi "Showing X to Y of Z results" -->
    <div class="text-sm text-dark fw-bold">
        {!! __('Showing') !!}
        @if ($paginator->firstItem())
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
            {{ $paginator->count() }}
        @endif
        {!! __('of') !!}
        <span class="font-medium">{{ $paginator->total() }}</span>
        {!! __('results') !!}
    </div>

    <!-- Tombol Pagination -->
    <div>
        <span class="relative z-0 inline-flex rtl:flex-row-reverse rounded-md">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 cursor-default rounded-l-md leading-5" aria-hidden="true">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-600 rounded-l-md leading-5 hover:text-gray-800 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @php
                $firstPage = 1;
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
                $start = max($currentPage - 3, 1);
                $end = min($currentPage + 3, $lastPage);
            @endphp

            {{-- Tampilkan 2 halaman sebelum dan sesudah halaman aktif --}}
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $currentPage)
                    <span aria-current="page">
                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-500 cursor-default leading-5 rounded-md">{{ $page }}</span>
                    </span>
                @else
                    <a href="{{ $paginator->url($page) }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-600 leading-5 hover:text-gray-800 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            {{-- Tampilkan titik-titik jika ada halaman yang terlewat --}}
            @if ($end < $lastPage - 1)
                <span aria-disabled="true">
                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-600 cursor-default leading-5">...</span>
                </span>
            @endif

            {{-- Tampilkan 2 halaman terakhir --}}
            @if ($end < $lastPage)
                @for ($page = max($lastPage - 1, $end + 1); $page <= $lastPage; $page++)
                    @if ($page == $currentPage)
                        <span aria-current="page">
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-500 cursor-default leading-5 rounded-md">{{ $page }}</span>
                        </span>
                    @else
                        <a href="{{ $paginator->url($page) }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-600 leading-5 hover:text-gray-800 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                            {{ $page }}
                        </a>
                    @endif
                @endfor
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-600 rounded-r-md leading-5 hover:text-gray-800 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-400 cursor-default rounded-r-md leading-5" aria-hidden="true">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </span>
            @endif
        </span>
    </div>
</nav>
