<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf <!-- CSRF Protection -->
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>

        <a href="{{ route('register') }}">
        Don't have an account? Register with us.
                </a>
    </form>
</body>
</html>
