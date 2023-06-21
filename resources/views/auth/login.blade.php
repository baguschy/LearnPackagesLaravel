<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/sass/app.scss')
</head>
<style>
    body, html {
        height: 100%;
        display: grid;
        background-color: #0d6efd;
    }
    .center-me {
        margin: auto;
    }
</style>
<body>
    <div class="card center-me" style="width: 23rem;">
        <div class="card-body p-5">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-hexagon-fill text-primary align-center" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8.5.134a1 1 0 0 0-1 0l-6 3.577a1 1 0 0 0-.5.866v6.846a1 1 0 0 0 .5.866l6 3.577a1 1 0 0 0 1 0l6-3.577a1 1 0 0 0 .5-.866V4.577a1 1 0 0 0-.5-.866L8.5.134z"/>
                </svg>
            </div>
            <h5 class="card-title mt-3 mb-5 fw-bold text-center">Employee Data Master</h5>
            <hr>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Your Email" value="{{ old('email') }}">

                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Your Password" value="{{ old('password') }}">

                    @error('password')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <hr>
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> Log In</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
