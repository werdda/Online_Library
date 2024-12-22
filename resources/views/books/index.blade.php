<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Welcome Page</title>
</head>
<body>

    @include('layouts.navbar')
    
    {{-- Display Session Error Message --}}
    @if ( session('error') )
        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            {{ session('error') }}
            <button type="button" class="btn-close me-3" data-bs-dismiss="alert" aria-label="Close" ></button>
        </div>
    @endif

    {{-- Check If User is Logged In and is an Admin to Which Display a Button to Admin Dashboard --}}
    @if(Auth::user() && Auth::user()->isAdmin())

        <a href="/admin/dashboard">
            <button class="btn btn-primary position-fixed top-136px end-0 m-3" style="z-index: 1050; top: 136px">
            <i class="bi bi-book"></i> <!-- Bootstrap icon book -->
            </button>
        </a>

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
            <form action="{{ route('index.search') }}" method="GET" class="d-flex" role="search" style="width: 811px;">
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

    @if(isset($query) && isset($books_data) && !$books_data->isEmpty())
       
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 d-flex">
                    <h1>Search Results for: "{{ $query }}"</h1>
                    <button onclick="window.location.href='{{ route('books.index') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
       
        <div class="container mt-4">
            <div class="row">
                @foreach ($books_data as $book)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                       
                            <div class="card-body d-flex flex-column align-items-center" style="position: relative;">
                                <img src="{{ $book->book_thumbnail }}" alt="Book Cover" 
                                class="img-fluid" style="width: 260px; height: 390px; border-radius: 15px; border: 3px solid #000;">
                               
                                <div class="text-wrapper d-flex justify-content-between align-items-end" 
                                  style="width: 260px; bottom: 10px; left: 10px;">
                                  <div style="max-width: 70%; text-align: left;">
                                      <p class="mt-2 mb-0 p-0" style="font-size: 15px; font-family: Inter; font-weight: 900;">{{ $book->book_title }}</p>
                                      <p class="mt-0 mb-0 p-0" style="font-size: 15px; font-family: Inter; font-weight: 500;">{{ $book->book_author }}</p>
                                      <p class="mt-0 mb-0 p-0" style="font-size: 15px">
                                        @for ($i = 1; $i <= 5; $i++)
                                          @if ($i <= floor($book->averageRating()))
                                            <i class="bi bi-star-fill" style="color: gold"></i>
                                          @elseif ($i <= ceil($book->averageRating()) && $book->averageRating() > floor($book->averageRating()))
                                            <i class="bi bi-star-half" style="color: gold"></i>
                                          @else
                                            <i class="bi bi-star"></i>
                                          @endif
                                        @endfor
                                      </p>
                                  </div>
                                  <form action="{{ route('book.desc', $book->id) }}" method="GET" style="margin-left: auto; transform: translateY(-30px);">
                                    <button type="submit" class="btn btn-dark" style="width: 71px; height: 38px; border-radius: 10px;" value="{{ $book->id }}">
                                      <p class="text-white" style="font-family: Inter; font-size: 15px; font-weight: 700">
                                        Read
                                      </p>
                                    </button>
                                  </form>
                                    @if(Auth::user() && Auth::user()->isAdmin())
                                        <form action="{{ route('books.edit', $book->id) }}" method="GET" style="margin-left: auto;">
                                            <button type="submit" class="btn btn-dark" style="width: 80px; height: 38px; border-radius: 10px;" value="{{ $book->id }}">
                                                <p class="text-white" style="font-family: Inter; font-size: 15px; font-weight: 700">
                                                    Update
                                                </p>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 d-flex justify-content-end me-3">
                    {{ $books_data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    @elseif(isset($query) && isset($books_data) && $books_data->isEmpty())
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 d-flex">
                    <h1>Search Results for: "{{ $query }}"</h1>
                    <button onclick="window.location.href='{{ route('books.index') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <div class="text-center">
            <p class="text-danger mt-4">No books found for {{ $query }}.</p>
        </div>

    @else

        <div class="container mt-4">
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                       
                            <div class="card-body d-flex flex-column align-items-center" style="position: relative; height: 500px;">
                                <img src="{{ $book->book_thumbnail }}" alt="Book Cover" 
                                class="img-fluid" style="width: 260px; height: 390px; border-radius: 15px; border: 3px solid #000;">
                               
                                <div class="text-wrapper d-flex justify-content-between align-items-end" 
                                  style="width: 260px; bottom: 10px; left: 10px;">
                                  <div style="max-width: 70%; text-align: left;">
                                      <p class="mt-2 mb-0 p-0" style="font-size: 15px; font-family: Inter; font-weight: 900;">{{ $book->book_title }}</p>
                                      <p class="mt-0 mb-0 p-0" style="font-size: 15px; font-family: Inter; font-weight: 500;">{{ $book->book_author }}</p>
                                      <p class="mt-0 mb-0 p-0" style="font-size: 15px">
                                        @for ($i = 1; $i <= 5; $i++)
                                          @if ($i <= floor($book->averageRating()))
                                            <i class="bi bi-star-fill" style="color: gold"></i>
                                          @elseif ($i <= ceil($book->averageRating()) && $book->averageRating() > floor($book->averageRating()))
                                            <i class="bi bi-star-half" style="color: gold"></i>
                                          @else
                                            <i class="bi bi-star"></i>
                                          @endif
                                        @endfor
                                      </p>
                                  </div>
                                  
                                    <div class="d-flex flex-column align-items-end" style="position: absolute; bottom: 0; right: 47px; transform: translateY(-5px);">
                                        <form action="{{ route('book.desc', $book->id) }}" method="GET">
                                            <button type="submit" class="btn btn-dark mb-2" 
                                                    style="width: 71px; height: 38px; border-radius: 10px;" value="{{ $book->id }}">
                                                <p class="text-white" style="font-family: Inter; font-size: 15px; font-weight: 700">
                                                    Read
                                                </p>
                                            </button>
                                        </form>
                                    
                                        @if(Auth::user() && Auth::user()->isAdmin())
                                            <form action="{{ route('books.edit', $book->id) }}" method="GET">
                                                <button type="submit" class="btn btn-dark" 
                                                        style="width: 80px; height: 38px; border-radius: 10px;" value="{{ $book->id }}">
                                                    <p class="text-white" style="font-family: Inter; font-size: 15px; font-weight: 700">
                                                        Update
                                                    </p>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-4 d-flex justify-content-end me-3">
                    {{ $books->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

    @include('layouts.footer')
</html>