<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan daftar seluruh buku pada database
     */
    public function index()
    {
        //mengambil semua data dari database dan menampilkan sengan modal "book"
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Menampilkan form untuk menambahkan buku baru.
     */
    public function create()
    {
        //mengambil return view untuk membuat form buku baru
        return view('books.create');
    }

    /**
     * Menyimpan data buku baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input
        // berisikan form untuk mengisi dari database seperti judul, penerbit, dan jumlah_halaman
        $request->validate([
            'judul' => 'required|string',
            'penerbit' => 'required|string',
            'jumlah_halaman' => 'required|integer',
        ]);

        // Menggunakan mass assignment dengan hanya mengambil field-field yang diizinkan
        Book::create($request->only(['judul', 'penerbit', 'jumlah_halaman']));
        // mengarahkan ke halaman index buku dengan pesan sukses setelah buku dibuat
        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    /**
     * Menampilkan detail dari satu buku.
     */
    public function show($id)
    {
        //mengembalikan view 'books.show' dan mengirimkan data buku tertentu saja melalui route modal binding
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Menampilkan form untuk mengedit data buku.
     */
    public function edit($id)
    {
        ////mengembalikan view 'books.show' dan mengedit data buku tertentu saja dan mengirim data buku yang di edit
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    /**
     * Memperbarui data buku di dalam database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input yang diterima dari form edit, memastikan pada field tersebut sudah terisi.
        $request->validate([
            'judul' => 'required|string',
            'penerbit' => 'required|string',
            'jumlah_halaman' => 'required|integer',
        ]);

        //memperbarui data buku yang sudah ada dengan data yang baru saja di edit menggunakan mass assignment
        $book = Book::findOrFail($id);
        $book->update($request->only(['judul', 'penerbit', 'jumlah_halaman']));

        //mengarahkan ke halaman ke index dengan pesan "book updated successfully"
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Menghapus buku dari database.
     */
    public function destroy($id)
    {
        //menghapus data buku yang dipilih dari database
        $book = Book::findOrFail($id);
        $book->delete();

        //mengarahkan ke halaman ke index dengan pesan "book deleted successfully"
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
