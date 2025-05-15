<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login - ExamBolt</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1d3557, #457b9d);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }
        .login-card .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1d3557;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .login-card .btn-primary {
            background: #1d3557;
            border: none;
            transition: all 0.3s ease;
        }
        .login-card .btn-primary:hover {
            background: #457b9d;
        }
        .login-card input {
            border-radius: 5px;
            padding: 0.8rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(21, 101, 192, 0.25);
        }
        .login-card .alert {
            font-size: 0.9rem;
        }
        .footer-text {
            font-size: 0.9rem;
            text-align: center;
            color: #ddd;
            margin-top: 1rem;
        }
        .footer-text a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-card">
        @if (session('msg'))
        <div class="alert alert-danger">
            {{ session('msg') }}
        </div>
    @endif
        <div class="logo">
            <span>Admin</span>
        </div>
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <!-- Login Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <!-- Footer -->
       
    </div>
    <!-- Bootstrap 5 Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>