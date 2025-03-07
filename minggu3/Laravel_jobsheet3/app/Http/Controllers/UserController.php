<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //coba akses model UserModel
        $user = USerModel::all(); // ambil semua data dari tabel m_user
        return view('user', ['data' => $user]);
    }
}
