<!DOCTYPE html>
<html>
<head>
    <title>Detail Book</title> 
</head>
<body>
    <h1>Detail Book</h1>
    <p><strong>Judul:</strong> {{ $book->judul }}</p>
    <p><strong>Penerbit:</strong> {{ $book->penerbit }}</p>
    <p><strong>Jumlah Halaman:</strong> {{ $book->jumlah_halaman }}</p>
    <a href="{{ route('books.index') }}">Back to List</a>
    {{--menampilkan detail dari buku yang sudah ditambahkan di tambah buku--}}
</body>
</html>
