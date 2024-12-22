<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BookScape</title>
</head>

<body style="background-color: #FCFAEE;">

  @include('layouts.navbar')
  
  {{-- Condition Error Request Message  --}}
    
    @if ( session('error') )
      <div class="alert alert-danger d-flex justify-content-between align-items-center">
        {{ session('error') }}
        <button type="button" class="btn-close me-3" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif


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
          <form action="{{ route('user.search') }}" method="GET" class="d-flex" role="search" style="width: 811px;">
            <div class="input-group">
              {{-- <span class="input-group-text">
                <i class="bi bi-search"></i>
              </span> --}}
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

    {{-- Check if search query exists --}}
    @if (isset($query) && !empty($query))

      {{-- Search Results Section --}}
      <div class="container mt-4">
        <div class="d-flex">
          <h1>Search Results for: "{{ $query }}"</h1>
          <button onclick="window.location.href='{{ route('user.dashboard') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        @if($books->count())
          <div class="row">
            @foreach($books as $book)
              <div class="col-4 text-center">
                <img src="{{ $book->book_thumbnail }}" alt="Book Cover" class="img-fluid" style="width: 260px; height: 390px; border-radius: 15px; border: 3px solid #000;">
                <p class="mt-2">{{ $book->book_title }}</p>
              </div>
            @endforeach
          </div>
        @else
          <p>No results found for "{{ $query }}"</p>
        @endif
      </div>

    @else
      {{-- Recommendations Section --}}
      <div class="text-start ms-4">
        <h1 style="font-size: 48px; font-weight: 800; font-family: Inter">Our Recommendations</h1>
      </div>

      {{-- Carousel Container --}}
      <div id="recommendationsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

          @if (Auth::check() && isset($recommendedBooks) && $recommendedBooks->isNotEmpty())
            
            {{-- Split Books into Groups of 3 for Each Carousel Slide --}}
            @foreach ($recommendedBooks->chunk(3) as $bookChunk)
              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="d-flex justify-content-center">
                  
                  @foreach ($bookChunk as $book)
                    <div class="col-md-4 text-center position-relative">

                      {{-- Thumbnail and Bookmark Icon --}}
                      <div class="thumbnail-container position-relative mx-auto" style="width: 260px; height: 390px;">
                        
                        <a href="{{ route('book.desc', $book->id) }}">
                          <img src="{{ $book->book_thumbnail }}" alt="Book Cover" class="img-fluid" 
                          style="width: 100%; height: 100%; border-radius: 15px; border: 3px solid #000;">
                        </a>
                        

                        {{-- Bookmark Icon --}}
                        <span class="material-symbols-outlined position-absolute" 
                            style="top: 10px; right: 10px; z-index: 10; cursor: pointer; font-size: 32px; color: #fff; background: rgba(0, 0, 0, 0.5); padding: 5px; border-radius: 50%;"
                            data-book-id="{{ $book->id }}">
                            {{ in_array($book->id, $favorites) ? 'bookmark_remove' : 'bookmark_add' }}
                        </span>
                        
                      </div>
                      
                      {{-- Book Title --}}
                      <p class="mt-2">{{ $book->book_title }}</p>
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach
          
          @else
            
            {{-- Split Books into Groups of 3 for Each Carousel Slide --}}
            @foreach ($defaultview->chunk(3) as $bookChunk)
              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="d-flex justify-content-center">
                
                  @foreach ($bookChunk as $book)
                    <div class="col-md-4 text-center position-relative">

                      {{-- Thumbnail and Bookmark Icon --}}
                      <div class="thumbnail-container position-relative mx-auto" style="width: 260px; height: 390px;">
                      
                        <a href="{{ route('book.desc', $book->id) }}">
                          <img src="{{ $book->book_thumbnail }}" alt="Book Cover" class="img-fluid" 
                          style="width: 100%; height: 100%; border-radius: 15px; border: 3px solid #000;">
                        </a>
                      

                        {{-- Bookmark Icon --}}
                        <span class="material-symbols-outlined position-absolute" 
                            style="top: 10px; right: 10px; z-index: 10; cursor: pointer; font-size: 32px; color: #fff; background: rgba(0, 0, 0, 0.5); padding: 5px; border-radius: 50%;"
                            data-book-id="{{ $book->id }}">
                            {{ in_array($book->id, $favorites) ? 'bookmark_remove' : 'bookmark_add' }}
                        </span>
                      
                      </div>
                    
                      {{-- Book Title --}}
                      <p class="mt-2">{{ $book->book_title }}</p>
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach

          @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#recommendationsCarousel" data-bs-slide="prev" style="position: absolute; top: 45%; transform: translateY(-50%); left: 0;">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#recommendationsCarousel" data-bs-slide="next" style="position: absolute; top: 45%; transform: translateY(-50%); right: 0;">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      {{-- Explore All Link For Recommendation Section --}}
      <div class="row align-items-center justify-content-end mt-3 me-4 mb-3">
        <div class="col-auto d-flex align-items-center">

          {{-- Link Text --}}
          <div class="text-end">
            <a href="/books" class="text-decoration-none text-black" style="font-size: 24px; font-weight: 700;">
              Explore all 
            </a>
          </div>

          {{-- Icon --}}
          <div class="ms-2 d-flex align-items-center">
            <span class="material-symbols-outlined" style="font-size: 24px;">
              arrow_forward_ios
            </span>
          </div>

        </div>
      </div>

      {{-- Best Seller Section --}}
      <div class="pt-5" style="background-color: #FFFFFF">
        <div class="text-start ms-4">
          <h1 style="font-size: 48px; font-weight: 800; font-family: Inter">Best Seller</h1>
        </div>
  
        {{-- Carousel Container --}}
        <div id="BestSellerCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            {{-- Split Books into Groups of 3 for Each Carousel Slide --}}
            @foreach ($viewbooks->chunk(3) as $bookChunk)
              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="d-flex justify-content-center">
                  @foreach ($bookChunk as $book)
                    <div class="col-4 d-flex flex-column align-items-center">

                      <div class="text-wrapper" style="width: 260px;">
                        <img src="{{ $book->book_thumbnail }}" alt="Book Cover" class="img-fluid" 
                          style="width: 260px; height: 390px; border-radius: 15px; border: 3px solid #000;">
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
                        <form action="{{ route('book.desc', $book->id) }}" method="GET">
                          <button type="submit" class="btn btn-dark" style="width: 71px; height: 38px; border-radius: 10px;" value="{{ $book->id }}">
                            <p class="text-white" style="font-family: Inter; font-size: 15px; font-weight: 700">
                              Read
                            </p>
                          </button>
                        </form>
                      </div>
                      
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#BestSellerCarousel" data-bs-slide="prev" style="position: absolute; top: 40%; transform: translateY(-50%); left: 0;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#BestSellerCarousel" data-bs-slide="next" style="position: absolute; top: 40%; transform: translateY(-50%); right: 0;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      
      {{-- Explore All Link For Best Seller Section --}}
      <div style="background-color: #FFFFFF; padding: 10px; padding-inline-end: 0px">
        <div class="row align-items-center justify-content-end mt-3 me-4 mb-3" style="background-color: #FFFFFF;">
          <div class="col-auto d-flex align-items-center">
            
            {{-- Link Text --}}
            <div class="text-end">
              <a href="/bestseller" class="text-decoration-none text-black" style="font-size: 24px; font-weight: 700;">
                Explore all 
              </a>
            </div>
            
            {{-- Icon --}}
            <div class="ms-2 d-flex align-items-center">
              <span class="material-symbols-outlined" style="font-size: 24px;">
                arrow_forward_ios
              </span>
            </div>
  
          </div>
        </div>
      </div>
      
    @endif


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    {{-- Add-On Script for Thumbnail Bookmark Functionality --}}
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        
        document.querySelectorAll(".material-symbols-outlined").forEach(icon => {
            icon.addEventListener("click", function () {
                const bookId = this.getAttribute("data-book-id");
                toggleBookmark(bookId, this);
            });
        });
      });
    
      function toggleBookmark(bookId, iconElement) {

        fetch(`/user/${bookId}/favourite`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
    
          const contentType = response.headers.get("Content-Type");
          if (contentType && contentType.includes("application/json")) {
            return response.json();
          } else {
            
            throw new Error("You Must Be Logged In To Manage Favorites.");
          }
        })
        .then(data => {
          if (data.status === 'added') {
            iconElement.innerText = 'bookmark_remove';
          } else if (data.status === 'removed') {
            iconElement.innerText = 'bookmark_add';
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert(error.message);  // Show the error message in an alert
        });
      }
    </script>


</body>

@include('layouts.footer')

</html>




