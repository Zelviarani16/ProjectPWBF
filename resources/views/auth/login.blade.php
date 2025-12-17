@extends('layouts.app')

@section('content')
<style>
    /* Reset & Base */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        position: relative;
        overflow: hidden;
    }
    
    /* Animated Background Pattern */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(37, 99, 235, 0.3) 0%, transparent 50%);
        animation: pulse 8s ease-in-out infinite;
        z-index: 0;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 0.8; }
    }

    /* Medical Icon Pattern */
    body::after {
        content: '';
        position: fixed;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        animation: float 30s infinite linear;
        z-index: 0;
    }

    @keyframes float {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    /* Hide Laravel Default Navbar */
    nav.navbar {
        display: none !important;
    }

    /* Container */
    .login-wrapper {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        width: 100%;
        padding: 40px 20px;
    }

    .container {
        max-width: 1000px;
        width: 100%;
    }

    /* Logo Section */
    .logo-section {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .logo-icon {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-radius: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 
            0 10px 30px rgba(37, 99, 235, 0.4),
            0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .logo-icon::before {
        content: '🏥';
        font-size: 45px;
    }

    .logo-text {
        color: white;
        font-size: 32px;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .logo-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
        margin-top: 6px;
        font-weight: 500;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Card */
    .card {
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 24px;
        box-shadow: 
            0 20px 60px rgba(30, 58, 138, 0.3),
            0 8px 24px rgba(37, 99, 235, 0.2);
        overflow: hidden;
        backdrop-filter: blur(20px);
        animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Card Header */
    .card-header {
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        color: white;
        padding: 60px 50px;
        border: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: pulse 8s ease-in-out infinite;
    }

    .header-content {
        position: relative;
        z-index: 1;
    }

    .header-icon {
        font-size: 80px;
        margin-bottom: 20px;
        display: block;
        filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.2));
    }

    .header-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0 0 12px 0;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .header-subtitle {
        font-size: 15px;
        opacity: 0.95;
        font-weight: 500;
        margin: 0;
    }

    /* Card Body */
    .card-body {
        padding: 60px 50px;
        background: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 24px;
    }

    .form-group:last-of-type {
        margin-bottom: 28px;
    }

    /* Labels */
    label {
        display: block;
        font-weight: 600;
        color: #1e40af;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    /* Input Fields */
    .form-control {
        width: 100%;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 15px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: #1a202c;
        font-family: inherit;
    }

    .form-control:focus {
        background: white;
        border-color: #3b82f6;
        box-shadow: 
            0 0 0 4px rgba(59, 130, 246, 0.1),
            0 2px 8px rgba(37, 99, 235, 0.15);
        outline: none;
    }

    .form-control::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }

    /* Error States */
    .form-control.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .form-control.is-invalid:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .invalid-feedback {
        display: block;
        color: #ef4444;
        font-size: 13px;
        margin-top: 6px;
        font-weight: 500;
    }

    /* Checkbox */
    .remember-section {
        display: flex;
        align-items: center;
        margin-bottom: 28px;
    }

    .form-check {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin-right: 10px;
        cursor: pointer;
        border: 2px solid #cbd5e1;
        border-radius: 5px;
        transition: all 0.2s ease;
    }

    .form-check-input:checked {
        background-color: #3b82f6;
        border-color: #3b82f6;
        accent-color: #3b82f6;
    }

    .form-check-label {
        margin: 0;
        color: #475569;
        font-size: 14px;
        cursor: pointer;
        font-weight: 500;
        user-select: none;
    }

    /* Buttons */
    .btn-primary {
        width: 100%;
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 16px;
        font-size: 15px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 
            0 8px 24px rgba(37, 99, 235, 0.35),
            0 4px 12px rgba(30, 58, 138, 0.25);
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 12px 32px rgba(37, 99, 235, 0.4),
            0 6px 16px rgba(30, 58, 138, 0.3);
        background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%);
    }

    .btn-primary:active {
        transform: translateY(0);
        box-shadow: 
            0 6px 20px rgba(37, 99, 235, 0.3),
            0 3px 10px rgba(30, 58, 138, 0.2);
    }

    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* Forgot Password Link */
    .forgot-password {
        text-align: center;
    }

    .btn-link {
        color: #2563eb;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .btn-link:hover {
        color: #1e40af;
        text-decoration: none;
        transform: translateX(2px);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .card {
            grid-template-columns: 1fr;
        }

        .card-header {
            padding: 50px 40px;
        }

        .header-icon {
            font-size: 70px;
        }

        .header-title {
            font-size: 24px;
        }

        .card-body {
            padding: 50px 40px;
        }
    }

    @media (max-width: 768px) {
        .login-wrapper {
            padding: 30px 16px;
        }

        .logo-section {
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 75px;
            height: 75px;
        }

        .logo-icon::before {
            font-size: 40px;
        }

        .logo-text {
            font-size: 26px;
        }

        .card-header {
            padding: 40px 30px;
        }

        .header-icon {
            font-size: 60px;
        }

        .header-title {
            font-size: 22px;
        }

        .card-body {
            padding: 40px 30px;
        }

        .form-control {
            padding: 13px 16px;
            font-size: 14px;
        }

        .btn-primary {
            padding: 15px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .card-header {
            padding: 35px 24px;
        }

        .header-icon {
            font-size: 50px;
        }

        .header-title {
            font-size: 20px;
        }

        .card-body {
            padding: 35px 24px;
        }
    }
</style>

<div class="login-wrapper">
    <div class="container">
        <!-- <div class="logo-section">
            <div class="logo-icon"></div>
            <h1 class="logo-text">RSHP Panel</h1>
            <p class="logo-subtitle">Admin Dashboard</p>
        </div> -->

        <div class="card">
            <div class="card-header">
                <div class="header-content">
                    <span class="header-icon">🏥</span>
                    <h2 class="header-title">Selamat Datang</h2>
                    <p class="header-subtitle">Sistem Manajemen Rumah Sakit Hewan</p>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    <!-- Semua form POST di Laravel WAJIB punya CSRF token -->
                     <!-- Laravel akan menolak request POST yang tidak punya token ini.
                            Tujuannya: menghindari serangan CSRF (Cross Site Request Forgery).
                            Browser otomatis mengirim token ini saat submit. -->
                    @csrf

                    <!-- name="email" adalah dia yang menentukan nama field yang dikirim POST ke server -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            name="email"  
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email" 
                            autofocus 
                            placeholder="Masukkan email Anda"
                        >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input 
                            id="password" 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            name="password" 
                            required 
                            autocomplete="current-password" 
                            placeholder="Masukkan password Anda"
                        >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="remember-section">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="remember" 
                                id="remember" 
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">
                        Login
                    </button>

                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a class="btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@endsection