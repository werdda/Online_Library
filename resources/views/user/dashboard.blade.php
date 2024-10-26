<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>User Page</title>
</head>
<body>
    <nav class="sticky-top navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand text-white" href="#">Online Library</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
          </div>
        </div>
      </nav>
    
    <h1 class="pt-5 text-center">Welcome to User Page</h1>

    <br>

    
    
    <div class="d-flex justify-content-center">
      <form action = {{ route('user.search') }} method="GET" class=" d-flex w-50" role="search">
        <input class="form-control me-2" type="search" value="{{ old('query', $query ?? '') }}" name="query" placeholder="Search books" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
   
    <div class="m-5 d-inline-block border">

      <h5>Books Genres</h5>

        
        <form action="{{ route('user.dashboard') }}" method="GET" id="filter-form">

          @if (isset($genre))
            <ul>
              @foreach ($genre as $genres)
                <div>
                  <input type="checkbox" name="genres[]" value="{{ $genres->id }}">
                  <label>{{ $genres->book_genre }}</label>
                </div>
              @endforeach
            </ul>
          @endif

          <button type="submit" class="btn btn-outline-success">Filter</button>
        </form>
        
      

    </div>




    @if (isset($query) && !empty($query))

      <div class="alert alert-info alert-dismissable fade show" role="alert">
        Search results for: <strong>{{ $query }}</strong>
        <button onclick="window.location.href='{{ route('user.dashboard') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      @elseif (isset($books))

      <div class="alert alert-info alert-dismissable fade show" role="alert">
          Search results for: <strong>{{ $books->first()->genre->book_genre }}</strong>
          <button onclick="window.location.href='{{ route('user.dashboard') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
     
    @endif

    <br><br>
  
    @if (isset($books) && $books->isEmpty())
      <p>book not found.</p>
    
    @elseif (isset($books) && !$books->isEmpty())
      <ul>
        @foreach ($books as $book)
          <li>
            Book genre: {{ $book->genre->book_genre }} <br>
            {{ $book->book_title }} by {{ $book->book_author }} <br>
            published by {{ $book->publisher }}
          </li>
        @endforeach
      </ul>
    @endif


    <br><br>
    
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

