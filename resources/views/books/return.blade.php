<!DOCTYPE html>
<html>
<head>
    <title>{{ $book->title }}</title>
</head>
<body>
    <!-- return.blade.php -->
<form action="{{ route('return.book') }}" method="POST">
    @csrf
    <input type="hidden" name="borrow_id" value="{{ $borrow->id }}">
    <!-- Add other necessary fields or details -->
    <button type="submit">Return Book</button>
</form>

</body>
</html>
