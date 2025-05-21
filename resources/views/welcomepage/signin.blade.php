<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AubCharika - Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #0a0913;
            --gold-gradient: linear-gradient(195deg, rgba(255, 179, 0, 1) 0%, rgba(255, 147, 5, 1) 67%, rgba(248, 238, 196, 1) 100%);
        }

        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--primary-bg);
            background-image:
                radial-gradient(circle at bottom left, #e28d0ec2 0%, #865c1dbc 5%, #131209 30%),
                radial-gradient(circle at top right, #b3781d00 0%, #fb9b0c40 20%, #090811 60%);
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 30px;
            border: 1px solid rgba(255, 179, 0, 0.2);
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 179, 0, 0.2);
            color: white;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ffc107;
            color: white;
            box-shadow: none;
        }

        .form-label {
            color: #ffc107;
        }

        .btn-primary {
            background: var(--gold-gradient);
            border: none;
            color: #000;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: linear-gradient(195deg, rgba(255, 179, 0, 0.8) 0%, rgba(255, 147, 5, 0.8) 67%, rgba(248, 238, 196, 0.8) 100%);
        }

        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo mb-2">
            <h3 class="text-warning fw-bold">AubCharika</h3>
            <h5>Sign In</h5>
        </div>

        <!-- Display error messages -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->has('username'))
            <div class="alert alert-danger">
                {{ $errors->first('username') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>