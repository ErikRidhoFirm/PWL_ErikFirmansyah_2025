<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
</head>
<body>
    <h1>Books</h1>
    @if(session('session')) 
        <p>{{ session('success') }}</p> {{--menampilkan pesan sukses ketika buku yang ditambahkan--}}
    @endif
    <a href="{{ route('books.create') }}">Add Book</a>
    <ul>
        @foreach ($books as $book)
            <li>
                {{--menampilkan data buku yang sudah ditambahakan menggunakan modal book--}}
                {{ $book->judul }} - {{ $book->penerbit }} - {{ $book->jumlah_halaman }}
                <a href="{{ route('books.show', $book) }}">
                <button type="submit">Detail</button> {{--tombol untuk menampilkan data buku--}}
                </a>
                <a href="{{ route('books.edit', $book) }}">
                <button type="submit">Edit</button></a> {{--tombol untuk mengedit data buku--}}
                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button> {{--tombol untuk menghapus data yang diinginkan--}}
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
