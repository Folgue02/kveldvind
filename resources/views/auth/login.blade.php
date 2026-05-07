<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KveldVind - Login</title>
    @vite([
        'resources/css/app.css',
        'resources/css/auth/login.css',
        'resources/css/share/form.css'
    ])
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <form action="{{ route('login') }}" method="POST" class="form">
            @csrf
            <div class="form-line">
                <div class="section">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-line">
                <div class="section">
                    <label for="password">Password</label>
                    <input type="password" name="password">
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-line">
                <div class="checkbox-section">
                    <label for="remember">Remember me</label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'selected' : '' }}>
                </div>
            </div>

            <div class="action-line">
                <input type="submit" value="Login" class="action" style="cursor: pointer">
            </div>
        </form>
    </div>
</body>
</html>
