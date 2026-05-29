<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Wertugo</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fb; /* Warna putih keabu-abuan dari gambar */
            font-family: 'Poppins', sans-serif;
        }

        .login-wrapper {
            max-width: 380px;
            width: 100%;
            padding: 20px;
        }

        /* --- STYLING LOGO --- */
        .logo-container {
            width: 90px;
            height: 90px;
            background-color: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }
        
        .logo-container img {
            width: 60px;
            height: auto;
        }

        /* --- TYPOGRAPHY --- */
        .brand-title {
            color: #0c7b1b; /* Warna hijau khas Wertugo */
            font-weight: 700;
            font-size: 32px;
            margin-bottom: 0;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #4b5563;
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 6px;
            padding-left: 10px;
        }

        /* --- CUSTOM INPUTS --- */
        .custom-input {
            background-color: #f3f5f9;
            border: 1px solid #e2e8f0;
            height: 50px;
            font-size: 14px;
            color: #333;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            background-color: #fff;
            border-color: #0c7b1b;
            box-shadow: 0 0 0 4px rgba(12, 123, 27, 0.1);
        }

        .custom-input::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        /* Mengatur posisi icon di dalam input */
        .input-icon-left {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 18px;
            z-index: 10;
        }

        .input-icon-right {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 18px;
            cursor: pointer;
            z-index: 10;
            transition: color 0.2s;
        }

        .input-icon-right:hover {
            color: #0c7b1b;
        }

        /* --- TOMBOL --- */
        .btn-login {
            background-color: #0c7b1b;
            color: white;
            height: 50px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #096115;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(12, 123, 27, 0.2);
        }

        .forgot-link {
            color: #0c7b1b;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #096115;
            text-decoration: underline;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="login-wrapper text-center">
        
        <div class="logo-container">
            <img src="{{ asset('img/logo.png') }}" alt="Wertugo Logo" onerror="this.src='https://ui-avatars.com/api/?name=W&background=0c7b1b&color=fff&rounded=true&size=60'">
        </div>
        <h1 class="brand-title">Wertugo</h1>
        <p class="subtitle">Admin Panel</p>

        @if($errors->any())
            <div class="alert alert-danger py-2 px-3 small rounded-4 text-start mb-4">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success py-2 px-3 small rounded-4 text-start mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="text-start">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Account Name</label>
                <div class="position-relative">
                    <i class="bi bi-envelope-at-fill input-icon-left"></i>
                    <input type="email" class="form-control rounded-pill custom-input ps-5" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your username or email" required autofocus>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="position-relative">
                    <i class="bi bi-lock input-icon-left"></i>
                    <input type="password" class="form-control rounded-pill custom-input ps-5 pe-5" id="password" name="password" placeholder="Enter your password" required>
                    <i class="bi bi-eye input-icon-right" id="togglePassword"></i>
                </div>
            </div>
            
            <button type="submit" class="btn btn-login w-100 rounded-pill fw-bold mb-3">
                Login
            </button>
        </form>

    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // Toggle type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Toggle icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>