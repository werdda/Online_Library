<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" 
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=account_circle,arrow_forward_ios,bookmark_addbookmark_removebook_4_spark,editor_choice,flag_circle,forward_to_inbox,groups,search,visibility"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg fst-italic p-3" style="background-color: #D8DBBD; font-size: 23px; height: 136px; font-family: Inter; position: fixed; top: 0; left: 0; right: 0; z-index: 1000;">

          <a class="navbar-brand text-black mx-4" href="#">
            {{-- <img src="{{ asset('storage/images/logo_dummy_3.jpeg') }}" alt="logo" class="rounded-circle me-3 border" style="width: 40px; height: 40px; object-fit: cover;"> --}}
            <h1 style="font-weight: 800; font-style: normal; font-size: 48px; margin-right: 20px">BookScape</h1>
          </a>
          

          <div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>

          <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav">

              <li class="nav-item px-3 mx-3" style="font-style: normal; font-weight: 600; font-size: 26px;">
                <a class="nav-link active text-black" aria-current="page" href="/">Home</a>
              </li>

              <li class="nav-item px-3 mx-3" style="font-style: normal; font-weight: 600; font-size: 26px;">
                <a class="nav-link active text-black" aria-current="page" href="/categories">Categories</a>
              </li>

              
              <li class="nav-item px-3 mx-3" style="font-style: normal; font-weight: 600; font-size: 26px;">
                <a class="nav-link active text-black" aria-current="page" href="/user/favorites">Wishlist</a>
              </li>

          
              <li class="nav-item" style="font-style: normal; font-weight: 600; font-size: 26px; margin: 0 10px;">
                <a class="nav-link active text-black" aria-current="page" href="/support">Support</a>
              </li>
              
            </ul>
            
          </div>
          

          <div class="d-flex align-items-center mx-4">
            
            <span class="mx-4" style="font-size: 40px; font-family: sans-serif">|</span>
            @if(Auth::check())

              <a href="/user/profile">
                <img src="{{ Auth::user()->profile_img ?? asset('storage/images/placeholder_profile.png') }}" alt="profiler" class="rounded-circle me-3 border" style="width: 40px; height: 40px; object-fit: cover;">
              </a>
          
              @elseif (!Auth::check())
                <span class="material-symbols-outlined mx-4" style="font-size: 33px">
                  account_circle
                </span>
            @endif

            <div class="pr-3">
                @if(Auth::check())
                  <a href="#" class="text-black" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                    style="text-decoration: none; font-style: normal; font-weight: 600">
                    Logout 
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                 
                @elseif(!Auth::check())
                  <a href="/login" class="text-black" style="text-decoration: none; font-style: normal; font-weight: 600">Sign In</a>
                @endif
            </div>
          </div>
    </nav>

    <div style="height: 136px; padding-bottom: 136px"></div>
    
</body>
</html>