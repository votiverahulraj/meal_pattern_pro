<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="{{url('/')}}/assets/css/bootstrap.css">
    
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css/app.css">
</head>

<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Sign Up</h3>
                        <p>Please fill the form to register.</p>
                    </div>
                    <form action="{{ route('custom.register.process')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">First Name</label>
                                    <input type="text" id="first-name-column" value="{{ old('name')}}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"  name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email-id-column">Email</label>
                                    <input type="email" id="email-id-column" value="{{ old('email')}}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password-id-column">Password</label>
                                    <input type="password" id="password-id-column" value="{{ old('password')}}" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password-id-column">Original Password</label>
                                    <input type="password" id="password-id-column" value="{{ old('password_confirmation')}}" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation">
                                    @error('original_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </diV>

                        <a href="auth-login.html">Have an account? Login</a>
                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                        </div>
                    </form>
                    <div class="divider">
                        <div class="divider-text">OR</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-block mb-2 btn-primary"><i data-feather="facebook"></i> Facebook</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-block mb-2 btn-secondary"><i data-feather="github"></i> Github</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="{{ url('/')}}/assets/js/feather-icons/feather.min.js"></script>
    <script src="{{ url('/')}}/assets/js/app.js"></script>
    
    <script src="{{ url('/')}}assets/js/main.js"></script>
</body>

</html>