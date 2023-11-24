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
            <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}" style="margin-right: 1rem;" class="btn btn-outline-info">View Your Profile</a>
        @else
            <p>Please log in to view your profile.</p>
            <!-- Add login/register links or buttons -->
        @endauth
      <form method="POST" action="{{ route('logout') }}">
            @csrf <!-- CSRF Protection -->
            <button class="btn btn-danger" type="submit">Logout</button>
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


        
<!-- Add a search input -->
<input type="text" id="searchInput" placeholder="Search by letter..." onkeyup="searchBooks()">

<div style="display: flex;" id="bookList">
                @foreach($books as $book)
                <div class="card" style="width: 18rem; margin-right: 2rem;">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <span> Title: <a href="{{ route('books.show', ['id' => $book->id]) }}">
                                {{ $book->title }}
                            </a></span>
                
                    <p class="card-text">Author: {{ $book->author }}</p>
                    @auth
                                <form method="POST" action="{{ route('books.borrow', ['bookId' => $book->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Borrow Book</button>
                                </form>
                            @else
                                <p>Please log in to borrow</p>
                            @endauth
                </div>
                </div>
                @endforeach

                </div>
<!-- 
            </tbody>
        </table> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        function searchBooks() {
            let query = document.getElementById('searchInput').value.toUpperCase();

            // Fetch books via AJAX and update the book list
            fetch(`/books/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    // Update the book list
                    displayBooks(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function displayBooks(books) {
            // Clear existing book list
            let bookList = document.getElementById('bookList');
            bookList.innerHTML = '';

            // Display fetched books
            books.forEach(book => {
                // Add book details to the bookList element
                let bookItem = document.createElement('div');
                bookItem.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${book.title}</h5>
                            <p class="card-text">Author: ${book.author}</p>
                            <!-- Add more book details as needed -->
                        </div>
                    </div>
                `;
                bookList.appendChild(bookItem);
            });
        }
    </script>

</body>
</html>
