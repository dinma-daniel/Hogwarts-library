<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library App - Book Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Example of a logout link/button -->
<form method="POST" action="{{ route('logout') }}">
    @csrf <!-- CSRF Protection -->
    <button type="submit">Logout</button>
</form>

        <h1>Book Catalog</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
    @foreach($books as $book)
        <tr>
            <td><a href="{{ route('books.show', ['id' => $book->id]) }}">
                    {{ $book->title }}
                </a></td>
            <td>{{ $book->author }}</td>
        </tr>
    @endforeach
</tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
