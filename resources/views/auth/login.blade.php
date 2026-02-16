<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Voler Admin Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
<div id="auth">

<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">

                <div class="card-body">

                    <div class="text-center mb-5">
                        <img src="{{ asset('assets/images/favicon.svg') }}" height="48" class="mb-4">
                        <h3>Sign In</h3>
                        <p>Please sign in to continue.</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="form-group position-relative has-icon-left">
                            <label>Email</label>

                            <div class="position-relative">
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="{{ old('email') }}"
                                       required autofocus>

                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <!-- Password -->
                        <div class="form-group position-relative has-icon-left mt-3">

                            <div class="clearfix">
                                <label>Password</label>

                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="float-end">
                                    <small>Forgot password?</small>
                                </a>
                                @endif

                            </div>

                            <div class="position-relative">
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       required>

                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>


                        <!-- Remember me -->
                        <div class="form-check clearfix my-4">

                            <div class="checkbox float-start">
                                <input type="checkbox"
                                       name="remember"
                                       class="form-check-input">

                                <label>Remember me</label>
                            </div>

                            <div class="float-end">
                                <a href="{{ route('register') }}">
                                    Don't have an account?
                                </a>
                            </div>

                        </div>


                        <!-- Submit -->
                        <div class="clearfix">
                            <button type="submit"
                                    class="btn btn-primary float-end">
                                Log in
                            </button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- JS -->
<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    feather.replace();
</script>

</body>
</html>
