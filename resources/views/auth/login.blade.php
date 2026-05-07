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
                <x-share.form.text-input
                    label="Email"
                    name="email"
                    type="email"
                    required="true"/>
            </div>

            <div class="form-line">
                <x-share.form.text-input
                    label="Password"
                    name="password"
                    input-type="password"
                    required="true"/>
            </div>

            <div class="form-line">
                <x-share.form.checkbox-input
                    name="remember"
                    label="Remember me"/>
            </div>

            <div class="action-line">
                <input type="submit" value="Login" class="action" style="cursor: pointer">
            </div>
        </form>
    </div>
</body>
</html>
