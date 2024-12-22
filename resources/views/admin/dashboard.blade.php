<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
    <title>Admin Page</title>
</head>
<body>
    @include('layouts.navbar')
    
    {{-- <a href="/books">View Books</a><br>
    <a href="/books/create">Add new Books</a><br>
    <a href="/books/delete">Delete a Books</a><br>
    <a href="/newgenre">Add New Genre</a> --}}
    {{-- <a href="/books/update">Update Books</a><br> --}}

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            {{ session('success') }}
            <button type="button" class="btn-close me-3" data-bs-dismiss="alert" aria-label="Close" ></button>
        </div>
    @endif

    <div style="margin: 50px"></div>
    <div class="container-fluid">
        <div class="row">
          <!-- Sidebar -->
          <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
              <ul class="nav flex-column">
                <div class="my-3">
                  <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
                </div>
                <li class="nav-item">
                  <a class="nav-link" href="/books">
                    Manage Books
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/admin/usermanagement">
                    Manage Users
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('genre.index') }}">
                     Manage Genre
                    </a>
                  </li>
              </ul>
            </div>
          </nav>
      
          <!-- Main Content -->
          <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
            <h2>Welcome to the Admin Dashboard</h2>
            <div class="row">
              <!-- Quick Stats -->
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title">Total Books</h5>
                    <p class="card-text">{{ count($book) }}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $userCount }}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title">Recent Activity</h5>
                    <p class="card-text">New book added: "{{ $recentActivity->book_title }}"</p>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Manage Books Section -->
            <h4>Manage Books</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Title</th>
                  <th scope="col">Author</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($book))
                    @foreach($book as $books)
                        <tr>
                            <td>{{ $books->id }}</td>
                            <td>{{ $books->book_title }}</td>
                            <td>{{ $books->book_author }}</td>
                            <td>
                               
                                <div class="d-flex space-between-content">
                                    <!-- Edit Button -->
                                    <form action="{{ route('books.edit', $books->id) }}" method="GET" class="me-2">
                                        <button type="submit" class="btn btn-warning btn-sm" value="{{ $books->id }}">
                                            Update
                                        </button>
                                    </form>
                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('books.destroy', $books->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                @endif
              </tbody>
            </table>
          </main>
        </div>
      </div>

      <div style="margin: 50px"></div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>


</html>