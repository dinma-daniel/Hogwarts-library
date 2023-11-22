<!-- manage_books.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Books</title>
</head>
<body>
    <h1>Manage Books</h1>

    <!-- Add Book Form -->
    <form action="{{ route('admin.add-book') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">
        
        <label for="author">Author:</label>
        <input type="text" id="author" name="author">

        <label for="author">description:</label>
        <input type="text" id="description" name="description">

        <!-- Add other necessary fields -->

        <button type="submit">Add Book</button>
    </form>

    <!-- Display Existing Books -->
    <h2>Existing Books</h2>
    <table>
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
</body>
</html>
