<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome(){
        return 'Selamat Datang';
    }
    public function about(){
        return 'Nama saya Erik Ridho Firmansyah, NIM : 2341720031';
    }
    public function articles ($id){
            return 'Halaman artikel dengan ID '.$id;
        }
}