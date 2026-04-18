// ----- Configuração -----
const CONFIG = {
    count: 80,         // quantidade de partículas
    speedY: 2,         // velocidade de queda
    speedX: 0.8,       // oscilação lateral
    rotationSpeed: 4,  // velocidade de rotação
    sizeW: 10,         // largura máxima
    sizeH: 5,          // altura máxima
};
// ------------------------

let canvas, ctx;
let particles = [];
let animFrame = null;
let stopping = false;

function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}

function makeParticle(colors, randomY = true) {
    return {
        x: Math.random() * canvas.width,
        y: randomY ? Math.random() * canvas.height : -Math.random() * 20,
        width: Math.random() * CONFIG.sizeW + 5,
        height: Math.random() * CONFIG.sizeH + 3,
        color: colors[Math.floor(Math.random() * colors.length)],
        speedY: Math.random() * CONFIG.speedY + 0.5,
        speedX: (Math.random() - 0.5) * CONFIG.speedX,
        rotation: Math.random() * 360,
        rotationSpeed: (Math.random() - 0.5) * CONFIG.rotationSpeed,
    };
}

function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    particles = particles.filter(p => {
        p.y += p.speedY;
        p.x += p.speedX;
        p.rotation += p.rotationSpeed;

        if (p.y > canvas.height + 10) {
            if (stopping) { return false; }
            p.y = -10;
            p.x = Math.random() * canvas.width;
        }

        ctx.save();
        ctx.translate(p.x, p.y);
        ctx.rotate(p.rotation * Math.PI / 180);
        ctx.fillStyle = p.color;
        ctx.fillRect(-p.width / 2, -p.height / 2, p.width, p.height);
        ctx.restore();

        return true;
    });

    if (particles.length > 0) {
        animFrame = requestAnimationFrame(animate);
    } else {
        animFrame = null;
    }
}

window.Confetti = {
    start(colors, duration = null) {
        if (animFrame) { cancelAnimationFrame(animFrame); }
        stopping = false;
        particles = Array.from({ length: CONFIG.count }, () => makeParticle(colors));
        if (duration) { setTimeout(() => { stopping = true; }, duration); }
        animate();
    },
    stop() {
        stopping = true;
    },
};

document.addEventListener('DOMContentLoaded', () => {
    canvas = document.createElement('canvas');
    canvas.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:9999;';
    document.body.prepend(canvas);
    ctx = canvas.getContext('2d');
    window.addEventListener('resize', resize);
    resize();

    const el = document.querySelector('[data-confetti-autostart]');
    if (el) {
        const colors = JSON.parse(el.dataset.confettiColors);
        const duration = el.dataset.confettiDuration ? parseInt(el.dataset.confettiDuration) : null;
        window.Confetti.start(colors, duration);
    }
});
