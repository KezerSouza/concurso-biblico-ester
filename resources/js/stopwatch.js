document.addEventListener('DOMContentLoaded', () => {
    const display = document.getElementById('stopwatch-display');
    if (!display) { return; }

    const btnStart  = document.getElementById('btn-start');
    const btnReset  = document.getElementById('btn-reset');

    let elapsed   = 0; // ms acumulados
    let startedAt = null;
    let interval  = null;
    let running   = false;

    function pad(n) {
        return String(n).padStart(2, '0');
    }

    function render() {
        const total = Math.floor(elapsed / 1000);
        const h = Math.floor(total / 3600);
        const m = Math.floor((total % 3600) / 60);
        const s = total % 60;
        display.textContent = `${pad(h)}:${pad(m)}:${pad(s)}`;
    }

    function start() {
        startedAt = Date.now();
        interval  = setInterval(() => {
            elapsed = elapsed + (Date.now() - startedAt);
            startedAt = Date.now();
            render();
        }, 100);
        running = true;
        btnStart.textContent = 'Pausar';
        btnReset.hidden = true;
    }

    function pause() {
        clearInterval(interval);
        running = false;
        btnStart.textContent = 'Continuar';
        btnReset.hidden = false;
    }

    function reset() {
        clearInterval(interval);
        elapsed   = 0;
        running   = false;
        startedAt = null;
        render();
        btnStart.textContent = 'Iniciar';
        btnReset.hidden = true;
    }

    btnStart.addEventListener('click', () => running ? pause() : start());
    btnReset.addEventListener('click', reset);

    render();
});
