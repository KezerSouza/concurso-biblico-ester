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
    <x-confetti :autostart="true" />
</x-layout>
