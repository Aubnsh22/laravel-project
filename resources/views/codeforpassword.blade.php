<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Enter Reset Code</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: #0a0913;
            background-image:
                radial-gradient(circle at bottom left, #e28d0ec2 0%, #865c1dbc 5%, #131209 30%),
                radial-gradient(circle at top right, #b3781d00 0%, #fb9b0c40 20%, #090811 60%);
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .code-form {
            position: relative;
            padding: 40px 30px;
            width: 360px;
            z-index: 100;
            text-align: center;
            background: rgba(17, 12, 6, 0.85);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 15px;
            border: 1px solid rgba(220, 144, 22, 0.2);
            box-shadow: 0 10px 35px rgba(

174, 97, 20, 0.3);
        }

        .code-form h5 {
            color: #dc9016;
            margin-bottom: 30px;
            font-size: 1.8rem;
            font-weight: 600;
            text-transform: uppercase;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            letter-spacing: 1px;
        }

        .code-form input {
            width: 100%;
            padding: 14px 20px;
            margin: 12px 0;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.989);
            color: #000000;
            transition: all 0.3s ease;
        }

        .code-form input::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }

        .code-form input:focus {
            outline: none;
            background: rgba(255, 221, 174, 0.588);
            box-shadow: 0 0 0 2px rgba(220, 144, 22, 0.3);
        }

        .code-form button {
            background-color: #dc9016;
            color: white;
            border: none;
            padding: 14px 20px;
            margin-top: 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .code-form button:hover {
            background-color: #e69a1e;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 144, 22, 0.3);
        }

        .code-form::after {
            content: "YOUR WORKDAYS";
            display: block;
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.9rem;
            margin-top: 30px;
            letter-spacing: 2px;
            font-weight: 300;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <form class="code-form" method="POST" action="{{ url('/reset-password') }}">
        @method('patch')
        @csrf
        <h5>Enter Reset Code</h5>
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="text" name="code" placeholder="6-Digit Code" required>
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <button type="submit">Verify Code</button>
    </form>
</body>
</html>