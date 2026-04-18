<x-layout>
    <x-app-header>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
    </x-app-header>

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
