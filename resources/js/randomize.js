// ----- Configuração -----
const CONFETTI_DURATION = 2000; // duração do confete em ms
const BTN_REVEAL_DELAY  = 1500; // delay para o botão reaparecer após o sorteio em ms
// ------------------------

const borderColors = {
    blue: '#0d6efd',
    yellow: '#ffc107',
    red: '#dc3545',
};

const bgColors = {
    blue: 'rgba(13, 110, 253, 0.08)',
    yellow: 'rgba(255, 193, 7, 0.08)',
    red: 'rgba(220, 53, 69, 0.08)',
};

let running = false;

function applyTeam(display, nameEl, team) {
    display.style.borderColor = borderColors[team.color];
    display.style.borderWidth = '3px';
    display.style.borderStyle = 'solid';
    display.style.backgroundColor = bgColors[team.color];
    nameEl.textContent = team.name;
}

function resetDisplay(display, nameEl) {
    display.style.borderColor = '';
    display.style.borderWidth = '';
    display.style.borderStyle = '';
    display.style.backgroundColor = '';
    nameEl.textContent = '?';
}

document.addEventListener('DOMContentLoaded', () => {
    const display = document.getElementById('draw-display');
    if (!display) { return; }

    const nameEl = document.getElementById('draw-team-name');
    const btn = document.getElementById('btn-draw');
    const teams = JSON.parse(display.dataset.teams);

    btn.addEventListener('click', () => {
        if (running) { return; }
        running = true;

        resetDisplay(display, nameEl);
        Confetti.stop();
        btn.hidden = true;

        const winner = teams[Math.floor(Math.random() * teams.length)];
        const totalSteps = 24;
        let step = 0;

        function tick() {
            const progress = step / totalSteps;
            const delay = 80 + Math.pow(progress, 2) * 320;

            applyTeam(display, nameEl, teams[step % teams.length]);
            step++;

            if (step < totalSteps) {
                setTimeout(tick, delay);
            } else {
                applyTeam(display, nameEl, winner);
                Confetti.start([borderColors[winner.color]], CONFETTI_DURATION);
                setTimeout(() => {
                    running = false;
                    btn.hidden = false;
                    btn.textContent = 'Sortear Novamente';
                }, BTN_REVEAL_DELAY);
            }
        }

        tick();
    });
});
