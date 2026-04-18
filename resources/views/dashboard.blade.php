<x-layout>
    <x-app-header hide-title-on-mobile>
        <a href="{{ route('history') }}" class="btn btn-outline-secondary">Histórico</a>
        <a href="{{ route('randomize') }}" class="btn btn-outline-secondary">Sorteio</a>
        <a href="{{ route('stopwatch') }}" class="btn btn-outline-secondary">Cronômetro</a>
        <a href="{{ route('temporizador') }}" class="btn btn-outline-secondary">Temporizador</a>
    </x-app-header>

    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast show align-items-center text-bg-dark border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast show align-items-center text-bg-danger border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">{{ session('error') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif

    {{-- Main --}}
    <main class="mx-auto px-4 py-5" style="max-width: 960px;">

        <div class="mb-5 text-center">
            <button id="btn-reveal" class="btn btn-outline-dark px-4" onclick="toggleScores()">
                <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 d-none">
                    <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"></path>
                    <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"></path>
                    <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"></path>
                    <path d="m2 2 20 20"></path>
                </svg>
                <span id="btn-reveal-text">Revelar Pontuações</span>
            </button>
        </div>

        <div class="row g-4">
            @foreach($teams as $team)
                @php $bsColor = $team->color->bootstrapColor(); @endphp
                <div class="col-md-4">
                    <div class="team-card-{{ $team->color->value }} rounded-3 p-4 text-center">
                        <h2 class="fw-bold text-dark fs-4 mb-4 text-nowrap">{{ $team->name }}</h2>

                        <div class="mb-4 d-flex align-items-center justify-content-center" style="height: 80px;">
                            <span class="score-value display-4 fw-bold text-secondary" data-score="{{ $team->score }}" style="opacity: 0.35;">???</span>
                        </div>

                        <div class="d-flex flex-column gap-4">
                            <button
                                class="btn btn-outline-{{ $bsColor }} w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-points"
                                data-team-id="{{ $team->id }}"
                                data-team-name="{{ $team->name }}"
                                data-mode="add"
                            >
                                Adicionar
                            </button>
                            <button
                                class="btn btn-outline-secondary w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-points"
                                data-team-id="{{ $team->id }}"
                                data-team-name="{{ $team->name }}"
                                data-mode="remove"
                            >
                                Remover
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    {{-- Modal --}}
    <div class="modal fade" id="modal-points" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="form-points" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label class="form-label" id="modal-label"></label>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-outline-secondary" onclick="adjustPoints(-1)">−</button>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" name="points" id="input-points" class="form-control text-center fw-bold" value="1" style="width: 100px;">
                            <button type="button" class="btn btn-outline-secondary" onclick="adjustPoints(1)">+</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Populate modal with team data
        document.getElementById('modal-points').addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;
            const teamId = btn.dataset.teamId;
            const teamName = btn.dataset.teamName;
            const isAdd = btn.dataset.mode === 'add';

            document.getElementById('modal-title').textContent = (isAdd ? 'Adicionar' : 'Remover') + ' Pontos — ' + teamName;
            document.getElementById('modal-label').textContent = isAdd ? 'Pontos a adicionar' : 'Pontos a remover';
            document.getElementById('form-points').action = '/teams/' + teamId + '/points' + (isAdd ? '' : '/remove');
            document.getElementById('input-points').value = 1;
        });

        // Reset input on close
        document.getElementById('modal-points').addEventListener('hidden.bs.modal', function () {
            document.getElementById('input-points').value = 1;
        });

        function adjustPoints(delta) {
            const input = document.getElementById('input-points');
            const current = parseInt(input.value) || 1;
            input.value = Math.max(1, current + delta);
        }

        document.getElementById('input-points').addEventListener('input', function () {
            const val = parseInt(this.value);
            if (!isNaN(val)) { this.value = val; }
        });

        document.getElementById('input-points').addEventListener('blur', function () {
            const val = parseInt(this.value);
            this.value = isNaN(val) || val < 1 ? 1 : val;
        });

        // Toggle score reveal
        let scoresRevealed = localStorage.getItem('scoresRevealed') === 'true';

        function applyScoreState() {
            document.querySelectorAll('.score-value').forEach(el => {
                el.textContent = scoresRevealed ? el.dataset.score : '???';
                el.style.opacity = scoresRevealed ? '1' : '0.35';
            });

            document.getElementById('btn-reveal-text').textContent = scoresRevealed ? 'Ocultar Pontuações' : 'Revelar Pontuações';
            document.getElementById('icon-eye').classList.toggle('d-none', scoresRevealed);
            document.getElementById('icon-eye-off').classList.toggle('d-none', !scoresRevealed);
        }

        function toggleScores() {
            scoresRevealed = !scoresRevealed;
            localStorage.setItem('scoresRevealed', scoresRevealed);
            applyScoreState();
        }

        applyScoreState();

        document.querySelector('form[action="{{ route('logout') }}"]').addEventListener('submit', function () {
            localStorage.removeItem('scoresRevealed');
        });
    </script>
</x-layout>
