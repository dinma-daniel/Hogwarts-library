<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library App - Book Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Hogwarts Library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    
      </ul>
      @auth
            <!-- <p>Hello, {{ Auth::user()->name }}!</p> -->
            <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}" style="margin-right: 1rem;" class="btn btn-info">View Your Profile</a>
        @else
            <p>Please log in to view your profile.</p>
            <!-- Add login/register links or buttons -->
        @endauth
      <form method="POST" action="{{ route('logout') }}">
            @csrf <!-- CSRF Protection -->
            <button class="btn btn-info" type="submit">Logout</button>
        </form>
    </div>
  </div>
</nav>
<div class="container mt-5">
<h1>Book Catalog</h1>
        @auth
            <p>Hello, {{ Auth::user()->name }}!</p>
            <!-- <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}">View Your Profile</a> -->
        @else
            <p>Please log in to view your profile.</p>
            <!-- Add login/register links or buttons -->
        @endauth

        
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td><a href="{{ route('books.show', ['id' => $book->id]) }}">
                                {{ $book->title }}
                            </a></td>
                        <td>{{ $book->author }}</td>
                        <td>
                            <!-- Borrow Book button -->
                            @auth
                                <form method="POST" action="{{ route('books.borrow', ['bookId' => $book->id]) }}">
                                    @csrf <!-- CSRF Protection -->
                                    <button type="submit" class="btn btn-info">Borrow Book</button>
                                </form>
                            @else
                                <!-- Show login prompt -->
                                <p>Please log in to borrow</p>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
