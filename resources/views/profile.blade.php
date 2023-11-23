<!-- profile.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>User Profile - {{ $user->name }}</title>
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
      <form method="POST" action="{{ route('logout') }}">
            @csrf <!-- CSRF Protection -->
            <button class="btn btn-danger" type="submit">Logout</button>
        </form>
    </div>
  </div>
</nav>

<div style="margin: 5rem auto; width: 70%;">
<!-- <h2 >User Profile: {{ $user->name }}</h2> -->
<h2>List of borrowed books by {{ $user->name }}</h2>

<br>
@if ($borrowedBooks->isEmpty())
    <p>None borrowed yet!</p>
        @else
<table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Borrowed Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($borrowedBooks as $borrow)
                    <tr>
                        <td>{{ $borrow->book->title }}</td>
                        <td>{{ $borrow->borrow_date }}</td>
                        <td>{{ $borrow->due_date }}</td>
                        
                    </tr>
                @endforeach 

                </tbody>
        </table> 
        @endif



<!-- @if ($borrowedBooks->isEmpty())
    <p>None borrowed yet!</p>
        @else
            <ul>
            @foreach ($borrowedBooks as $borrow)
                <p>Book Title: {{ $borrow->book->title }}</p>
                <p>Borrowed Date: {{ $borrow->borrow_date }}</p>
                <p>Return Date: {{ $borrow->return_date }}</p>
        @endforeach
    </ul>
@endif -->
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
