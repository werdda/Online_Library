<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Support</title>
</head>
<body>
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
    <div class="container-fluid pt-5 pb-5">
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

    {{-- About Us Heading --}}
    <div class="container-fluid pt-5 pb-5" style="background-color: #FCFAEE;">
        <div class="row align-items-center justify-content-between">
          <!-- Icon and Heading Section -->
          <div class="col-auto d-flex">
            <!-- Heading -->
            <div class="ms-3 d-flex align-items-center">
                <h1 class=" text-black mb-0 text-center" style="font-size: 48px; line-height: 1; font-family: Inter; font-weight: 800">
                    About Us
                </h1>
            </div>
            <!-- Icon -->
            <div class="ms-4">
              <span class="material-symbols-outlined" style="font-size: 59px;">
                groups
              </span>
            </div>
            
          </div>
      
        </div>

        <div>
            <h4 class="mb-0 ms-3" style="font-weight: 500; font-size: 24px;">
                Welcome to Bookscape, a digital library that provides easy and quick access to thousands of books <br>
                across various genres for readers worldwide. We are committed to offering a comfortable, enjoyable, <br> 
                and educational reading experience through our user-friendly platform.
            </h4>
          </div>
        </div>
    </div>

    {{-- Our Mission Heading --}}
    <div class="container-fluid pt-5 pb-5" style="background-color: #FFFFFF;">
        <div class="row align-items-center justify-content-between">
          <!-- Icon and Heading Section -->
          <div class="col-auto d-flex">
            <!-- Heading -->
            <div class="ms-3 d-flex align-items-center">
                <h1 class=" text-black mb-0 text-center" style="font-size: 48px; line-height: 1; font-family: Inter; font-weight: 800">
                    Our Mission
                </h1>
            </div>
            <!-- Icon -->
            <div class="ms-4">
              <span class="material-symbols-outlined" style="font-size: 59px;">
                flag_circle
              </span>
            </div>
            
          </div>
      
        </div>

        <div>
            <h4 class="mb-0 ms-3" style="font-weight: 500; font-size: 24px;">
                At Bookscape, we believe that books have the power to change lives. Our mission is to spread the <br>
                love of reading and make books more accessible to anyone, anywhere. We strive to offer a diverse <br>
                collection, from fiction to non-fiction, academic books to classic literature, and a range of educational <br>
                materials that support personal growth and development.
            </h4>
          </div>
        </div>
    </div>

    {{-- Our Vision Heading --}}
    <div class="container-fluid pt-5 pb-5" style="background-color: #FCFAEE;;">
        <div class="row align-items-center justify-content-between">
          <!-- Icon and Heading Section -->
          <div class="col-auto d-flex">
            <!-- Heading -->
            <div class="ms-3 d-flex align-items-center">
                <h1 class=" text-black mb-0 text-center" style="font-size: 48px; line-height: 1; font-family: Inter; font-weight: 800">
                    Our Vision
                </h1>
            </div>
            <!-- Icon -->
            <div class="ms-4">
              <span class="material-symbols-outlined" style="font-size: 59px;">
                visibility
              </span>
            </div>
            
          </div>
      
        </div>

        <div>
            <h4 class="mb-0 ms-3" style="font-weight: 500; font-size: 24px;">
                We aim to become the leading digital library that connects readers with a world of books, unrestricted <br>
                by space and time. By continuously innovating, we hope to expand access to knowledge and literacy <br>
                for all people.
            </h4>
          </div>
        </div>
    </div>

    {{-- What We Offer Heading --}}
    <div class="container-fluid pt-5 pb-5" style="background-color: #FFFFFF;">
        <div class="row align-items-center justify-content-between">
          <!-- Icon and Heading Section -->
          <div class="col-auto d-flex">
            <!-- Heading -->
            <div class="ms-3 d-flex align-items-center">
                <h1 class=" text-black mb-0 text-center" style="font-size: 48px; line-height: 1; font-family: Inter; font-weight: 800">
                    What We Offer
                </h1>
            </div>
            <!-- Icon -->
            <div class="ms-4">
              <span class="material-symbols-outlined" style="font-size: 59px;">
                editor_choice
              </span>
            </div>
          </div>
        </div>

        <div>
            <h4 class="mb-0 ms-3" style="font-weight: 500; font-size: 24px;">
                <ul>
                    <li>
                        Unlimited Access: E-books that can be accessed anytime, anywhere with just an internet connection.
                    </li>
                    <li>
                        Extensive Collection: Thousands of books from a variety of genres, with a constantly updated selection to meet the needs of diverse readers.
                    </li>
                    <li>
                        Interactive Features: Readers can highlight their favorite pages, make personal notes, and share thoughts on the books they read with our community.
                    </li>
                    <li>
                        User-Friendly Experience: An intuitive and easy-to-navigate platform that helps readers find their favorite books quickly.
                    </li>
                </ul>
            </h4>
          </div>
        </div>
    </div>

    {{-- Contact Us Heading --}}
    <div class="container-fluid pt-5 pb-5" style="background-color: #FCFAEE;;">
        <div class="row align-items-center justify-content-between">
          <!-- Icon and Heading Section -->
          <div class="col-auto d-flex">
            <!-- Heading -->
            <div class="ms-3 d-flex align-items-center">
                <h1 class=" text-black mb-0 text-center" style="font-size: 48px; line-height: 1; font-family: Inter; font-weight: 800">
                    Contact Us
                </h1>
            </div>
            <!-- Icon -->
            <div class="ms-4">
              <span class="material-symbols-outlined" style="font-size: 59px;">
                forward_to_inbox
              </span>
            </div>
            
          </div>
      
        </div>

        <div>
            <h4 class="mb-0 ms-3" style="font-weight: 500; font-size: 24px;">
                If you have any questions or feedback, feel free to contact us via email at <a href="mailto: support@bookscape.com" style="color: orange">support@bookscape.com</a> <br>
                or visit our help center on our website for more information.
            </h4>
          </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
@include('layouts.footer')
</html>