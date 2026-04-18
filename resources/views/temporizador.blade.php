<x-layout>
    <x-app-header>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
    </x-app-header>

    <main class="mx-auto px-4 py-5 text-center" style="max-width: 960px;">
        <h2 class="fw-bold fs-5 mb-5">Temporizador</h2>

        <div id="temporizador-setup" class="mb-4">
            <div class="d-flex align-items-center justify-content-center gap-2">
                <div class="text-start">
                    <label class="form-label text-secondary small mb-1">Minutos</label>
                    <input id="input-min" type="number" class="form-control text-center fw-bold fs-4" min="0" max="99" placeholder="00" style="width: 90px;">
                </div>
                <span class="fw-bold fs-3 mt-3">:</span>
                <div class="text-start">
                    <label class="form-label text-secondary small mb-1">Segundos</label>
                    <input id="input-sec" type="number" class="form-control text-center fw-bold fs-4" min="0" max="59" placeholder="00" style="width: 90px;">
                </div>
            </div>
        </div>

        <div class="mb-5">
            <span id="temporizador-display" class="fw-bold" style="font-size: 6rem; letter-spacing: 0.05em; font-variant-numeric: tabular-nums;">00:00</span>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <button id="btn-start" class="btn btn-dark btn-lg px-5">Iniciar</button>
            <button id="btn-reset" class="btn btn-outline-secondary btn-lg px-4" hidden>Reiniciar</button>
        </div>
    </main>
</x-layout>
