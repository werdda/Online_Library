<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Login</title>
</head>
<body class="vh-100">

    @include('layouts.navbar')
    
    <div class="container-fluid vh-100 d-flex p-0">

        {{-- Login Card --}}
        
        <div class="col-md-12 d-flex justify-content-center align-items-center"> 
            <form class="p-5 position-relative shadow" method="POST" action="{{ route('login') }}" 
            style="width: 50%; background: white; border-radius: 10px; border: 3px solid transparent; background: #FCFAEE;">
                @csrf

                {{-- Elbow Top Right --}}
                <div style="
                    position: absolute;
                    top: -30px; 
                    right: -30px; 
                    width: 200px; 
                    height: 100px; 
                    border-top: 5px solid #000; 
                    border-right: 5px solid #000;">
                </div>

                {{-- Elbow Bottom Left --}}
                <div style="
                    position: absolute;
                    bottom: -30px; 
                    left: -30px; 
                    width: 200px; 
                    height: 100px; 
                    border-bottom: 5px solid #000; 
                    border-left: 5px solid #000;">
                </div>


                {{-- Heading  --}}
                <h2 class="mb-4 text-center" style="font-size: 48px; font-family: Inter; font-weight: 800">Login</h2>
               
                {{-- Login Input Field --}}
                <div class="mb-3">
                    <label for="login" class="text-md-end mb-2" style="font-weight: 500; font-family: Inter;">{{ __('Username or Email') }}</label>
                    <div>
                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" placeholder="Enter username or email" style="font-weight: 200; font-family: Inter" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>

                        @error('login')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="mb-3">
                    <label for="password" class="text-md-end mb-2" style="font-weight: 500; font-family: Inter;">{{ __('Password') }}</label>

                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" style="font-weight: 200; font-family: Inter" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                

                {{-- Submit Button --}}
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark" style="width: 148px; height: 58px; font-weight: bold; font-size: 24px; border-radius: 10px;">Login</button>
                </div>
                
                <div class="d-flex justify-content-center mt-2" style="font-weight: bold; font-size: 3vh">
                    <p class="m-0">or</p>
                </div>

                {{-- Third Party Apps Login Dummy --}}
                <div class="d-flex justify-content-center mt-0">

                    <a href="#" class="me-3">
                        <i class="bi bi-instagram" style="font-size: 2rem;"></i>
                    </a>

                    <a href="#" class="me-3">
                        <i class="bi bi-twitter" style="font-size: 2rem;"></i>
                    </a>

                    <a href="#" class="me-3">
                        <i class="bi bi-google" style="font-size: 2rem;"></i>
                    </a>

                    <a href="#">
                        <i class="bi bi-facebook" style="font-size: 2rem;"></i>
                    </a>

                </div>

                {{-- Quicklink Register --}}
                <div class="d-flex justify-content-center mt-2" style="font-weight: bold; font-size: 2vh; font-style: italic">
                    <p class="m-0">Don't have any account?<a href="/register" style="color: #B17457; text-decoration: none"> Register here</a></p>
                </div>
             
            </form>

            
        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

@include('layouts.footer')
</html>








