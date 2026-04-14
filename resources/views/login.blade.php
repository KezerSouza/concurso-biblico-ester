<x-layout>
    <div class="d-flex align-items-center justify-content-center vh-100 px-3">
        <div class="w-100" style="max-width: 475px;">

            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary-subtle mb-3" style="width: 80px; height: 80px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 7v14"></path>
                        <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path>
                    </svg>
                </div>
                <h1 class="fw-bold mb-1" style="font-size: 2.2rem;">Concurso Bíblico - Ester</h1>
                <p class="text-secondary mb-0">Área do administrador</p>
            </div>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="mb-3">
                    <div class="position-relative">
                        <span class="position-absolute top-50 translate-middle-y ps-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-secondary">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                        <input
                            type="password"
                            name="password"
                            placeholder="Senha do admin"
                            class="form-control form-control-lg ps-5 @error('password') is-invalid @enderror"
                        >
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark btn-lg w-100">Entrar</button>
            </form>

        </div>
    </div>
    {{-- CONFETE: para remover, apague o bloco <script> abaixo --}}
    <script>
        const config = {
            count: 50,        // quantidade de partículas
            speedY: 1.5,       // velocidade de queda (maior = mais rápido)
            speedX: 0.5,       // oscilação lateral
            rotationSpeed: 3,  // velocidade de rotação
            sizeW: 10,         // largura máxima do confete
            sizeH: 5,          // altura máxima do confete
        };

        const canvas = document.createElement('canvas');
        canvas.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:9999;';
        document.body.prepend(canvas);

        const ctx = canvas.getContext('2d');
        const colors = ['#FFD700', '#DC3545', '#0D6EFD'];
        const particles = [];

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        function Particle() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.width = Math.random() * config.sizeW + 5;
            this.height = Math.random() * config.sizeH + 3;
            this.color = colors[Math.floor(Math.random() * colors.length)];
            this.speedY = Math.random() * config.speedY + 0.5;
            this.speedX = (Math.random() - 0.5) * config.speedX;
            this.rotation = Math.random() * 360;
            this.rotationSpeed = (Math.random() - 0.5) * config.rotationSpeed;
        }

        for (let i = 0; i < config.count; i++) {
            particles.push(new Particle());
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            particles.forEach(p => {
                p.y += p.speedY;
                p.x += p.speedX;
                p.rotation += p.rotationSpeed;

                if (p.y > canvas.height + 10) {
                    p.y = -10;
                    p.x = Math.random() * canvas.width;
                }

                ctx.save();
                ctx.translate(p.x, p.y);
                ctx.rotate(p.rotation * Math.PI / 180);
                ctx.fillStyle = p.color;
                ctx.fillRect(-p.width / 2, -p.height / 2, p.width, p.height);
                ctx.restore();
            });

            requestAnimationFrame(animate);
        }

        animate();
    </script>
</x-layout>
