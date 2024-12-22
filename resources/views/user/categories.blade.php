<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Categories</title>
</head>
<body>
  @include('layouts.navbar')

  {{-- Display Session Error Message --}}
  @if ( session('error') )
    <div class="alert alert-danger d-flex justify-content-between align-items-center">
      {{ session('error') }}
      <button type="button" class="btn-close me-3" data-bs-dismiss="alert" aria-label="Close" onclick="window.location.href='/categories';"></button>
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
  
  @if(isset($books) && !$books->isEmpty())
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

  @elseif(!isset($books) && !isset($categorybooks))
    <h1 style="font-family: Inter; font-weight: 800; padding-top: 50px; padding-left: 72px">Categories</h1>

  @elseif(isset($categorybooks))

    <h1 style="font-family: Inter; font-weight: 800; padding-top: 50px; padding-left: 72px">{{ $categorybooks->first()->genre->book_genre }}</h1>

  @elseif(isset($selected))
    <h1 style="font-family: Inter; font-weight: 800; padding-top: 50px; padding-left: 72px">Categories</h1>

  @endif

  <div class="container text-center" style="padding-top: 51px">
      
    {{-- Display books if available --}}
    @if (isset($books) && !$books->isEmpty())
      {{-- Search Bar Section--}}
      <div class="container-fluid mt-4 mb-4">
        <div class="row justify-content-center">
          <div class="col-auto">
            <form action="{{ route('search.category', $books->first()->genre_id) }}" method="GET" class="d-flex" role="search" style="width: 811px;">
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

        {{-- Books Display Card --}}
      <div class="row mt-4">
            {{-- <h3 class="mb-4">Books</h3> --}}
            <div class="d-flex">
              <h1>{{ $books->first()->genre->book_genre }}</h1>
              <button onclick="window.location.href='{{ route('user.categories') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @foreach ($books as $book)
                <div class="col-md-4 mb-3">
                    <div class="card shadow">
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
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

           
            <div class="mt-4 d-flex justify-content-end me-3">
              {{ $books->links('pagination::bootstrap-5') }}
            </div>
          
      </div>

    {{-- Display Message If Books is Empty with The Genre --}}
    @elseif (isset($books) && isset($selected))

      <div class="container-fluid mt-4 mb-4">
        <div class="row justify-content-center">
          <div class="col-auto" style="position: absolute; top: 186px; right: 72px; margin-top: 5px;">
            <form action="{{ route('categoryname.search') }}" method="GET" class="d-flex" role="search" style="width: 532px;">

              @if(session('error'))
                <div class="input-group pt-5">
              
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
              @else
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
              @endif
              
            </form>
          </div>
        </div>
      </div>
      
      <div class="d-flex">
        <h1>Search Results for: "{{ $selected }}"</h1>
        <button onclick="window.location.href='{{ route('user.categories') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <div>
          <p class="text-danger mt-4">No books found for the selected genres.</p>
      </div>

    @elseif (isset($categorybooks) && !$categorybooks->isEmpty() && isset($query))
    
    {{-- If There's a query and the categorybooks is not Null --}}
    <div class="row mt-4">
      {{-- <h3 class="mb-4">Books</h3> --}}
      <div class="d-flex">
        <h1>Search Results for: "{{ $query }}"</h1>
        <button onclick="window.location.href='{{ route('user.categories') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @foreach ($categorybooks as $book)
          <div class="col-md-4 mb-3">
              <div class="card shadow">
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
                    </div>
                </div>
              </div>
          </div>
      @endforeach

      <div class="mt-4 d-flex justify-content-end me-3">
        {{ $categorybooks->links('pagination::bootstrap-5') }}
      </div>

    </div>


    {{-- If There's No Search by Categories Request Display All Genres --}} 
    @else

      {{-- Search The Category Available --}}
      <div class="container-fluid mt-4 mb-4">
        <div class="row justify-content-center">
          <div class="col-auto" style="position: absolute; top: 186px; right: 72px; margin-top: 5px;">
            <form action="{{ route('categoryname.search') }}" method="GET" class="d-flex" role="search" style="width: 532px;">

              @if(session('error'))
                <div class="input-group pt-5">
              
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
              @else
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
              @endif
              
            </form>
          </div>
        </div>
      </div>

      @if(isset($query) && isset($categoryname) && !$categoryname->isEmpty())

        {{-- Show Result For Genre With That Name --}}
        <div class="d-flex">
          <h1>Search Results for: "{{ $query }}"</h1>
          <button onclick="window.location.href='{{ route('user.categories') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <form action="{{ route('user.categories') }}" method="GET">
          
            <div class="row">
              @foreach ($categoryname as $genres)
                <div class="col-4 mb-3">
                
                  <button type="submit" class="btn btn-dark w-50 rounded-4" name="genres[]" value="{{ $genres->id }}" style="height: 70px;">
                    <h4>{{ $genres->book_genre }}</h4>
                  </button>
              
                </div>
              @endforeach
            </div>
          
        </form>   



      @elseif(isset($categoryname) && $categoryname->isEmpty())

        {{-- Show If There's No Genre With That Name --}}
        <div class="d-flex">
          <h1>Search Results for: "{{ $query }}"</h1>
          <button onclick="window.location.href='{{ route('user.categories') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div>
          <p class="text-danger mt-4">No genres with that name.</p>
        </div>

      @else
        {{-- Loop For Every Category Available --}}
        <form action="{{ route('user.categories') }}" method="GET">
          @if (isset($genre))

            {{-- Button Setting for When There's an Odd number of Genre --}}
            @if(count($genre) != 1 && count($genre) % 2 != 0)
              <div class="row">
                @foreach ($genre as $genres)
                  <div class="col-{{ max(12 / min(count($genre), 4), 3) }} mb-3 d-flex justify-content-center">
                
                    <button type="submit" class="btn btn-dark w-75 rounded-4 d-flex align-items-center justify-content-center" 
                      name="genres[]" value="{{ $genres->id }}" 
                      style="height: {{ 100 - count($genre) * 1.5 }}px; transition: all 0.3s ease;">
                      <h4 class="m-0 text-center">{{ $genres->book_genre }}</h4>
                    </button>
              
                  </div>
                @endforeach
              </div>

            {{-- Button Setting for When There's Only One Genre --}}
            @elseif(count($genre) == 1)
              <div class="row justify-content-center">
                @foreach ($genre as $genres)
                  <div class="col-{{ max(12 / count($genre), 4) }} mb-3 d-flex justify-content-center">
              
                    <button type="submit" class="btn btn-dark w-50 rounded-4 d-flex align-items-center justify-content-center" 
                      name="genres[]" value="{{ $genres->id }}" 
                      style="height: {{ 100 - count($genre) * 1.5 }}px; transition: all 0.3s ease;">
                      <h4 class="m-0 text-center">{{ $genres->book_genre }}</h4>
                    </button>
            
                  </div>
                @endforeach
            </div>

            {{-- Button Setting If There's an Even Numbered of Genre --}}
            @else
              <div class="row">
                @foreach ($genre as $genres)
                  <div class="col-{{ max(12 / min(count($genre), 4), 3) }} mb-3 d-flex justify-content-center">
              
                    <button type="submit" class="btn btn-dark w-75 rounded-4 d-flex align-items-center justify-content-center" 
                      name="genres[]" value="{{ $genres->id }}" 
                      style="height: {{ 100 - count($genre) * 1.5 }}px; transition: all 0.3s ease;">
                      <h4 class="m-0 text-center">{{ $genres->book_genre }}</h4>
                    </button>
            
                  </div>
                @endforeach
              </div>
            @endif
            
          @endif
        </form>   

      @endif
      
      
    @endif
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
  @include('layouts.footer')
</html>