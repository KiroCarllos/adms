<!-- create-account.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>Create Account</title>
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
            <img id="admslogoC" src="{{ asset('account/ADMSlogo.png') }}">
            <h1>Create Account</h1>

            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success')}}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error')}}
            </div>
        @endif



            <form action="{{ route('register')}}" method="POST">
                @csrf <!-- Add this line to include the CSRF token -->

                <label for="uname"><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="name" required>

                <label for="ID"><b>ID</b></label>
                <input type="text" placeholder="Enter ID" name="idnum" required>

                <label for="phone"><b>Phone</b></label>
                <input type="text" placeholder="Enter Phone" name="phone" required>

                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">&#x1F441;</span>



                <button type="submit">Create Account</button>
                <h1 id="noaccount">Already have an account? <a id="link" href='login'>Log in</a></h1>
            </form>
        </div>
    </div>
</body>
</html>
