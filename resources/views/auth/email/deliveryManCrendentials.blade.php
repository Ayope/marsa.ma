<!doctype html>
<html>
<head>
    @vite(['resources/sass/app.scss','resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div class="container">
        <h1 class="text-center">Your Credentials</h1>
        <p>Dear user,</p>
        <p>Your credentials is:</p>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title"><strong>Email: </strong>{{$email}}</h2>
                <h2 class="card-title"><strong>Password: </strong>{{ $password }}</h2>
            </div>
        </div>
        <p>Please use this password to log in to your account, If it didn't work please contact us immediately.</p>
        <p>Best regards,<br>Marsa.ma</p>
    </div>
</body>
</html>
