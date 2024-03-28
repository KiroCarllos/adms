<!-- login.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="{{ asset('account/styles.css') }}">
</head>
<body>
    <script src="{{ asset('account/password.js') }}" defer></script>
    <div class="background">
        <div class="login-container">
            <img id="admslogoL" src="{{ asset('account/ADMSlogo.png') }}">
            <h1>Login</h1>

            @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error')}}
            </div>
            @endif

            <form action="{{ route('login')}}" method="POST">
                @csrf <!-- Add this line to include the CSRF token -->

                <label for="uname"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">&#x1F441;</span>

                <button type="submit">Login</button>
                <h1 id="noaccount">Don't have an account? <a id="link" href='register'>Create one</a></h1>
            </form>
        </div>
    </div>
</body>
</html>
