<x-layout>
    <x-app-header>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
    </x-app-header>

    <main class="mx-auto px-4 py-5 text-center" style="max-width: 960px;">
        <h2 class="fw-bold fs-5 mb-5">Cronômetro</h2>

        <div class="mb-5">
            <span id="stopwatch-display" class="fw-bold" style="font-size: 6rem; letter-spacing: 0.05em; font-variant-numeric: tabular-nums;">00:00:00</span>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <button id="btn-start" class="btn btn-dark btn-lg px-5">Iniciar</button>
            <button id="btn-reset" class="btn btn-outline-secondary btn-lg px-4" hidden>Reiniciar</button>
        </div>
    </main>
</x-layout>
