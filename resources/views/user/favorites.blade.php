<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>{{ Auth::user()->name }} Favorite Books</title>
</head>
<body>

    @include('layouts.navbar')


    @if ( session('error') )
      <div class="alert alert-danger d-flex justify-content-between align-items-center">
        {{ session('error') }}
        <button type="button" class="btn-close me-3" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    
    @if(Auth::user() && Auth::user()->isAdmin())

      <button class="btn btn-primary position-fixed top-136px end-0 m-3" style="z-index: 1050; top: 136px">
        <i class="bi bi-book"></i> <!-- Bootstrap icon book -->
      </button>

    @endif

   
    {{-- Find Your Books Heading --}}
    <div class="container-fluid pt-5">
        <div class="row align-items-center justify-content-between">
          <!-- Icon and Heading Section -->
          <div class="col-auto d-flex">
            <!-- Icon -->
            <div class="ms-3 d-flex align-items-center">
              <span class="material-symbols-outlined" style="font-size: 69px;">
                book_4_spark
              </span>
            </div>
            <!-- Heading -->
            <div class="ms-4 text-start">
              <h1 class=" text-black mb-0 text-center" style="font-size: 48px; line-height: 1; font-family: Inter; font-weight: 800">
                FIND YOUR <br> BOOKS
              </h1>
            </div>
          </div>
      
          <!-- Centered Description -->
          <div class="col ms-5 px-5 justify-content-center">
            <h4 class="mb-0" style="font-weight: 700; font-size: 24px;">
              Explore a vast collection of books and resources with <br> our online library, offering easy access to knowledge <br> anytime, anywhere.
            </h4>
          </div>
        </div>
    </div>

    {{-- Search Bar Section--}} 
    <div class="container-fluid mt-4 mb-4">
        <div class="row justify-content-center">
          <div class="col-auto">
            <form action="{{ route('search.favorites') }}" method="GET" class="d-flex" role="search" style="width: 811px;">
              <div class="input-group">
                
                <input class="form-control me-0" style="font-family: Inter; font-weight: 700; border-radius: 5px 5pxpx 5px 5px; border: 0.2px solid rgb(202, 202, 202); border-right: 0;" type="search" value="{{ old('query', $query ?? '') }}" name="query" placeholder="Type something here..." aria-label="Search">
                <style>
                  .form-control::placeholder {
                    opacity: 0.50; /* Adjust the opacity to 25% */
                  }
                </style>
                <button type="submit" style="padding: 10px; border-radius: 0 5px 5px 0; background: #FFFFFF; border: 0.2px solid rgb(202, 202, 202); border-left: 0;">
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
    </div>


    @if(!isset($book_data))
        <h1 style="font-family: Inter; font-weight: 800; padding-top: 50px; padding-left: 72px">My Collections</h1>

    @elseif(isset($book_data))

        <div class="container mt-4">
            <div class="d-flex">
                <h1>Search Results for: "{{ $query }}"</h1>
                <button onclick="window.location.href='{{ route('user.favorites') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        
        <h1 style="font-family: Inter; font-weight: 800; padding-top: 50px; padding-left: 72px">My Collections</h1>
        
    @endif
    
    {{-- Display Search Result if Not Empty --}}
    @if(isset($query) && isset($book_data) && !$book_data->isEmpty())

        {{-- Books Display Card --}}
        <div class="container text-center">
            <div class="row mt-4">
                @foreach ($book_data as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <img src="{{ $book->book_thumbnail }}" alt="Book Cover" class="img-fluid" style="width: 260px; height: 390px; border-radius: 15px; border: 3px solid #000;">
                                <h5 class="card-title">{{ $book->book_title }}</h5>
                                <p class="card-text">Author: {{ $book->book_author }}</p>
                                <p class="card-text">Genre: {{ $book->genre->book_genre }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 d-flex justify-content-end me-3">
                  {{ $book_data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    
    @elseif(isset($favourites))
        {{-- Books Display Card --}}
        <div class="container text-center">
            <div class="row mt-4">
                @foreach ($favourites as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <img src="{{ $book->book_thumbnail }}" alt="Book Cover" class="img-fluid" style="width: 260px; height: 390px; border-radius: 15px; border: 3px solid #000;">
                                <h5 class="card-title">{{ $book->book_title }}</h5>
                                <p class="card-text">Author: {{ $book->book_author }}</p>
                                <p class="card-text">Genre: {{ $book->genre->book_genre }}</p>
                                <form action="{{ route('book.desc', $book->id) }}" method="GET">
                                    <button type="submit" class="btn btn-dark" style="width: 71px; height: 38px; border-radius: 10px;" value="{{ $book->id }}">
                                      <p class="text-white" style="font-family: Inter; font-size: 15px; font-weight: 700">
                                        Read
                                      </p>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    

    @elseif(isset($query) && $book_data->isEmpty())
        
      <div class="container mt-4">
        <div>
            <p class="text-center text-danger mt-4">No books found for {{ $query }}.</p>
        </div>
      </div>
        
    @endif
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

@include('layouts.footer')
</html>