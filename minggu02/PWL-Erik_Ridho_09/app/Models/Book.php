<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'penerbit', 'jumlah_halaman'];
    //array yang menentukan atribut atau kolom mana saja yang boleh diisi
}
