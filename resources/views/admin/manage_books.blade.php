<!-- manage_books.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Books</title>
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
      <p style="margin: 0 2rem;">Admin</p>
      <form method="POST" action="{{ route('logout') }}">
            @csrf <!-- CSRF Protection -->
            <button class="btn btn-danger" type="submit">Logout</button>
        </form>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h1>Manage Books</h1>
    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"class="btn btn-info" style="margin-bottom: 4rem;">Add Book</button>
    <!-- Add Book Form -->
    

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New Book</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('admin.add-book') }}" method="POST">
        @csrf
        <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input class="form-control type="text" id="title" name="title">
        </div>

        <div class="mb-3">
        <label for="author" class="form-label">Author:</label>
        <input class="form-control type="text" id="author" name="author">
        </div>

        <div class="mb-3">
        <label for="author" class="form-label">description:</label>
        <input class="form-control type="text" id="description" name="description">
        </div>
        <!-- Add other necessary fields -->

        <button type="submit" class="btn btn-success">Add Book</button>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <!-- Display Existing Books -->
    <!-- <h2>Existing Books</h2> -->
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>description</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->description }}</td>
                <!-- Display additional book details -->
            </tr>
            @endforeach
        </tbody>
    </table>

    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
