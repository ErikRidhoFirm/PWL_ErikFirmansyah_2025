<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book) }}" method="POST">
    @csrf
    @method('PUT')
     {{--form ini digunakan untuk mengedit data pada buku di database--}}
    <label for="Judul">Judul: </label> {{--digunakan untuk mengisikan data yang diedit menggunakan Judul--}}
    <input type="text" name="judul" value="{{ $book->judul}}" required>
    <br>
    <label for="Penerbit">Penerbit</label>{{--digunakan untuk mengisikan data yang diedit menggunakan Penerbit--}}
    <input type="text" name="penerbit" value="{{ $book->penerbit}}" required>
    <br>
    <label for="Penerbit">Jumlah Halaman</label>{{--digunakan untuk mengisikan data yang diedit menggunakan Jumlah Halaman--}}
    <input type="text" name="jumlah_halaman" value="{{ $book->jumlah_halaman}}" required>
    <br>
    <button type="submit">Update Book</button>
    </form>
    <a href="{{ route('books.index') }}">Back to List</a>
</body>
</html>