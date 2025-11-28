<?php

namespace App\Imports;

use App\Models\Guest;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class GuestsImport implements ToModel, WithHeadingRow
{
    /**
     * Memproses setiap baris untuk disimpan ke database
     */
    public function model(array $row)
    {
        // Cek apakah data kunci ada
        if (!isset($row['nama']) || !isset($row['nomor_whatsapp_awalan_62'])) {
            return null; // Lewati baris jika data tidak lengkap
        }

        // Mapping Kolom
        $name = trim($row['nama']);
        $phone = trim($row['nomor_whatsapp_awalan_62']);
        $status = strtolower(trim($row['status_hadirtidak_hadirpending']));
        
        // Atur status default jika tidak valid
        if (!in_array($status, ['hadir', 'tidak_hadir'])) {
            $status = 'pending';
        }

        // Generate Slug
        $slug = Str::slug($name) . '-' . Str::lower(Str::random(5));

        return new Guest([
            'name' => $name,
            'slug' => $slug,
            'phone' => $phone,
            'status' => $status,
        ]);
    }

    /**
     * Atur baris header untuk dilewati (baris 1)
     */
    public function headingRow(): int
    {
        return 1;
    }
}