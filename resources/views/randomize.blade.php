<x-layout>
    <header class="border-bottom bg-white px-4 py-3">
        <div class="mx-auto d-flex align-items-center justify-content-between" style="max-width: 960px;">
            <h1 class="fw-bold fs-4 mb-0">Concurso Bíblico - Ester</h1>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
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

    <main class="mx-auto px-4 py-5 text-center" style="max-width: 960px;">
        <h2 class="fw-bold fs-5 mb-5">Sorteio de Time</h2>

        <div
            id="draw-display"
            class="rounded-4 border d-flex align-items-center justify-content-center mx-auto mb-5"
            style="width: 280px; height: 280px;"
            data-teams="{{ json_encode($teams->map(fn($t) => ['name' => $t->name, 'color' => $t->color->value])) }}"
        >
            <span id="draw-team-name" class="fw-bold fs-2">?</span>
        </div>

        <button id="btn-draw" class="btn btn-dark btn-lg px-5">Sortear</button>
    </main>

    <x-confetti />
</x-layout>
