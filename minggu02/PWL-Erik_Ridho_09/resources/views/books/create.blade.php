<!DOCTYPE html>
<html>
    <head>
        <title>Add Book</title>
    </head>
    <body>
        <h1>Add Book</h1>
        <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <label for="judul">Judul: </label> {{--- form ini digunakan untuk mengisi Judul pada form buku ---}}
        <input type="text" name="judul" required>
        <br>
        <label for="penerbit">Penerbit: </label> {{-- form ini digunakan untuk mengisi Penerbit pada form buku--}}
        <input type="text" name="penerbit" required>
        <br>
        <label for="jumlah_halaman">Jumlah Halaman: </label> {{--form ini digunakan unutk mengisi Jumlah Halaman pada form buku--}}
        <input type="number" name="jumlah_halaman" required>
        <button type="submit">Add Book</button>
        </form>
        <a href="{{ route('books.index') }}">Back to List</a>
    </body>
</html>