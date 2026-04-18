document.addEventListener('DOMContentLoaded', () => {
    const display = document.getElementById('temporizador-display');
    if (!display) { return; }

    const inputMin  = document.getElementById('input-min');
    const inputSec  = document.getElementById('input-sec');
    const setup     = document.getElementById('temporizador-setup');
    const btnStart  = document.getElementById('btn-start');
    const btnReset  = document.getElementById('btn-reset');

    let remaining = 0; // ms restantes
    let startedAt = null;
    let interval  = null;
    let running   = false;

    function pad(n) {
        return String(n).padStart(2, '0');
    }

    function render() {
        const total = Math.ceil(remaining / 1000);
        const m = Math.floor(total / 60);
        const s = total % 60;
        display.textContent = `${pad(m)}:${pad(s)}`;
    }

    function finish() {
        clearInterval(interval);
        running = false;
        remaining = 0;
        render();
        display.classList.add('text-danger');
        btnStart.hidden = true;
        btnReset.hidden = false;
        btnReset.textContent = 'Reiniciar';
    }

    function start() {
        if (remaining <= 0) { return; }

        startedAt = Date.now();
        interval  = setInterval(() => {
            const delta = Date.now() - startedAt;
            startedAt = Date.now();
            remaining = Math.max(0, remaining - delta);
            render();
            if (remaining === 0) { finish(); }
        }, 100);

        running = true;
        setup.hidden = true;
        display.classList.remove('text-danger');
        btnStart.textContent = 'Pausar';
        btnReset.hidden = true;
    }

    function pause() {
        clearInterval(interval);
        running = false;
        btnStart.textContent = 'Continuar';
        btnReset.hidden = false;
        btnReset.textContent = 'Reiniciar';
    }

    function reset() {
        clearInterval(interval);
        running = false;
        remaining = 0;
        display.classList.remove('text-danger');
        display.textContent = '00:00';
        setup.hidden = false;
        inputMin.value = '';
        inputSec.value = '';
        btnStart.hidden = false;
        btnStart.textContent = 'Iniciar';
        btnReset.hidden = true;
    }

    function loadFromInputs() {
        const m = Math.min(99, parseInt(inputMin.value) || 0);
        const s = Math.min(59, parseInt(inputSec.value) || 0);
        remaining = (m * 60 + s) * 1000;
        render();
    }

    inputMin.addEventListener('input', () => {
        let v = parseInt(inputMin.value) || 0;
        if (v > 99) { inputMin.value = 99; v = 99; }
        loadFromInputs();
    });

    inputSec.addEventListener('input', () => {
        let v = parseInt(inputSec.value) || 0;
        if (v > 59) { inputSec.value = 59; v = 59; }
        loadFromInputs();
    });

    btnStart.addEventListener('click', () => running ? pause() : start());
    btnReset.addEventListener('click', reset);
});
