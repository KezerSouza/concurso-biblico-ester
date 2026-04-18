<header class="app-header border-bottom bg-white px-4 py-3">
    <div class="mx-auto d-flex align-items-center justify-content-between" style="max-width: 960px;">
        <h1 class="fw-bold fs-4 mb-0 text-nowrap flex-shrink-0">Concurso Bíblico - Ester</h1>
        <div class="app-header-nav d-flex align-items-center gap-2 flex-shrink-1" style="overflow-x: auto;">
            {{ $slot }}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-dark" title="Sair">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" x2="9" y1="12" y2="12"></line>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>
