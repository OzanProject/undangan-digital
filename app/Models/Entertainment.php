<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // Untuk Accessor
use Illuminate\Support\Facades\Storage; // Untuk hapus file

class Entertainment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'time', 'image'];

    /**
     * ----------------------------------------------------------------
     * 1. ACCESSOR: Jalan Pintas URL Gambar
     * ----------------------------------------------------------------
     * Ini membuat atribut virtual baru bernama 'image_url'.
     * Cara pakai di Blade: {{ $item->image_url }}
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Cek apakah kolom image ada isinya
                if (!empty($attributes['image'])) {
                    return asset('storage/' . $attributes['image']);
                }
                // Jika kosong, kembalikan null atau link gambar default
                return null; 
            }
        );
    }

    /**
     * ----------------------------------------------------------------
     * 2. MODEL EVENTS: Otomatis Bersih-bersih
     * ----------------------------------------------------------------
     * Fungsi ini jalan otomatis saat data dihapus/diupdate.
     */
    protected static function booted()
    {
        // Saat data akan dihapus (deleted)
        static::deleted(function ($entertainment) {
            if ($entertainment->image) {
                // Hapus file fisik dari folder storage
                if (Storage::disk('public')->exists($entertainment->image)) {
                    Storage::disk('public')->delete($entertainment->image);
                }
            }
        });
        
        // (Opsional) Saat data diupdate, jika gambar diganti, hapus yang lama?
        // Logic ini agak kompleks, biasanya tetap di controller lebih aman untuk update.
        // Tapi untuk DELETE, method di atas sangat powerful.
    }
}