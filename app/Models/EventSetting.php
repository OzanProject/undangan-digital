<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSetting extends Model
{
    use HasFactory;

    /**
     * Daftar pilihan tema undangan.
     * Key = nama folder tema (themes/tema1, tema2, dst.)
     * Value = label yang tampil di dropdown admin.
     */
    public const THEMES = [
        'tema1' => 'Tema 1 – Biru Modern',
        'tema2' => 'Tema 2 – Hijau Elegan',
        'tema3' => 'Tema 3 – Gold Classic',
        'tema4' => 'Tema 4 – Dark Mode',
        'tema5' => 'Tema 5 – Minimalis Putih',
        'tema6' => 'Tema 6 – Ungu Lembut',
        'tema7' => 'Tema 7 – Pink Ceria',
        'tema8' => 'Tema 8 – Biru Toska',
        'tema9' => 'Tema 9 – Coklat Hangat',
        'tema10'=> 'Tema 10 – Custom',
    ];

    /**
     * Daftar kolom yang boleh diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        // Informasi Dasar
        'child_name',
        'parent_names',
        'turut_mengundang_ayah',
        'turut_mengundang_ibu',
        'event_date',
        
        // Lokasi
        'location_name',
        'location_address',
        'maps_iframe',
        
        // Media / Visual
        'hero_image',
        'child_photo',
        'logo_path',
        'theme',        // <- penting untuk dropdown tema
        'audio_path',
        
        // Data Bank 1
        'bank_name_1',
        'bank_acc_1',
        'bank_holder_1',
        
        // Data Bank 2
        'bank_name_2',
        'bank_acc_2',
        'bank_holder_2',
    ];

    /**
     * Casting tipe data otomatis.
     */
    protected $casts = [
        'event_date' => 'datetime',
    ];
}
