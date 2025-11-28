<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    // -------------------------------------------------------
    // TAMBAHKAN BARIS INI (Solusi Error MassAssignment)
    // -------------------------------------------------------
    protected $guarded = []; 
    
    // Penjelasan: 
    // $guarded = []; artinya "Tidak ada kolom yang dijaga", 
    // jadi semua kolom (name, phone, slug, status) boleh diisi.
}