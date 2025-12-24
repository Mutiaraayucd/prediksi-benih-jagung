<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornPredict - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <!-- Background Animation -->
  

    <div class="bg-animation">
        <div class="floating-corn">🌽</div>
        <div class="floating-corn">🌱</div>
        <div class="floating-corn">🌽</div>
        <div class="floating-corn">🌱</div>
    </div>

    <div class="container">
          @include('sweetalert::alert')
        <!-- Corn Yield Prediction Card -->
        <div class="feature-card">
            <div class="feature-icon">🌱</div>
            <h3 class="feature-title">Corn Yield Prediction</h3>
            <p class="feature-description">Estimasi hasil panen jagung berbasis data lahan, varietas, dan cuaca terkini dengan akurasi tinggi menggunakan AI</p>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <div class="logo-section">
                <div class="logo">
                    <span class="corn-icon">🌽</span>
                    CornPredict
                </div>
                <p class="welcome-text">Selamat Datang, Ayu!</p>
            </div>

            <form id="loginForm" class="login-form" method="POST" action="{{ route('postlogin') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i>Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        class="form-input" 
                        placeholder="Masukkan email Anda"
                        name="email"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock"></i>Password
                    </label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            class="form-input" 
                            placeholder="Masukkan password Anda"
                            name="password"
                            minlength="8"
                            value="{{ old('password') }}"
                            required
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    {{-- <div class="password-strength">
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                    </div>
                    <p class="password-hint">
                        <i class="fas fa-info-circle"></i>
                        Gunakan 8 karakter atau lebih dengan kombinasi huruf, angka & simbol
                    </p> --}}
                </div>

                {{-- <div class="additional-options">
                    <label class="remember-me">
                        <input type="checkbox"> Ingat saya
                    </label>
                    <a href="#" class="forgot-password">Lupa password?</a>
                </div> --}}

                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>

        <!-- Seed Planning Card -->
        <div class="feature-card">
            <div class="feature-icon">🌽</div>
            <h3 class="feature-title">Seed Planning</h3>
            <p class="feature-description">Hitung stok benih kemasan secara otomatis maupun manual dari hasil panen dengan perencanaan yang optimal</p>
        </div>
    </div>
    <script src="sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>