<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; //Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id'; // Mendefinisikan primary key dari tabel yang digunakan.

    /**
     * 
     * 
     *  @var array
    */
    
    // ============ jobsheet 4 ===================
    // protected $fillable = ['level_id', 'username', 'nama', 'password'];
    protected $fillable = ['level_id', 'username', 'nama']; //pada praktikum 2.1 terdapat error dibagian ini yang akan berpengaruh pada UserController, 
                                                            //jadi diberikan solusi pada variable fillable, dengan menambahkan 'password' didalamnya.
}