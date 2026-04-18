<x-layout>
    {{-- Header --}}
    <x-app-header>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
    </x-app-header>

    {{-- Main --}}
    <main class="mx-auto px-4 py-5" style="max-width: 960px;">

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
            <h2 class="fw-bold fs-5 mb-0">Histórico de Pontuações</h2>

            {{-- Filter --}}
            <form method="GET" action="{{ route('history') }}" class="d-flex align-items-center gap-2 ms-auto">
                <label for="team-filter" class="form-label mb-0 text-secondary small">Filtrar por time</label>
                <select id="team-filter" name="team" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                    <option value="">Todos os times</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" @selected(request('team') == $team->id)>
                            {{ $team->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        @if($histories->isEmpty())
            <div class="text-center text-secondary py-5">
                <p class="mb-0">Nenhum ponto atribuído ainda.</p>
            </div>
        @else
            <div class="list-group">
                @foreach($histories as $entry)
                    @php
                        $bsColor = $entry->team->color->bootstrapColor();
                        $isRemoval = $entry->points < 0;
                    @endphp
                    <div class="list-group-item d-flex align-items-center justify-content-between py-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-secondary small fw-semibold" style="min-width: 2rem;">#{{ $entry->id }}</span>
                            <span class="badge bg-{{ $bsColor }} rounded-pill">{{ $entry->team->name }}</span>
                        </div>
                        <span class="fw-bold {{ $isRemoval ? 'text-secondary' : 'text-' . $bsColor }}">
                            {{ $isRemoval ? '' : '+' }}{{ $entry->points }} pts
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="mt-3 text-end text-secondary small">
                {{ $histories->count() }} {{ $histories->count() === 1 ? 'registro' : 'registros' }}
                @if($selectedTeam)
                    &nbsp;·&nbsp; Total: <strong>{{ $histories->sum('points') }} pts</strong> para {{ $selectedTeam->name }}
                @else
                    &nbsp;·&nbsp; Total geral: <strong>{{ $histories->sum('points') }} pts</strong>
                @endif
            </div>
        @endif

    </main>
</x-layout>
